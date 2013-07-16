<?php
/**
记得将Zend Studio 的 PHPUnit库include到'PHP Include Path'下就行了
 *
*/

class ArrayTest extends PHPUnit_Framework_TestCase {

	public function testNewArrayIsEmpty()     {

		$result = true;

		$this->assertEquals(true, $result);
	}
}
?>