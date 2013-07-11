<?php

/*
	[Discuz!] (C)2001-2006 Comsenz Inc.
	This is NOT a freeware, use is subject to license terms

	$RCSfile: mail_config.inc.php,v $
	$Revision: 1.3 $
	$Date: 2006/02/23 13:44:02 $
*/

// [EN] !ATTENTION! Type 2 & type 3 are only experimental, we do not provide any guarantee or support of this
// [CH] ע��: ���ͷ�ʽ 2 �� 3 ����ʵ���ò�С��ģ���Կ���, ���ǲ��Դ��ṩ�κα�֤�ͼ���֧��

$sendmail_silent = 1;		// ignore error reporting, 1=yes, 0=no
				// �����ʼ������е�ȫ��������ʾ, 1=��, 0=��

$mailsend = 1;			// Sending type	0=do not send any mails
				//		1=send via PHP mail() function and UNIX sendmail
				//		2=send via Discuz! SMTP/ESMTP interface
				//		3=send via PHP mail() and SMTP(only for win32, do not support ESMTP)

				// �ʼ����ͷ�ʽ	0=�������κ��ʼ�
				//		1=ͨ�� PHP ������ UNIX sendmail ����(�Ƽ��˷�ʽ)
				//		2=ͨ�� SOCKET ���� SMTP ����������(֧�� ESMTP ��֤)
				//		3=ͨ�� PHP ���� SMTP ���� Email(�� win32 ����Ч, ��֧�� ESMTP)
				//
				// ��ͨ�� utilities/testmail.php ��������ϵͳ֧�������ʼ����ͷ�ʽ

if($mailsend == 1) {

	// Send via PHP mail() and UNIX sendmail(no extra configuration)
	// ͨ�� PHP ������ UNIX sendmail ����(��������)

} elseif($mailsend == 2) {	// send via Discuz! ESMTP interface
				// ͨ�� Discuz! SMTP ģ�鷢��

	$mailcfg['server'] = 'smtp.21cn.com';			// SMTP host address
								// SMTP ������

	$mailcfg['port'] = '25';				// SMTP �˿�, Ĭ�ϲ����޸�
								// SMTP port, leave default for most occations

	$mailcfg['auth'] = 1;					// require authentification? 1=yes, 0=no
								// �Ƿ���Ҫ AUTH LOGIN ��֤, 1=��, 0=��

	$mailcfg['from'] = 'Discuz <myaccount@21cn.com>';	// mail from (if authentification required, do use local email address of ESMTP server)
								// �����˵�ַ (�����Ҫ��֤,����Ϊ����������ַ)

	$mailcfg['auth_username'] = 'myaccount';		// username for authentification
								// ��֤�û���

	$mailcfg['auth_password'] = 'password';			// password for authentification
								// ��֤����

} elseif($mailsend == 3) {	// send via PHP mail() and SMTP(only for win32, do not support ESMTP)
				// ͨ�� PHP ������ SMTP ����������

	$mailcfg['server'] = 'smtp.your.com';		// SMTP host address
							// SMTP ������

	$mailcfg['port'] = '25';			// SMTP �˿�, Ĭ�ϲ����޸�
							// SMTP port

}

?>