<?php
class detailView extends View
{
	public function __construct($parameter = null)
	{
		parent::__construct($parameter);
		$this->add('common/header');
		$this->add('detail');
		$this->fill();
		echo $this->webPage;
	}
}
?>