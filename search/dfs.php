<?php 
/*
- 输入一个数字n，输出该数字的排列
- 例如输入2，将输出1 2，2 1
*/
class Chap1
{
	private $box;	//盒子或位置
	private $book;
	private $n;

	function __construct($n)
	{
		$this->n = $n;
		$this->box = array(0, 0, 0, 0);
		$this->book = array(0, 0, 0, 0);
	}

	public function dfs($step = 1)
	{
		//输入盒子中所有数字
		if($step > $this->n)
		{
			for($i=1; $i<count($this->box); $i++){
				echo $this->box[$i];
			}
			echo '<br/>';
			return;
		}

		//遍历所有数字，选出一个可使用的数字放入盒子中
		for($i = 1; $i<=$this->n; $i++)
		{
			if($this->book[$i] == 0){
				$this->box[$step] = $i;
				$this->book[$i] = 1;

				//进入下一个盒子
				$this->dfs($step+1);
				$this->book[$i] = 0;
			}
		}
	}
}
// 1 2 3
/*
echo '<pre/>';
$chap1 = new Chap1(3);
$chap1->dfs();
*/

/**
* dfs
*/
class Maze
{
	private $martix;
	private $book;
	private $checked;

	private $length;
	private $sx;
	private $sy;

	private $next;

	//初始化矩阵大小
	public function __construct($length)
	{
		$this->length = $length+1;
		for($i=0; $i<$this->length; $i++)
		{
			for($j=0; $j<$this->length; $j++)
			{
				$this->martix[$i][$j] = 0;
				$this->book[$i][$j] = 0;
				$this->checked[$i][$j] = 0;
			}
		}

		//分别对应右下左上
		$this->next = [
			[0, 1], 
			[1, 0], 
			[0, -1], 
			[-1, 0]
		];
	}

	//设置起始坐标
	public function setStartCoordinate($x, $y)
	{
		$this->sx = $x;
		$this->sy = $y;
	}

	public function dfs($x, $y, $step)
	{
		//对当前坐标枚举，找到所有可用的下一个坐标点
		$tx = 
	}
}