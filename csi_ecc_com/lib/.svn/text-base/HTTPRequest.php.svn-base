<?php
/**
 * HTTP request wrapper
 * @author hansenyang
 *
 */
class HTTPRequest {
    /**
     * Get $_GET parameters
     * @param string $key
     * @param mixed $default
     */
    public static function getGetParam($key, $default = null) {
        return isset($_GET[$key]) ? $_GET[$key] : $default;
    }
 
    /**
     * Get $_POST parameters
     * @param string $key
     * @param mixed $default
     */
    public static function getPostParam($key, $default = null) {
        return isset($_POST[$key]) ? $_POST[$key] : $default;
    }

    /**
     * Get $_REQUEST parameters
     * @param string $key
     * @param mixed $default
     */
    public static function getRequestParam($key, $default = null) {
        return isset($_REQUEST[$key]) ? $_REQUEST[$key] : $default;
    }
}
