<?php

/*
	[DISCUZ!] config.inc.php - basically configuration of Discuz! Board
	This is NOT a freeware, use is subject to license terms
*/

// [EN]	Set below parameters according to your account information provided by your hosting
// [CH] ���±�������ݿռ����ṩ���˺Ų����޸�,��������,����ϵ�������ṩ��

	$dbhost = 'localhost';			// database server
						// ���ݿ������

	$dbuser = 'root';			// database username
						// ���ݿ��û���

	$dbpw = 'root';			// database password
						// ���ݿ�����

	$dbname = 'discuz';			// database name
						// ���ݿ���

	$adminemail = 'admin@your.com';		// admin email
						// ��̳ϵͳ Email

	$dbreport = 0;				// send db error report? 1=yes
						// �Ƿ������ݿ���󱨸�? 0=��, 1=��


// [EN] If you have problems logging in Discuz!, then modify the following parameters, else please leave default
// [CH] ������ cookie ���÷�Χ������Ҫ��,����̳��¼������,���޸��������,�����뱣��Ĭ��

	$cookiedomain = ''; 			// cookie domain
						// cookie ������

	$cookiepath = '/';			// cookie path
						// cookie ����·��


// [EN] Special parameters, DO NOT modify these unless you are an expert in Discuz!
// [CH] ���±���Ϊ�ر�ѡ��,һ�������û�б�Ҫ�޸�

	$headercharset = 0;			// force outputing charset header
						// ǿ�������ַ���,ֻ����ʱʹ��

	$errorreport = 1;			// reporting php error, 0=only report to admins(safer), 1=report to all
						// �Ƿ񱨸� PHP ����, 0=ֻ���������Ա�Ͱ���(����ȫ), 1=������κ���

	$forcesecques = 0;			// require security question for administrators' control panel, 0=off, 1=on
						// ������Ա�������ð�ȫ���ʲ��ܽ���ϵͳ����, 0=��, 1=��

	$onlinehold = 900;			// time span of online recording
						// ���߱���ʱ��

	$pconnect = 0;				// persistent database connection, 0=off, 1=on
						// ���ݿ�־����� 0=�ر�, 1=��


// [EN] !ATTENTION! Do NOT modify following after your board was settle down
// [CH] ��̳Ͷ��ʹ�ú����޸ĵı���

	$tablepre = 'cdb_';   			// ����ǰ׺, ͬһ���ݿⰲװ�����̳���޸Ĵ˴�
						// table prefix, modify this when you are installingmore than 1 Discuz! in the same database.

	$attachdir = './attachments';		// ��������λ�� (������·��, ���� 777, ����Ϊ web �ɷ��ʵ���Ŀ¼, ���� "/", ���Ŀ¼����� "./" ��ͷ)
						// attachments saving dir. (chmod to 777, visual web dir only, ending without slash

	$attachurl = 'attachments';		// ����·�� URL ��ַ (��Ϊ��ǰ URL �µ���Ե�ַ�� http:// ��ͷ�ľ��Ե�ַ, ���� "/")


// [EN] !ATTENTION! Preservation or debugging for developing
// [CH] �����޸����±���,�������򿪷�������!

	$database = 'mysql';			// 'mysql' for MySQL version and 'pgsql' for PostgreSQL version
						// MySQL �汾������ 'mysql', PgSQL �汾������ 'pgsql'

	$dbcharset = '';			// default database character set, 'gbk', 'big5', 'utf8', 'latin1' and blank are available
						// MySQL �ַ���, ��ѡ 'gbk', 'big5', 'utf8', 'latin1', ����Ϊ������̳�ַ����趨

	$charset = 'utf-8';			// default character set, 'gbk', 'big5', 'utf-8' are available
						// ��̳Ĭ���ַ���, ��ѡ 'gbk', 'big5', 'utf-8'

	$attackevasive = 0;			// protect against attacks via common request, 0=off, 1=cookie refresh limitation, 2=deny proxy request, 3=both
						// ������������������ɵľܾ����񹥻�, 0=�ر�, 1=cookie ˢ������, 2=���ƴ������, 3=cookie+��������

	$tplrefresh = 1;			// auto check validation of templates, 0=off, 1=on
						// ģ���Զ�ˢ�¿��� 0=�ر�, 1=��

// ============================================================================