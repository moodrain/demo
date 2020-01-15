<?php
class homeView extends View
{
	public function __construct($parameter)
	{
		parent::__construct($parameter);
		$this->add('common/header');
		$this->add('home');
		$this->fill();
		echo $this->webPage;
	}
}
?>