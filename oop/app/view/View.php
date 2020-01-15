<?php 
class View
{
	public $webPage;
	public $parameter;
	public function __construct($parameter=null)
	{
		$this->webPage = '';
		$this->parameter = $parameter;
	}
	function fill()
	{
		for($i = 0;$i < count($this->parameter);$i++)
			if(is_array($this->parameter[$i][1]))
				$this->webPage = preg_replace('/{{ \$' . $this->parameter[$i][0] . ' }}/',json_encode($this->parameter[$i][1],JSON_UNESCAPED_UNICODE), $this->webPage);
			else
				$this->webPage = preg_replace('/{{ \$' . $this->parameter[$i][0] . ' }}/',$this->parameter[$i][1], $this->webPage);
	}
	function table()
	{
		for($i = 0;$i < count($this->parameter);$i++)
			if(is_array($this->parameter[$i][1]))
			{
				$data = '';
				foreach ($this->parameter[$i][1] as $key => $student) 
				{
					$data .= '<tr>';
					foreach ($student as $key => $value) 
					{
						$data .= '<td>' . $value . '</td>';
					}
					$data .= '</tr>';
				}
				$this->webPage = preg_replace('/{{ \$' . $this->parameter[$i][0] . ' }}/',$data, $this->webPage);
			}
			else
				$this->webPage = preg_replace('/{{ \$' . $this->parameter[$i][0] . ' }}/',$this->parameter[$i][1], $this->webPage);
	}
	function add($template)
	{
		$this->webPage .= file_get_contents('./resource/template/' . $template . '.html');
	}
}

?>