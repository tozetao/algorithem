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

    //标记最短路径的顶点
    public $book;

    //存储源点到其他点的距离
    //这里只统计了距离，但是不知道源点到其他点之间经过了哪些顶点，在算法结束后将会统计出源点到其他点的最短距离
    public $queue;

    public function __construct($n)
    {
        $this->n = $n;
        $this->queue = array();

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

            $this->queue[] = PHP_INT_MAX;
        }
    }

    //无向图顶点的关联
    public function setCoordinate($x, $y, $dis)
    {
        $this->martix[$x][$y] = $dis;
    }

    //book, 标记最短路径的顶点
    //queue, 记录源点到其他顶点的距离
    public function exec()
    {
        //标记最近顶点
        $nearest = 0;
        $min = PHP_INT_MAX;

        for($i=1; $i<=$this->n-1; $i++)
        {
            //寻找离1号顶点最近的点
            for($j=1; $j<=$this->n; $j++)
            {
                //属于未知最短路径顶点 同时满足 小于上一个离1号顶点最近点的距离
                if($this->book[$j] == 0 && $this->queue[$j]<$min)
                {
                    $min = $this->queue[$j];
                    $nearest = $j;
                }
            }

            $this->book[$nearest] = 1;

            //松弛最近顶点与关联顶点的边 => 以此计算源点到关联顶点边的距离
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


//P：最短路径顶点的集合
//Q：未知最短路径顶点的集合