<?php
class stuListView extends View
{
	public function __construct($parameter = null)
	{
		parent::__construct($parameter);
		$this->add('common/header');
		$this->add('stuList');
		$this->table();
		echo $this->webPage;
	}
}
?>