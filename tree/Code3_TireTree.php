<?php

class TireNode
{
    public $path;
    public $end;

    //边所能到达的节点
    public $nexts = array();

    public function __construct()
    {
        $this->path = 0;
        $this->end = 0;
    }
}

/**
 * 前缀树
 */
class TireTree
{
    public $root;

    public function __construct()
    {
        $this->root = new TireNode();
    }

    public function insert($str)
    {
        $current = $this->root;

        for($i=0; $i<strlen($str); $i++)
        {
            $char = $str[$i];

            //判断当前节点是否有出边
            if(!isset($current->nexts[$char]))
            {
                $current->nexts[$char] = new TireNode();
                $current->nexts[$char]->path++;
            }
            else
            {
                $current->nexts[$char]->path++;
            }

            $current = $current->nexts[$char];
        }
        $current->end++;
    }

    public function search($str)
    {
        $current = $this->root;

        for($i=0; $i<strlen($str); $i++)
        {
            $char = $str[$i];

            //是否有出边
            if(!$current->nexts[$char])
                return 0;

            $current = $current->nexts[$char];
        }

        return $current->end;
    }

    public function delete($str)
    {
        $current = $this->root;

        for($i=0; $i<strlen($str); $i++)
        {

        }
    }

    //前缀统计
    public function prefixNums()
    {

    }
}

$tireTree = new TireTree();
$tireTree->insert('abc');
$tireTree->insert('abe');
$tireTree->insert('bcd');

echo '<pre/>';
//print_r($tireTree->root);
var_dump($tireTree->search('abc'));