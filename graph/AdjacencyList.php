<?php

/**
 * 图的邻接表表现形式
 */
class AdjacencyList
{
    //first数组，存储顶点的起始边
    public $first;

    //next数组，存储边的关系
    //索引表示第i条边，值是第i条边的上一条边
    public $next;

    private $n;
    private $m;

    public $u;
    public $v;
    public $w;


    private $edges;
    private $curVertex;

    /**
     * AdjacencyList constructor.
     * @param $n    顶点的数量
     * @param $m    边的数量
     */
    public function __construct($n, $m)
    {
        $this->edges = 1;
        $this->curVertex = 1;

        $this->n = $n;
        $this->m = $m;

        //初始化first数组，默认-1，代表没有边
        for($i=0; $i<=$n; $i++)
        {
            $this->first[$i] = -1;
        }

        //初始化next数组
        //初始化存储边的信息数组
        for($j=0; $j<=$m; $j++)
        {
            $this->next[$j] = null;
            $this->u[$j] = 0;
            $this->w[$j] = 0;
            $this->v[$j] = 0;
        }
    }

    //设置边
    public function setEdge($x, $y, $length)
    {
        $this->u[$this->edges] = $x;
        $this->v[$this->edges] = $y;
        $this->w[$this->edges] = $length;

        //$this->first[$startVertex]：顶点对应的边


        //边的起始顶点
        //如果起始顶点是相同的，代表着该起始顶点有多条边。
        $startVertex = $this->u[$this->edges];

        //设置当前边的上一条边
        $this->next[$this->edges] = $this->first[$startVertex];

        //设置顶点的起始边
        $this->first[$startVertex] = $this->edges;

        $this->edges++;
    }


}


$o = new AdjacencyList(4, 5);
$o->setEdge(1,4,9);
$o->setEdge(4,3,8);
$o->setEdge(1,2,5);
$o->setEdge(2,4,6);
$o->setEdge(1,3,7);

echo '<pre/>';
print_r($o->u);
print_r($o->v);
print_r($o->w);
print_r($o->first);
print_r($o->next);


/*
u v w

u/v/w存储着边的信息，u是边的起始顶点，v是边的结尾顶点，w代表着边的长度
数组索引代表第n条边，例如$u[i]代表第i条边的起始顶点。



$first
    first数组存储顶点的第一条边，
    它的索引代表着顶点，值代表哪条边(对应u数组索引)

$next
    next数组存储着编号为i的前一条边。
    它的索引代表着第i条边，值存储的是边
*/
