<?php

/**
 * ���ģ���������Ϣ
 * @author smithhuang
 */
class ComponentConfig {
	
	/**
	 * �ҵ�� - �ƽ̨
	 * @var int
	 */
	const BIZ_TYPE_ACTIVITY = 1;
	/** NEXT_BIZ_TYPE = 2 */
	
	/**
	 * ������� - ����
	 * @var int
	 */
	const COMP_TYPE_COMMENT = 1;
	/**
	 * ������� - ��Ѷ
	 * @var int
	 */
	const COMP_TYPE_INFORMATION = 2;
	/**
	 * ������� - ���а�
	 * @var int
	 */
	const COMP_TYPE_RANK = 3;
	/**
	 * ������� - �Ż�ȯ
	 * @var int
	 */
	const COMP_TYPE_COUPON = 4;
	/**
	 * ������� - �齱
	 * @var int
	 */
	const COMP_TYPE_ORDER_LOTTERY = 5;
	/**
	 * ������� - С����
	 * @var int
	 */
	const COMP_TYPE_CATEGORY = 6;
	/**
	 * ������� - ����ʱ
	 * @var int
	 */
	const COMP_TYPE_COUNT_DOWN = 7;
	/**
	 * ������� - ����
	 * @var int
	 */
	const COMP_TYPE_APPOINT = 8;
	/**
	 * ������� - ����ƽ̨
	 * @var int
	 */
	const COMP_TYPE_SMS = 9;
	/**
	 * ������� - ͶƱ
	 * @var int
	 */
	const COMP_TYPE_VOTE = 10;


	/**
	 * ������� - ǩ��
	 * @var int
	 */
	const COMP_TYPE_SIGN = 11;
	
	/** @@NEXT_COMP_TYPE = 12 */

	
	/**
	 * ���ģ����֧�ֵ�ҵ������
	 * @var array
	 */
	public static $bizs = array(
		self::BIZ_TYPE_ACTIVITY => array(
			'name' => '�ƽ̨',
			'url' => 'http://admin.icson.com/publish/index.php?mod=page&act=info&id={act_id}'
		),
		/** @@NEXT_BIZ */
	);
	
	/**
	 * ���ģ����֧�ֵ��������
	 * @var array
	 */
	public static $components = array(
		/*self::COMP_TYPE_COMMENT => array(
			'name' => 'comment',
			'cname' => '����',
		),
		self::COMP_TYPE_INFORMATION => array(
			'name' => 'information',
			'cname' => '��Ѷ'
		),
		self::COMP_TYPE_RANK => array(
			'name' => 'rank',
			'cname' => '���а�'
		),*/
		self::COMP_TYPE_COUPON => array(
			'name' => 'coupon',
			'cname' => '�콱����',
			//'extra_cols' => array( 'col1' => '�Ż�ȯ���κ�' ),
			'symbols' => array(
				'start_time' => array(
					'name' => 'start_time',
					'description' => '��ʼʱ�䣨ʱ�����'
				),
				'end_time' => array(
					'name' => 'end_time',
					'description' => '����ʱ�䣨ʱ�����'
				)
			)
		),
		/*self::COMP_TYPE_ORDER_LOTTERY => array(
			'name' => 'orderlottery',
			'cname' => '�����齱',
		),
		self::COMP_TYPE_CATEGORY => array(
			'name' => 'category',
			'cname' => 'С����',
		),
		self::COMP_TYPE_COUNT_DOWN => array(
			'name' => 'countdown',
			'cname' => '����ʱ'
		),
		self::COMP_TYPE_APPOINT => array(
			'name' => 'appoint',
			'cname' => '����',
		),*/
		self::COMP_TYPE_SMS => array(
			'name' => 'SMS',
			'cname' => '����ƽ̨',
			'symbols' => array(
				'content' => array(
					'name' => 'params.content',
					'description' => '��������'
				)
			)
		),
		self::COMP_TYPE_VOTE => array(
			'name' => 'vote',
			'cname' => 'ͶƱ',
			'symbols' => array(
				'start_time' => array(
					'name' => 'start_time',
					'description' => '��ʼʱ�䣨ʱ�����'
				),
				'end_time' => array(
					'name' => 'end_time',
					'description' => '����ʱ�䣨ʱ�����'
				),
				'day_num' => array(
					'name' => 'params.day_num',
					'description' => 'ÿ��������'
				),
				'total_num' => array(
					'total_num' => 'params.total_num',
					'description' => '�ܲ������'
				)
			)
		),

		self::COMP_TYPE_SIGN => array(
		   'name' => 'sign',
		   'cname' => 'ǩ��',
		   'symbols' => array(
		      'start_time' => array(
					'name' => 'start_time',
					'description' => '��ʼʱ�䣨ʱ�����'
				),
				'end_time' => array(
					'name' => 'end_time',
					'description' => '����ʱ�䣨ʱ�����'
				)
		   )
		),
		
		/** @@NEXT_COMP */
	);
	
	public static $commonSymbols = array(
		'id' => array(
			'name' => 'id',
			'description' => '���ID'
		),
		'title' => array(
			'name' => 'title',
			'description' => '�������'
		),
	);
}