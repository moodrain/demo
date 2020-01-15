<?php
class container
{
	public $binds;
	public function bind($abstract, $concrete)
	{
		$this->binds[$abstract] = $concrete;
	}
	public function make($abstract, $parameter=[])
	{
		array_unshift($parameter, $this);
		return call_user_func_array($this->binds[$abstract], $parameter);
	}
}
?>