<?php 

/**
* 图的遍历
*/
class DFSMap
{
	//矩阵，用于表示图顶点与顶点之间的关系
	private $martix;

	//顶点数量
	private $n;

	private $sum;

	//标记顶点是否被使用
    public $book;

    public $list;

	public function __construct($n)
	{
		$this->n = $n;
		$this->sum = 0;
        $this->list = array();

		for($i=0; $i<=$n+1; $i++)
        {
			//初始化图，行代表顶点，列代表与其他顶点的关系
            //矩阵第i行第j列代表第i个顶点与第j个顶点边的关系
			for($j=0; $j<=$n+1; $j++){
				$this->martix[$i][$j] = 0;
			}
			//初始化标记
			$this->book[$i] = 0;
		}
	}

	//无向图顶点的关联
	public function setCoordinate($x, $y)
	{
		$this->martix[$x][$y] = 1;
		$this->martix[$y][$x] = 1;
	}

	//深度优先搜索来遍历图
	public function dfs($current)
	{
        if($this->sum == $this->n)
            return;

        $this->sum++;
        $this->book[$current] = 1;
        $this->list[] = $current;

        //寻找当前顶点的关联顶点
        for($i=1; $i<=$this->n; $i++)
        {
            if($this->martix[$current][$i] == 1 && $this->book[$i] == 0)
            {
                $this->dfs($i);
            }
        }
	}

    public function outputMartix()
    {
        foreach ($this->martix as $item) {
            foreach ($item as $value)
            {
                echo $value . '&nbsp;&nbsp;';
            }
            echo '<br/>';
        }
    }
}



/*
//无项图的深度优先搜索
$map = new DFSMap(5);
$map->setCoordinate(1, 2);
$map->setCoordinate(1, 3);
$map->setCoordinate(1, 5);
$map->setCoordinate(2, 4);
$map->setCoordinate(3, 5);

$map->outputMartix();
$map->dfs(1);

echo '<pre/>';
print_r($map->list);
print_r($map->book);*/


//广度优先搜索
class BFSMap
{
    private $martix;

    public $queue;
    private $head;
    private $last;

    private $n;
    private $sum;

    public $book;

    public function __construct($n)
    {
        $this->n = $n;
        $this->sum = 0;
        $this->head = 1;
        $this->last = 1;
        $this->queue = array();

        for($i=0; $i<=$n+1; $i++)
        {
            for($j=0; $j<=$n+1; $j++)
            {
                $this->martix[$i][$j] = 0;
            }
            $this->book[$i] = 0;
        }
    }

    //无向图顶点的关联
    public function setCoordinate($x, $y)
    {
        $this->martix[$x][$y] = 1;
        $this->martix[$y][$x] = 1;
    }

    public function outputMartix()
    {
        for($i=1; $i<=$this->n; $i++)
        {
            for($j=1; $j<=$this->n; $j++)
            {
                echo $this->martix[$i][$j], '&nbsp;&nbsp;';
            }
            echo '<br/>';
        }
    }

    public function bfs($current)
    {
        $this->queue[] = $current;
        $this->last++;
        $this->book[$this->head] = 1;

        while($this->head < $this->last)
        {

            //获取当前顶点关联的顶点
            for($i=1; $i<=$this->n; $i++)
            {
                if($this->martix[$this->head][$i] == 1 && $this->book[$i] == 0)
                {
                    $this->queue[] = $i;
                    $this->last++;
                    $this->book[$i] = 1;
                }
            }
            $this->head++;
        }
    }
}

$map = new BFSMap(5);
$map->setCoordinate(1, 2);
$map->setCoordinate(1, 3);
$map->setCoordinate(1, 5);
$map->setCoordinate(2, 4);
$map->setCoordinate(3, 5);

$map->outputMartix();
$map->bfs(1);

echo '<pre/>';
print_r($map->queue);
print_r($map->book);
