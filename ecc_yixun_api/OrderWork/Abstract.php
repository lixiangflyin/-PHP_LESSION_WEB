<?php
/**
 * 下单工作流模块抽象类
 *
 * @author bennylin
 */
abstract class EA_OrderWork_Abstract
{
//	protected $uid;
//	protected $user_info;
//	protected $site_id;
//	protected $now_date;
//	protected $now_time;

	protected $data;
	protected $rollback_data;

	/**
	 * init
	 *
	 * @param EA_OrderWork_Data $data
	 *
	 * @return void
	 */
	public function __construct(EA_OrderWork_Data $data)
	{
//		$this->uid = $data['uid'];
//		$this->user = $data['user'];
//		$this->site_id = $data['site_id'];
//		$this->now_date = $data['now_date'];
//		$this->now_time = $data['now_time'];

		$this->data = $data;
	}

	/**
	 * 检查、过滤
	 *
	 * @return mixed false|filter data
	 */
	public function filter($base_params)
	{
	}

	/**
	 * 执行
	 *
	 * @return boolean
	 */
	public function execute($base_params, $module_params)
	{
	}

	/**
	 * 回滚
	 *
	 * @return boolean
	 */
	public function rollback()
	{
	}
}


