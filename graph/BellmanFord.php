<?php

/**
 * BellmanFord算法可以概括为对所以边进行n-1次松弛操作。
 * Class BellmanFord
 */
class BellmanFord
{
    public $dis;

    public $u;
    public $v;
    public $w;

    public $edges;

    //边的数量
    public $m;

    public $path;

    public function __construct($n, $m)
    {
        $this->dis = array();
        $this->n = $n;
        $this->m = $m;
        $this->edges = 1;
    }

    public function setEdge($x, $y, $w)
    {
        $this->u[$this->edges] = $x;
        $this->v[$this->edges] = $y;
        $this->w[$this->edges] = $w;
        $this->edges++;
    }

    public function setStartVertex($source)
    {
        for($i=1; $i<=$this->n; $i++)
        {
            $this->dis[$i] = PHP_INT_MAX;
            $this->path[$i] = $source;
        }

        $this->dis[$source] = 0;
    }

    public function exec()
    {
        for($k=1; $k<=$this->n-1; $k++)
        {
            for($i=1; $i<=$this->m; $i++)
            {
                $startVertex = $this->u[$i];
                $endVertex = $this->v[$i];

                if($this->dis[$endVertex] > $this->dis[$startVertex] + $this->w[$i])
                {
                    $this->dis[$endVertex] = $this->dis[$startVertex] + $this->w[$i];
                    $this->path[$endVertex] = $this->path[$startVertex] . '=>' . $endVertex;
                }
            }
        }

        //再次松弛所有边，如果发现松弛成功，则有负权回路
    }
}

$obj = new BellmanFord(5, 5);
$obj->setEdge(1, 2, -3);
$obj->setEdge(1, 5, 5);
$obj->setEdge(2, 3, 2);
$obj->setEdge(3, 4, 3);
$obj->setEdge(4, 5, 2);

$obj->setStartVertex(1);
$obj->exec();

echo '<pre/>';

//输出最短距离
print_r($obj->dis);

//输出路径
print_r($obj->path);



/*

松弛过程：
    第一轮对所有边松弛后，得到源点只能经过一条边到达其余各顶点的最短路径长度，
    第二轮对所有边松弛后，得到从源点最多经过2条边到达各顶点的最短路径长度(成功松弛的边不算在内)，
    如果进行k轮松弛，得到的是源点"最多经过k条边"到达其余各顶点的最短路径长度

    如果有n个顶点，源点需要经过n-1轮松弛顶点的过程，才能得到源点到其他顶点的最短路径。


关于最短路径为什么是一个不包含回路的简单路径?
    回路分为正权回路(回路权值之和为正)和负权回路(回路权值之和为负)，如果最短路径中包含正权回路，
    在去掉这个回路一定可以得到更短的路径，如果最短路径中包含负权回路，那么肯定没有最短路径，
    因为每多走一次负权回路就可以得到更短的路径，因此最短路径肯定是一个不包含回路的简单路径，即包含n-1条边。


检测是否有负权回路
    在经过n-1轮松弛后，最短路径所包含的边最多为n-1条，即进行了n-1次松弛之后最短路径是不会发生变化的。
    如果还能再次进行松弛，则该图必定存在负权回路。


Bellan-Ford的优化
    1. 在对所有边松弛过后，会有一些顶点已经确定了最短路径的值，它们是不会受到松弛的影响，但是算法仍然要判断是否进行松弛，
       所以算法只需要对最短路径估计值发生变化了的顶点的相邻边执行松弛操作，

       例如：
       I  : 1 2 3 4 5
       DIS: 0 1 - - 5
       顶点1是源点，1-2和1-5俩条边与源点松弛后使得源点到顶点2和顶点5之间的最短路径估算值变短了，
       因此只有通过2和5这俩个顶点的出边才可能使得源点到其他顶点的距离更短。


    2. Bellman-Ford经常会在n-1次松弛前就已经计算出了源点的最短路径，
       所以将上一次松弛的数据与当前松弛的数据进行比较，如果一致则返回结果。

*/