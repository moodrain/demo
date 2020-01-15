<?php
class testController
{
	public function test()
	{
		echo 'I am testController@test';
	}
	public function studentTotal()
	{
		$Student = new studentModel();
		$studentTotal = $Student->count();
		echo '学生总人数为：'.$studentTotal;
	}
}