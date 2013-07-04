<?php
function CheckPrivilegeID($item) {
	
	return true;

    if (true === $item) {
        return true;
    }

    if (!isset($_SESSION)) {
        @session_start();
    }

    $permission = isset($_SESSION['permission']) ? $_SESSION['permission'] : array();
    $permission = is_array($permission) ? $permission : array();

    return in_array($item, $permission) && isset($_COOKIE['username']);
}
