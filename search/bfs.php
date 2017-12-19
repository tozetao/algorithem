<?php 

class Node
{
	public $x;
	public $y;
	public $step;
	public $parent;
}

//广度优先
class Maze
{
	//矩阵
	private $matrix;

	//标记
	private $book;
	
	private $next;

	//矩阵的长宽
	private $n;

	//待寻找的坐标
	private $x;
	private $y;

	public $queue;

	//是否找到的标记
	public $flag = 0;	

	public function __construct($n)
	{
		//下一步
		$this->next = [
			[0, 1], [1, 0], [0, -1], [-1, 0]
		];
		$this->n = $n;

		for($i=0; $i<$n+1; $i++)
		{
			for($j=0; $j<$n+1; $j++)
			{
				$this->matrix[$i][$j] = 0;
				$this->book[$i][$j] = 0;
			}
		}

		$this->n = $n;

		$this->queue = array();
	}

	public function setSearchCoordinate($x, $y)
	{
		$this->x = $x;
		$this->y = $y;
	}

	//x/y，起步的节点
	public function bfs($x, $y)
	{
		$head = 0;
		$tail = 0;


		//在队列中添加起步的节点
		$node = new Node();
		$node->x = $x;
		$node->y = $y;
		$node->step = 0;
		$node->parent = 0;
		$this->queue[] = $node;

		while($head <= $tail)
		{
			//寻找相邻的子节点
			for($i=0; $i<4; $i++)
			{
				$tx = $this->queue[$head]->x + $this->next[$i][0];
				$ty = $this->queue[$head]->y + $this->next[$i][1];

				if($tx < 1 || $tx>$this->n || $ty < 1 || $ty>$this->n)
					continue;

				//坐标点是否被使用
				if($this->book[$tx][$ty] == 0)
				{
					$this->book[$tx][$ty] = 1;
					$tail++;

					$son = new Node();
					$son->x = $tx;
					$son->y = $ty;
					$son->step = $this->queue[$head]->step+1;
					$son->parent = $this->queue[$head];

					$this->queue[$tail] = $son;
				}

				//判断坐标是否被找到
				if($tx == $this->x && $ty == $this->y)
				{
					$this->flag = 1;
					return true;
				}	
			}
			$head++;
		}
	}
}

/*

1	0 0 0 0
2	0 0 0 0
3	0 0 0 0
4	0 0 0 0

*/
$maze = new Maze(4);
$maze->setSearchCoordinate(4,4);
$maze->bfs(1, 1);

echo '<pre/>';
var_dump($maze->flag);
print_r(array_pop($maze->queue));