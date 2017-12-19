<?php 
/*
求n个数字的多种组合，一个数字只允许被使用一次
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
* dfs(深度优先)
* 计算A点到B点的最短路径
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

	public $min;
	public $path;

	//初始化矩阵大小
	public function __construct($length)
	{
		$this->length = $length+1;
		for($i=0; $i<=$this->length; $i++)
		{
			for($j=0; $j<=$this->length; $j++)
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

		$this->min = PHP_INT_MAX;
	}

	private function setMinPath()
	{
		for ($i=0; $i<$this->length; $i++) 
		{ 
			for($j=0; $j<$this->length; $j++)
			{
				if($this->book[$i][$j] == 1)
					$this->path[] = [$i, $j];
			}
		}
	}

	//设置搜索坐标
	public function setTargetCoordinate($x, $y)
	{
		$this->sx = $x;
		$this->sy = $y;
	}

	public function dfs($x, $y, $step)
	{
		if($x == $this->sx && $y == $this->sy)
		{
			if($step < $this->min)
			{
				//记录最短步数
				$this->min = $step;
				//记录路径
				$this->setMinPath();
			}
			return ;
		}

		//对当前坐标枚举，找到所有可用的下一个坐标点
		for($i=0; $i<4; $i++)
		{
			$tx = $this->next[$i][0] + $x;
			$ty = $this->next[$i][1] + $y;

			//判断是否越界
			if($tx < 1 || $tx>$this->length-1 || $ty<1 || $ty>$this->length-1)
				continue;

			
			//判断是否障碍或者被标记
			if($this->martix[$tx][$ty] == 0 && $this->book[$tx][$ty] == 0)
			{
				//标记被使用
				$this->book[$tx][$ty] = 1;

				$this->dfs($tx, $ty, $step+1);

				//取消标记
				$this->book[$tx][$ty] = 0;
			}
		}
	}
}

/*
0 0 0 0 0 0 0
0 0 0 0 0 0 0
0 0 0 0 0 0 0
0 0 0 0 0 0 0
0 0 0 0 0 0 0
0 0 0 0 0 0 0
0 0 0 0 0 0 0
*/

$maze = new Maze(5);
$maze->setTargetCoordinate(5,5);
$maze->dfs(1, 1, 1);

echo '<pre/>';
var_dump($maze->min);
print_r($maze->path);
