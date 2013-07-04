<?php
/**
 * Wrapper class for email sending.
 * @author zhiliu
 * @version 1.0
 * @created 1-3-2011
 */

/**
 * Used to send a normal email.
 * @package library
 * @subpackage mail
 * @version 0.1
 */

define('BRAND_DOMAIN', "");
define('EMAIL_SUPPORT', "");

class MailSender {
    /**
     * The email receiver(s).
     * @var string
     */
    protected $to;

    /**
     * The email subject.
     * @var string
     */
    protected $subject;

    /**
     * The email body content.
     * @var string
     */
    protected $body;

    /**
     * Email additional headers.
     * @var string
     */
    protected $header;

    /**
     * Set the email basic parameters.
     * @param mixed $to one or a group (array) of email receiver(s)
     * @param string $subject email subject
     * @param string $body email body content
     * @param string $header additional email headers
     */
    public function __construct($to, $subject, $body, $header = NULL) {
        if (NULL == $header) {
            $header  = 'MIME-Version: 1.0' . "\r\n";
            $header .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
            $header .= 'Content-Transfer-Encoding: base64' . "\r\n";
        }

        $this->to = is_array($to) ? implode(',', $to) : $to;
        $this->subject = $subject;
        $this->body = $body;
        $this->header = $header;
    }

    /**
     * Unsets the resources.
     */
    public function __destruct() {
        unset($this->to);
        unset($this->subject);
        unset($this->body);
        unset($this->header);
    }

    /**
     * Sends out the mail by mail().
     * @return boolean
     */
    public function send() {
        $result = FALSE;

        $header = $this->getSendFrom() . $this->header;
        $this->subject  = '=?UTF-8?B?' . base64_encode($this->subject) . '?=';
        $this->body  = chunk_split(base64_encode(trim($this->body)));
        $result = @mail($this->to, $this->subject, $this->body, $header);

        return $result;
    }

    /**
     * Gets the send from email address
     * @return string
     */
    private function getSendFrom() {
        return 'From: "=?UTF-8?B?' . base64_encode(BRAND_DOMAIN) . '?=" <' . EMAIL_SUPPORT . ">\r\n";
    }
}
?>