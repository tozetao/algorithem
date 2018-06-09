<?php

/**
 * 分发接口定义
 */
interface Dispatch
{
    public function addNode($serverKey);

    public function deleteNode($serverKey);

    public function lookup($requestKey);

    public function _hash($key);
}

/**
 * 一致性哈希实现
 * Class Consistent
 */
class Consistent implements Dispatch
{
    public $numberOfNodes;

    /**
     * @var 真实主机节点
     */
    public $realNodes;

    /**
     * key是虚拟节点，值是真实主机
     */
    public $virtualNodeMap;

    /**
     * 有序的虚拟节点列表
     */
    public $orderedVirtualNodes;

    public function __construct()
    {
        $this->numberOfNodes = 500;
    }

    public function _hash($key)
    {
        //哈细化可以使用crc32()函数，返回的是32位的整数
        return md5($key);
    }

    /**
     * @param $serverKey    主机key，假设是ip地址
     * @return bool
     */
    public function addNode($serverKey)
    {
        if(empty($serverKey))
            return false;

        $this->counts[$serverKey] = 0;
        $this->realNodes[] = $serverKey;

        //虚拟1000个节点
        for($i=0; $i < $this->numberOfNodes; $i++)
        {
            $key = $this->_hash($serverKey . '-' . $i);
            $this->virtualNodeMap[$key] = $serverKey;
            $this->orderedVirtualNodes[] = $key;
        }

        sort($this->orderedVirtualNodes);
        return true;
    }

    public function deleteNode($serverKey)
    {
        if(empty($serverKey))
            return false;

        for($i=0; $i < $this->numberOfNodes; $i++)
        {
            $key = $this->_hash($serverKey . '-' . $i);
            if(isset($this->virtualNodeMap[$key]))
                unset($this->virtualNodeMap[$key]);
        }

        return true;
    }

    public function lookup($requestKey)
    {
        $hash = $this->_hash($requestKey);

        if(empty($this->orderedVirtualNodes))
            return false;

        /*
        //寻找要分发的服务器
        $targetServer = '';
        $length = count($this->orderedVirtualNodes);
        for($i=0; $i < $length; $i++)
        {
            if(strcmp($hash, $this->orderedVirtualNodes[$i]) <= 0)
            {
                $targetServer = $this->orderedVirtualNodes[$i];
                break;
            }
        }
        //哈希值大于所有虚拟节点情况下，默认第一台服务器
        $targetServer = $targetServer == '' ? current($this->orderedVirtualNodes): $targetServer;
        */
        $targetServer = $this->findByBinary($this->orderedVirtualNodes, $hash, 0, count($this->orderedVirtualNodes)-1);

        $this->count($this->virtualNodeMap[$targetServer]);

        return $this->virtualNodeMap[$targetServer];
    }

    public $counts = [];

    public function count($key)
    {
        $this->counts[$key]++;
    }

    public function findByBinary($array, $value, $left, $right)
    {
        if($left >= $right)
        {
            if(strcmp($value, $array[$left]) < 0)
                return $array[$left];
            elseif(strcmp($value, $array[$left]) > 0)
                //a > b，返回left的下一个素银位置，如果越界代表着left是最后一个索引，因此返回第一个数值
                return isset($array[$left+1]) ? $array[$left+1] : $array[0];
            else
                return $array[$left];
        }

        $middle = floor(($left + $right) / 2);

        if(strcmp($value, $array[$middle]) < 0)
        {
            return $this->findByBinary($array, $value, $left, $middle - 1);
        }
        else if(strcmp($value, $array[$middle]) > 0)
        {
            return $this->findByBinary($array, $value, $middle + 1, $right);
        }
        else
        {
            return $array[$middle];
        }
    }

}

function randomStr()
{
    $str = "abcdefghijklmnopqrstuvwsyz12348597890";
    $tmp = '';
    for($i=0; $i<5; $i++)
    {
        $index = mt_rand(0, strlen($str)-1);
        $tmp .= $str[$index];
    }

    return $tmp;
}





$consistent = new Consistent();
$consistent->addNode('159.15.15.90');
$consistent->addNode('159.15.15.91');
$consistent->addNode('159.15.15.92');
$consistent->addNode('159.15.15.93');
$consistent->addNode('159.15.15.94');

// $consistent->lookup(randomStr());

for($i=0; $i<100000; $i++)
{
//    $consistent->lookup(randomStr());
    $consistent->lookup('name' . '-' . $i);
}

echo '<pre/>';
print_r($consistent->counts);

/*
*/

/*
function findByBinary($array, $value, $left, $right)
{
    if($left >= $right)
    {
        if(strcmp($value, $array[$left]) < 0)
            return $array[$left];
        elseif(strcmp($value, $array[$left]) > 0)
            //a > b，返回left的下一个素银位置，如果越界代表着left是最后一个索引，因此返回第一个数值
            return isset($array[$left+1]) ? $array[$left+1] : $array[0];
        else
            return $array[$left];
    }

    $middle = floor(($left + $right) / 2);

    if(strcmp($value, $array[$middle]) < 0)
    {
        return findByBinary($array, $value, $left, $middle - 1);
    }
    else if(strcmp($value, $array[$middle]) > 0)
    {
        return findByBinary($array, $value, $middle + 1, $right);
    }
    else
    {
        return $array[$middle];
    }
}

function findByBinary($array, $value, $left, $right)
{
    if($left >= $right)
    {
        if($array[$left] > $value)
            return $array[$left];
        elseif($array[$left] < $value)
            //a > b，返回left的下一个素银位置，如果越界代表着left是最后一个索引，因此返回第一个数值
            return isset($array[$left+1]) ? $array[$left+1] : $array[0];
        else
            return $array[$left];
    }

    $middle = floor(($left + $right) / 2);

    if($array[$middle] > $value)
    {
        return findByBinary($array, $value, $left, $middle - 1);
    }
    else if($array[$middle] < $value)
    {
        return findByBinary($array, $value, $middle + 1, $right);
    }
    else
    {
        return $array[$middle];
    }
}

echo '<pre/>';
$array = [10, 20, 36, 87, 190, 250, 390];
$result = findByBinary($array, 250, 0, count($array)-1);
var_dump($result);
*/
// var_dump(strcmp(400, 87));

/*
//在一个有序数组中，寻找第一个大于参数的值
function findNext($array, $value)
{
    $tmp = current($array);

    for($i=0; $i<count($array); $i++)
    {
        if(strcmp($value, $array[$i]) <= 0)
        {
            $tmp = $array[$i];
            break;
        }
    }

    return $tmp;
}

echo '<pre/>';
// $array = [10, 20, 36, 87, 190, 250, 390];
// echo findNext($array, 400);

$hash1 = md5('first');
$hash2 = md5('second');
$hash3 = md5('third');
$hash4 = md5('fours');

$hashs = [$hash1, $hash2, $hash3, $hash4];
sort($hashs);

print_r($hashs);
$value = md5('fsdjlfsklf');
echo $value, '<br/>';
echo findNext($hashs, $value);
*/