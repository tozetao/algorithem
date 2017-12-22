<?php

/**
 * 求任意俩点之间的最短路径(多源最短路径)
 *
 * Floyd是指从i顶点到j顶点之间经过前k号点的最短路径，
 * 该算法不能解决复权回路，如果俩个顶点的边是负数，这俩个顶点A/B在经过相邻的顶点C，A-B-C是是没有最短路径的。
 *
 * 该算法的时间复杂度是N^3
 *
 */
class Floyd
{
    //边的数量和边的最大值决定了max的大小
    public $max = 99999;

    //矩阵，用于表示图顶点与顶点之间的关系
    public $martix;

    //顶点数量
    private $n;

    private $sum;

    public function __construct($n)
    {
        $this->n = $n;
        $this->sum = 0;

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
        }
    }

    public function displayMartix()
    {
        $table = '<table>';

        $tr = '';
        for($i=1; $i<=$this->n; $i++)
        {
            $tr .= '<tr>';
            $td = '';
            for($j=1; $j<=$this->n; $j++)
            {
                if($this->martix[$i][$j] == $this->max)
                    $td .= '<td>-</td>';
                else
                    $td .= '<td>' . $this->martix[$i][$j] . '</td>';
            }
            $tr .= $td .  '</tr>';
        }

        $table .= $tr . '</table>';
        return $table;
    }

    //无向图顶点的关联
    public function setCoordinate($x, $y, $dis)
    {
        $this->martix[$x][$y] = $dis;
    }

    public function floydWarshall()
    {

        for($k=1; $k<=$this->n; $k++)
        {
            for($i=1; $i<=$this->n; $i++)
            {
                for($j=1; $j<=$this->n; $j++)
                {
                    if($this->martix[$i][$j] > ($this->martix[$i][$k] + $this->martix[$k][$j]))
                    {
                        $this->martix[$i][$j] = $this->martix[$i][$k] + $this->martix[$k][$j];
                    }
                }
            }
        }
    }
}

$floyd = new Floyd(4);

/*
    1 2 2
    1 3 6
    1 4 4
    2 3 3
    3 1 7
    3 4 1
    4 1 5
    4 3 12
*/
$floyd->setCoordinate(1,2,2);
$floyd->setCoordinate(1, 3, 6);
$floyd->setCoordinate(1, 4, 4);
$floyd->setCoordinate(2, 3, 3);
$floyd->setCoordinate(3, 1, 7);
$floyd->setCoordinate(3, 4, 1);
$floyd->setCoordinate(4, 1, 5);
$floyd->setCoordinate(4, 3, 12);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style type="text/css">
        table td{
            width: 30px;
            height:20px;
        }
    </style>
</head>
<body>
    <?=$floyd->displayMartix()?>
    <br><br><br>

<?php
    $floyd->floydWarshall();
?>

    <?=$floyd->displayMartix()?>

</body>
</html>
