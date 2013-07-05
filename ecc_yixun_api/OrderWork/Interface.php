<?php
/**
 * 工作流模块接口规范
 */
interface EA_OrderWork_Interface {
	/**
	 * init
	 * @return void
	 */
	public function __construct($data);

	/**
	 * 检查、过滤
	 * @return mixed false|filter data
	 */
	public function filter($base_params);

	/**
	 * 执行
	 * @return boolean
	 */
	public function execute($base_params, $module_params);

	/**
	 * 回滚
	 * @return boolean
	 */
	public function rollback();
}
