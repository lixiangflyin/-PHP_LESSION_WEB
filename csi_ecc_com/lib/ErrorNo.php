<?php
/**
 * Wrapper define of error no.
 * @author zhiliu
 * @version 1.0
 * @created 3-3-2011
 */

/**
 * Every Error number must be upper and connect with underline
 * The define of Error name:
 *   For error message using the prefix of ERROR_
 *   For warnning message using the prefix of WARN_
 *   For information message using the prefix of INFO_
 * The format of Error no:
 *   xyyzzz using five bit to format the error no
 *   x   : the type of error 0-error, 1-warning 2-info defaul is zero, you can ignore it
 *   yy  : the category of type
 *         00 : common
 *         01 : user
 *         02 : product
 *         03 : ....
 *   zzz : the detail of error number in category
 * 
 */

/**
 * User error
 */
define('ERROR_INVALID_USER_ID',           01001);

/**
 * product error
 */
define('ERROR_INVALID_PRODUCT_ID',        02001);
define('ERROR_INVALID_PAREND_PRODUCT_ID', 02002);


?>