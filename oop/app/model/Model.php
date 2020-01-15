<?php
class Model
{
	public $config;
	public $pdo;
	public $table;
	public $where;
	public $group;
	public $having;
	public $order;
	public $join;
	public function __construct()
	{
		include_once('./config/database.php');
		$this->pdo = new PDO(TYPE . ':host=' . HOST . ';dbname=' . DB .';charset=utf8',USER,PASS,[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
	}
	public function get($field = '*')
	{
		$stmt = $this->pdo->prepare('SELECT ' . $field . ' FROM ' . $this->table . $this->join . $this->where . $this->group . $this->having . $this->order . ' LIMIT 1');
		$stmt->execute();
		$data = $stmt->fetch(PDO::FETCH_OBJ);
		$this->clear();
		return $data;
	}
	public function all($field = '*')
	{
		$stmt = $this->pdo->prepare('SELECT ' . $field . ' FROM ' . $this->table . $this->join . $this->where . $this->group . $this->having . $this->order);
		$stmt->execute();
		$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$this->clear();
		return $data;
	}
	public function count()
	{
		$stmt = $this->pdo->prepare('SELECT COUNT(*) FROM ' . $this->table . $this->where . $this->group . $this->having);
		$stmt->execute();
		$data = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->clear();
		return $data['COUNT(*)'];
	}
	public function add($data)
	{
		$field = '';
		$value = '';
		$exeValue = [];
		foreach ($data as $key => $val) 
		{
			$field .= $key . ',';
			$value .= '?,';
			array_push($exeValue,$val);
		}
		$field = substr($field,0,count($field) - 2);
		$value = substr($value,0,count($value) - 2);
		$stmt = $this->pdo->prepare('INSERT ' . $this->table . '(' . $field . ')' . ' VALUES ' . '(' . $value . ')');
		$stmt->execute($exeValue);
		$this->clear();
	}
	public function del($where = '')
	{
		if($where == null || $where == '')
			return 0;
		$stmt = $this->pdo->prepare('DELETE FROM ' . $this->table . ' WHERE ' . $where);
		$stmt->execute();
		$this->clear();
	}
	public function upd($data,$where = '')
	{
		if($where == null || $where == '')
			return 0;
		$update = '';
		$exeValue = [];
		foreach ($data as $key => $val) 
		{
			$update .= $key . '=' . '?,';
			array_push($exeValue,$val);
		}
		$update = substr($update,0,count($update) - 2);
		$stmt = $this->pdo->prepare('UPDATE ' . $this->table . ' SET ' . $update . ' WHERE ' . $where);
		$stmt->execute($exeValue);
		$this->clear();
	}
	public function where($where)
	{
		$this->where = ' WHERE '. $where;
		return $this;
	}
	public function groupBy($group)
	{
		$this->group =  ' GROUP BY' . $group;
		return $this;
	}
	public function join($join)
	{
		$this->join = $join;
		return $this;
	}
	public function having($having)
	{
		$this->having = ' HAVING ' . $having;
		return $this;
	}
	public function orderBy($order)
	{
		$this->order = ' ORDER BY ' . $order;
		return $this;
	}
	public function clear()
	{
		$this->where = '';
		$this->group = '';
		$this->having = '';
		$this->order = '';
		$this->join = '';
	}
}



?>