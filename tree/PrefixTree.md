#### 前缀树

前缀树一般用于字符串检索；与其他树不同，前缀树的节点不保存具体的数据，而是由边来代表数据，节点只存储相对于边的数据；

节点落地结构

```php
class TireNode
{
    public $path;
    public $end;
    public $map;
}
```

- path：该变量表示有多少条边经过该节点，由于边对应着具体的字符，也表示有多少个字符经过该节点，可以用于计算一个字符作为前缀出现的次数。
- end：该变量表示以当前节点作为结束点的次数出现的次数
- map：映射每天边所对应的下一个节点

API

- search
- insert
- delete
