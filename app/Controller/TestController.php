<?php
class TestController extends AppController
{
	public function test()
	{
		//Cache::write('key', 123);
		//echo Cache::read('key');
		Cache::clear(true);
	}

}
?>




