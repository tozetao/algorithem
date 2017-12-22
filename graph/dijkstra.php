<?php

/**
 * 单源最短路径
 *    一个顶点到其他顶点的最短路径，通过边实现松弛。
 *    主要思想是通过边来松弛1个顶点到其余各个顶点的路程。
 *
 *
 *    每次找到离源点最近的一个顶点，然后通过该顶点进行扩展，
 *    计算源点到顶点到扩展顶点的距离，再从扩展顶点中寻找离源点最近的一个顶点进行扩展
 *    最后得到源点到其余所有点的最短路径。
 */
class Dijkstra
{
    public $n;
    public $martix;

    public $path;

    //标记最短路径的顶点
    public $book;

    //存储源点到其他点的距离
    //这里只统计了距离，但是不知道源点到其他点之间经过了哪些顶点，在算法结束后将会统计出源点到其他点的最短距离
    public $queue;

    public function __construct($n)
    {
        $this->n = $n;
        $this->queue = array();
        $this->path = array();
        $this->max = PHP_INT_MAX;

        for($i=0; $i<=$n+1; $i++)
        {
            //初始化图，行代表顶点，列代表与其他顶点的关系
            //矩阵第i行第j列代表第i个顶点与第j个顶点边的关系
            for($j=0; $j<=$n+1; $j++)
            {
                if($i == $j)
                    $this->martix[$i][$j] = 0;
                else
                    $this->martix[$i][$j] = $this->max;
            }
            $this->book[$i] = 0;
        }
    }

    //无向图顶点的关联
    public function setCoordinate($x, $y, $dis)
    {
        $this->martix[$x][$y] = $dis;
    }

    //初始化要搜点
    public function initQueue($source)
    {
        $this->queue = $this->martix[$source];
        unset($this->queue[0]);
        unset($this->queue[$this->n+1]);
        $this->book[$source] = 1;
        $this->path[] = $source;
    }

    //book, 标记最短路径的顶点
    //queue, 记录源点到其他顶点的距离
    public function exec()
    {
        //标记最近顶点
        $nearest = 0;

        //存储源点到最短路径顶点之间的路径
        for($i=1; $i<=$this->n-1; $i++)
        {
            $min = PHP_INT_MAX;

            //寻找离源点最近的顶点
            for($j=1; $j<=$this->n; $j++)
            {
                //属于未知最短路径顶点 同时满足 小于上一个离1号顶点最近点的距离
                if($this->book[$j] == 0 && ($this->queue[$j] < $min))
                {
                    $min = $this->queue[$j];
                    $nearest = $j;
                }
//                echo '<br/>';
            }
//
//            print_r($this->queue);
//            print_r($this->book);
//            echo '<br/>', '<br/>';
//
            $this->path[] = $nearest;
            $this->book[$nearest] = 1;

            //计算源点 => 最近顶点 => 与最近顶点关联的各个顶点之间的距离
            //这个步骤叫做边的松弛
            for($v=1; $v<=$this->n; $v++)
            {
                if($this->martix[$nearest][$v] < PHP_INT_MAX)
                {
                    if($this->queue[$v] > $this->queue[$nearest] + $this->martix[$nearest][$v])
                    {
                        $this->queue[$v] = $this->queue[$nearest] + $this->martix[$nearest][$v];
                    }
                }
            }

        }
    }
}


echo '<pre/>';

$obj = new Dijkstra(6);
$obj->setCoordinate(1, 2, 1);
$obj->setCoordinate(1, 3, 12);
$obj->setCoordinate(2, 3, 9);
$obj->setCoordinate(2, 4, 3);
$obj->setCoordinate(3, 5, 5);
$obj->setCoordinate(4, 3, 4);
$obj->setCoordinate(4, 5, 13);
$obj->setCoordinate(4, 6, 15);
$obj->setCoordinate(5, 6, 4);

$obj->initQueue(1);
$obj->exec();

print_r($obj->queue);
print_r($obj->path);