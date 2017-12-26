<?php

//递归将会在找到一个顶点后结束
//或者在枚举完顶点的所有可能性后结束

/**
 * 寻找指定顶点(图的深度优先遍历)
*/
class Dijkstra
{
	private $martix;
	private $n;
    public $min;

    public $book;
    private $paths;

    private $targetVertex;

	public function __construct($n)
	{
		$this->n = $n;
        $this->paths = array();
        $this->book = array();
        $this->martix = array();
        $this->min = PHP_INT_MAX;

        //初始化矩阵
        for($i=0; $i<=$n+1; $i++)
        {
            for($j=0; $j<=$n+1; $j++)
            {
                $this->martix[$i][$j] = 0;
            }
            $this->book[$i] = 0;
        }
	}

    public function displayBranch()
    {
        for($i=1; $i<=$this->n; $i++)
        {
            if($this->book[$i] != 0)
                echo $i, '=>';
        }
        echo $this->targetVertex, '<br/>';
    }

    public function displayMartix()
    {
        for($i=1; $i<=$this->n; $i++)
        {
            for($j=1; $j<=$this->n; $j++)
            {
                echo $this->martix[$i][$j], '&nbsp;';
            }
            echo '<br/>';
        }
    }

    public function setTargetVertex($current)
    {
        $this->targetVertex = $current;
    }

    public function setRelation($x, $y, $dis)
    {
        $this->martix[$x][$y] = $dis;
    }

    //深度优先搜索，$current: 当前顶点
    public function dfs($current, $dis)
    {
        if($dis > $this->min)
            return;

        if($current == $this->targetVertex)
        {
            //更新最短距离
            if($dis < $this->min)
            {
                $this->min = $dis;

                //输出一条分支
                $this->displayBranch();
                return;
            }
        }

        $this->book[$current] = 1;

        //枚举关联的顶点
        for($i=1; $i<=$this->n; $i++)
        {
            if($this->martix[$current][$i] != 0 && $this->book[$i] == 0)
            {
                $this->dfs($i, $dis + $this->martix[$current][$i]);
            }
        }

        $this->book[$current] = 0;
    }
}
echo '<pre/>';

$obj = new Dijkstra(5);
$obj->setRelation(1, 2, 2);
$obj->setRelation(1, 5, 10);
$obj->setRelation(2, 3, 3);
$obj->setRelation(2, 5, 7);
$obj->setRelation(3, 1, 4);
$obj->setRelation(3, 4, 4);
$obj->setRelation(4, 5, 5);
$obj->setRelation(5, 3, 3);

$obj->displayMartix();

echo '<br/>';

$obj->setTargetVertex(5);
$obj->dfs(1, 0);

echo '<br/>';
var_dump($obj->min);
var_dump($obj->book);

