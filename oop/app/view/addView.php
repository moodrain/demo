<?php
class addView extends View
{
	public function __construct($parameter = null)
	{
		parent::__construct($parameter);
		$this->add('common/header');
		$this->add('add');
		$this->fill();
		echo $this->webPage;
	}
}
?>