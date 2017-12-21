<?php
/**
* 计算面积
*/
class Map
{
	//矩阵
	private $martix;

	//方向
	private $next;

	//矩阵大小，该值将会比真实矩阵大小大于2
	private $n;

	public function __construct()
	{
		$this->n = 51;

		for($i=0; $i<=$this->n; $i++)
		{
			for($j=0; $j<=$this->n; $j++)
			{
				$this->martix[$i][$j] = 0;
			}
		}
	}

	//广度优先搜索
	public function bfs()
	{

	}

	//深度有限搜索，depth
	public function dfs()
	{

	}
}