<?php
class studentController
{
	public function detail($id)
	{
		$student = new studentModel;
		$studentDetail = $student->where('id = ' . $id)->get();
		$view = new detailView
		([
			['activeNavTag',1],
			['name',$studentDetail->name],
			['age',$studentDetail->age],
			['class',$studentDetail->class],
			['gender',$studentDetail->gender],
		]);
	}
	public function home()
	{
		$static = './static/home.html';
		if(!file_exists($static) || time() - filemtime($static) > 300)
		{
			ob_start();
			$student = new studentModel();
			$course = new courseModel();
			$studentTotal = $student->count();
			$courseTotal = $course->count();
			$view = new homeView
			([
				['studentTotal',$studentTotal],
				['courseTotal',$courseTotal],
				['activeNavTag',0],
			]);
			$content = ob_get_contents();
			file_put_contents($static, $content);
		}
		else
			require($static);
	}
	public function student()
	{
		echo 'this is student page';
	}
	public function add()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			foreach ($_POST as $key => $value) 
			{
				if($value == '')
				{
					echo "<script>alert('请全部填写字段！');history.back()</script>";
					return 0;
				}
			}
			$student = new studentModel();
			$student->add($_POST);
			echo "<script>alert('添加成功');location='add'</script>";
			unlink('./static/home.html');
		}
		else if($_SERVER['REQUEST_METHOD'] == 'GET')
			$view = new addView([['activeNavTag',1]]);
	}
	public function stuList()
	{
		$student = new studentModel();
		// $data = $student->where("gender = '男'")->orderBy('id')->all();
		$data = $student->all();
		$view = new stuListView([['data',$data],['activeNavTag',1]]);
	}
	public function test()
	{
	} 
}
?>