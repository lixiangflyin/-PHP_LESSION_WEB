<?php
/**
 * 下单工作流调度器
 *
 * @author bennylin
 */
class EA_OrderWork_Dispatcher
{
	public static function dispatch($user, $site_id)
	{
		$modules = array(
			'Base',
			'Score',
			'Promotion',
			'Order',
			'End',
		);

		$data = new EA_OrderWork_Data($user, $site_id);

		$instance_list = array();
		$executed_list = array();
		$filtered_data_list = array('Base' => null);
		$exec_data_list = array();

		//filter
		foreach ($modules as $module) {
			//new instance
			$instance_list[$module] = self::getModuleInstance($module, $data);

			$filter_result = $instance_list[$module]->filter($filtered_data_list['Base']);
			if ($filter_result === false ) {
				return array(
					'errCode' => EL_Errors::$code,
					'errMsg' => self::getMessage(EL_Errors::$code),
				);
			}

			if (!empty($filter_result['errCode'])) {
				return $filter_result;
			}

			$filtered_data_list[$module] = $filter_result;
		}

		//execute
		foreach ($modules as $module) {
			$instance = $instance_list[$module];
			$exec_result = $instance->execute($filtered_data_list['Base'], $filtered_data_list[$module]);
			if (!$exec_result || !empty($exec_result['errCode']) ) {
				self::rollback($instance_list, $executed_list); //rollback executed

				if (!empty($exec_result['errCode'])) {
					return $exec_result;
				}

				return array(
					'errCode' => EL_Errors::$code,
					'errMsg' => self::getMessage(EL_Errors::$code),
				);
			}

			$executed_list[] = $module; //record the executed
			$exec_data_list[$module] = $exec_result;
		}

		if ($data->debug) {
			file_put_contents('/tmp/benny/order_result_new.txt', var_export($exec_data_list['End'], true) );
		}

		return $exec_data_list['End'];
	}

	public static function getMessage($code)
	{
		$messages = include	PHPLIB_ROOT . 'api/OrderWork/error_message.php';
		return isset($messages[$code]) ? $messages[$code] : "服务器忙，请稍后再试({$code})";
	}

	private static function rollback($instance_list, $executed_list)
	{
		for ($i = count($executed_list) - 1; $i >= 0; $i--) {
			$module = $executed_list[$i];
			$result = $instance_list[$module]->rollback();
			if ($result === false) {
				EL_Errors::err(21101, "rollback module '{$module}' failed");
			}
		}
	}

	private static function getModuleInstance($module, $data)
	{
		$module_class = "EA_OrderWork_{$module}";
		return new $module_class($data);
	}
}


