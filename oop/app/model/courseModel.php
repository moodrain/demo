<?php
class courseModel extends Model
{
	public function __construct()
	{
		parent::__construct();
		$this->table = 'course';
	}
}
?>