<?php

/**
 * 组件模块的配置信息
 * @author smithhuang
 */
class ComponentConfig {
	
	/**
	 * 活动业务 - 活动平台
	 * @var int
	 */
	const BIZ_TYPE_ACTIVITY = 1;
	/** NEXT_BIZ_TYPE = 2 */
	
	/**
	 * 组件类型 - 评论
	 * @var int
	 */
	const COMP_TYPE_COMMENT = 1;
	/**
	 * 组件类型 - 资讯
	 * @var int
	 */
	const COMP_TYPE_INFORMATION = 2;
	/**
	 * 组件类型 - 排行榜
	 * @var int
	 */
	const COMP_TYPE_RANK = 3;
	/**
	 * 组件类型 - 优惠券
	 * @var int
	 */
	const COMP_TYPE_COUPON = 4;
	/**
	 * 组件类型 - 抽奖
	 * @var int
	 */
	const COMP_TYPE_ORDER_LOTTERY = 5;
	/**
	 * 组件类型 - 小分类
	 * @var int
	 */
	const COMP_TYPE_CATEGORY = 6;
	/**
	 * 组件类型 - 倒计时
	 * @var int
	 */
	const COMP_TYPE_COUNT_DOWN = 7;
	/**
	 * 组件类型 - 报名
	 * @var int
	 */
	const COMP_TYPE_APPOINT = 8;
	/**
	 * 组件类型 - 短信平台
	 * @var int
	 */
	const COMP_TYPE_SMS = 9;
	/**
	 * 组件类型 - 投票
	 * @var int
	 */
	const COMP_TYPE_VOTE = 10;


	/**
	 * 组件类型 - 签到
	 * @var int
	 */
	const COMP_TYPE_SIGN = 11;
	
	/** @@NEXT_COMP_TYPE = 12 */

	
	/**
	 * 组件模块所支持的业务类型
	 * @var array
	 */
	public static $bizs = array(
		self::BIZ_TYPE_ACTIVITY => array(
			'name' => '活动平台',
			'url' => 'http://admin.icson.com/publish/index.php?mod=page&act=info&id={act_id}'
		),
		/** @@NEXT_BIZ */
	);
	
	/**
	 * 组件模块所支持的组件类型
	 * @var array
	 */
	public static $components = array(
		/*self::COMP_TYPE_COMMENT => array(
			'name' => 'comment',
			'cname' => '评论',
		),
		self::COMP_TYPE_INFORMATION => array(
			'name' => 'information',
			'cname' => '资讯'
		),
		self::COMP_TYPE_RANK => array(
			'name' => 'rank',
			'cname' => '排行榜'
		),*/
		self::COMP_TYPE_COUPON => array(
			'name' => 'coupon',
			'cname' => '领奖设置',
			//'extra_cols' => array( 'col1' => '优惠券批次号' ),
			'symbols' => array(
				'start_time' => array(
					'name' => 'start_time',
					'description' => '开始时间（时间戳）'
				),
				'end_time' => array(
					'name' => 'end_time',
					'description' => '结束时间（时间戳）'
				)
			)
		),
		/*self::COMP_TYPE_ORDER_LOTTERY => array(
			'name' => 'orderlottery',
			'cname' => '订单抽奖',
		),
		self::COMP_TYPE_CATEGORY => array(
			'name' => 'category',
			'cname' => '小分类',
		),
		self::COMP_TYPE_COUNT_DOWN => array(
			'name' => 'countdown',
			'cname' => '倒计时'
		),
		self::COMP_TYPE_APPOINT => array(
			'name' => 'appoint',
			'cname' => '报名',
		),*/
		self::COMP_TYPE_SMS => array(
			'name' => 'SMS',
			'cname' => '短信平台',
			'symbols' => array(
				'content' => array(
					'name' => 'params.content',
					'description' => '短信内容'
				)
			)
		),
		self::COMP_TYPE_VOTE => array(
			'name' => 'vote',
			'cname' => '投票',
			'symbols' => array(
				'start_time' => array(
					'name' => 'start_time',
					'description' => '开始时间（时间戳）'
				),
				'end_time' => array(
					'name' => 'end_time',
					'description' => '结束时间（时间戳）'
				),
				'day_num' => array(
					'name' => 'params.day_num',
					'description' => '每天参与次数'
				),
				'total_num' => array(
					'total_num' => 'params.total_num',
					'description' => '总参与次数'
				)
			)
		),

		self::COMP_TYPE_SIGN => array(
		   'name' => 'sign',
		   'cname' => '签到',
		   'symbols' => array(
		      'start_time' => array(
					'name' => 'start_time',
					'description' => '开始时间（时间戳）'
				),
				'end_time' => array(
					'name' => 'end_time',
					'description' => '结束时间（时间戳）'
				)
		   )
		),
		
		/** @@NEXT_COMP */
	);
	
	public static $commonSymbols = array(
		'id' => array(
			'name' => 'id',
			'description' => '组件ID'
		),
		'title' => array(
			'name' => 'title',
			'description' => '组件标题'
		),
	);
}