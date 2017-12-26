<?php

class Vertex
{
    public $current;
    public $parent;
}

/**
 * 寻找指定顶点(图的广度优先遍历)
 */
class LeastBFS
{
    private $martix;
    private $n;

    private $book;

    public $queue;

    private $head;
    private $tail;

    private $targetVertex;
    public $flag;

    public function __construct($n)
    {
        $this->head = 0;
        $this->tail = 0;
        $this->flag = false;
        $this->n = $n;

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

    public function setRelation($x, $y)
    {
        $this->martix[$x][$y] = 1;
        $this->martix[$y][$x] = 1;
    }

    //$current：当前顶点
    public function bfs($current)
    {
        $vertex = new Vertex();
        $vertex->parent = null;
        $vertex->current = $current;

        $this->queue[] = $vertex;
        $this->tail++;
        $this->book[$current] = 1;

        while($this->head < $this->tail)
        {
            $current = $this->queue[$this->head]->current;

            //寻找current的关联顶点
            for($i=1; $i<=$this->n; $i++)
            {
                if($this->martix[$current][$i] == 1 && $this->book[$i] == 0)
                {
                    $sonVertex = new Vertex();
                    $sonVertex->parent = $this->queue[$this->head];
                    $sonVertex->current = $i;

                    $this->book[$i] = 1;
//                    $this->queue[] = $i;
                    $this->queue[] = $sonVertex;
                    $this->tail++;


                    //判断是否搜索顶点
                    if($this->targetVertex == $i)
                    {
                        $this->flag = true;
                        break;
                    }
                }
            }

            if($this->flag) return;

            $this->head++;
        }
    }
}

echo '<pre>';

$obj = new LeastBFS(5);
$obj->setRelation(1, 2);
$obj->setRelation(1, 3);
$obj->setRelation(2, 3);
$obj->setRelation(2, 4);
$obj->setRelation(3, 4);
$obj->setRelation(3, 5);
$obj->setRelation(4, 5);
$obj->displayMartix();

$obj->setTargetVertex(5);
$obj->bfs(1);

print_r(array_pop($obj->queue));
//print_r($obj->queue);
var_dump($obj->flag);