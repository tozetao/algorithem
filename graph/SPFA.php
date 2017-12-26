<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/26 0026
 * Time: 9:45
 */

class SPFA_GH
{
    public $u;
    public $v;
    public $w;

    public $first;
    public $next;
    public $edges;

    public $queue;
    public $head;
    public $tail;

    public $dis;
    public $book;
    public $path;

    public function __construct($m, $n)
    {
        $this->u = array();
        $this->v = array();
        $this->w = array();

        $this->n = $n;

        $this->queue = array();
        $this->head = 1;
        $this->tail = 1;

        $this->first = array();
        $this->next = array();

        for($i=1; $i<=$n; $i++)
        {
            $this->dis[$i] = PHP_INT_MAX;
            $this->book[$i] = 0;
            $this->first[$i] = -1;
        }
    }

    //设置边
    public function setEdge($x, $y, $length)
    {
        $this->u[$this->edges] = $x;
        $this->v[$this->edges] = $y;
        $this->w[$this->edges] = $length;

        //边的起始顶点，如果起始顶点是相同的，代表着该起始顶点有多条边
        $startVertex = $this->u[$this->edges];

        //设置当前边的上一条边
        $this->next[$this->edges] = $this->first[$startVertex];

        //设置顶点的起始边
        $this->first[$startVertex] = $this->edges;

        $this->edges++;
    }

    //设置起始顶点
    public function setStartVertex($source)
    {
        //起始顶点入队
        $this->queue[$this->head] = $source;
        $this->tail++;
        $this->book[$source] = 1;

        //
        $this->dis[$source] = 0;

        for($i=1; $i<=$this->n; $i++)
        {
            $this->path[$i] = $source;
        }
    }

    //执行算法
    public function spfa()
    {
        while($this->head < $this->tail)
        {
            //取出队列首部顶点
            $curVertex = $this->queue[$this->head];

            //取出首部顶点的所有出边，并与源点进行松弛
            $edge = $this->first[$curVertex];
            while($edge != -1)
            {
                $svertex = $this->u[$edge];
                $evertex = $this->v[$edge];

                //做松弛处理
                if($this->dis[$evertex] > $this->dis[$svertex] + $this->w[$edge])
                {
                    $this->dis[$evertex] = $this->dis[$svertex] + $this->w[$edge];
                    $this->path[$evertex] = $this->path[$svertex] . '=>' . $evertex;

                    if($this->book[$evertex] == 0)
                    {
                        $this->queue[$this->tail] = $evertex;
                        $this->tail++;
                        $this->book[$evertex] = 1;
                    }
                }

                //取出首部顶点的下一条边
                $edge = $this->next[$edge];
            }

            $this->book[$curVertex] = 0;
            $this->head++;
        }
    }
}

$obj = new SPFA_GH(7, 5);
$obj->setEdge(1, 2, 2);
$obj->setEdge(1, 5, 10);
$obj->setEdge(2, 3, 3);
$obj->setEdge(2, 5, 7);
$obj->setEdge(3, 4, 4);
$obj->setEdge(4, 5, 5);
$obj->setEdge(5, 3, 6);

$obj->setStartVertex(3);
$obj->spfa();

echo '<pre/>';

//输出最短距离
print_r($obj->dis);

//输出路径
print_r($obj->path);

/*
1 2 2
1 5 10
2 3 3
2 5 7
3 4 4
4 5 5
5 3 6
*/


/*
Bellman Ford算法优化
    每次仅对最短路程发生变化了的顶点的相邻边执行松弛操作。

    只有那些在前一遍松弛中改变了最短路径估计值的顶点，才可能引起它们邻接点最短路径估计值发生改变。
    因此用一个队列来存放被成功松弛的顶点，只对队列中的点进行处理，这样降低了算法复杂度。

算法过程
    - 将待搜索的源点加入队列中

    - 每次选取队列首部顶点u，对顶点u的所有出边进行松弛操作(出边是指关联顶点u的边)。

    - 如果通过顶点u的出边松弛成功，则将出边的尾部顶点v加入队列中(不能重复)，在对顶点u的所有出边松弛完毕后，就将顶点u出队。

    - 不断的从队列中取出新的队首顶点再进行如上操作，直到队列为空为止。




*/
