<?php
class router extends container
{
	public $url;
	public $request;
	public $parameter;
	public $rule = [];
	public function __construct()
	{
		$this->url = $_SERVER['PATH_INFO'];
		$reqData = explode('/',$this->url);
		$this->request = $reqData[1];
		if(isset($reqData[2]))
			$this->parameter = $reqData[2];
	}
	public function route()
	{
		foreach ($this->rule as $id => $val) 
		{
			foreach ($val as $req => $res) 
			{
				if($this->request == $req)
				{
					if($res[1])
					{
						if(isset($this->parameter))
						{
							if(!in_array($res[1],['/_num','/_str']))
								throw new Exception('未知参数类型！', 1);
							if($res[1] == '/_num')
							{
								if(ctype_digit($this->parameter))
								{
									$this->{$res[0][0]}->{$res[0][1]}($this->parameter);
									return true;
								}
							}
							else if($res[1] == '/_str')
							{
								$this->{$res[0][0]}->{$res[0][1]}($this->parameter);
								return true;
							}
						}
					}
					else
					{
						$this->{$res[0][0]}->{$res[0][1]}();
							return true;
					}
				}
			}
		}
	}
	public function addRule($rule)
	{
		foreach ($rule as $key => $value) 
		{
			if(!($para = strstr($key,'/_num')))
				$para = strstr($key,'/_str');
			if($para)
				$key = str_replace($para,'',$key);
			$action = explode('@',$value);
			array_push($this->rule,[$key => [$action,$para]]);
			if(!isset($this->{$action[0]}))
				$this->{$action[0]} = $this->make($action[0]);
		}
	}
}
?>