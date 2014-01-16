<?php

class BenchmarkTest extends CI_Controller {

	public function test()
	{
		$this->benchmark->mark('code_start');
		
		$this->benchmark->mark('code_end');
		
		$time = $this->benchmark->elapsed_time('code_start','code_end');
		
		echo $time;
	}

}