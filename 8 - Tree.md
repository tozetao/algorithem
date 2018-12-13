### 树

树是不包含回路的连同无向图，因为树不包含回路，所以有以下特点：

- 一棵树中的任意俩个节点有且仅有唯一的一条路径通道
- 一棵树如果有n个节点，那么它一定有n-1条边



### 节点类型

在一棵树中，节点可以分为三种类型。

- 根节点，一棵树最顶端的节点，没有父节点。

- 叶子节点：没有子节点的节点被称为叶子节点。
- 中间节点：有父节点也有子节点。



### 二叉树

每个节点最多有俩个子树的数被称为二叉树。二叉树中有俩种特殊类型的数，分别是满二叉树和完全二叉树。

- 满二叉树

  直译的话就是这棵树的节点满了，是一颗完整的树。

  假设满二叉树的深度为h，那么它会有$2^h-1$个节点。

完全二叉树的定义：一棵二叉树除了最后一层节点其它层的节点数都达到最大的个数，同时最后一层节点是从右往左连续缺失的话，那么这棵二叉树就是完全二叉树。

完全二叉树有以下特点：假设节点数量为N，那么树的高度是$log(N)$。它的最后一个非叶子节点位于$N/2$（如果通过数组模拟）。



### 树的遍历

- 先序遍历

  先中，再左，再右。

  先打印当前节点，再打印左子树，再打印右子树。打印俩颗子树也是遵循先中在做再右的原则。

- 中序遍历

  先左，再中，再右。

  对于每一颗子树都是先打印左子树上的节点，再打印中间节点，再打印右子树上的节点。

- 后续遍历

  先左，再右，再中。

  对于每颗子树都是先打印左子树上的节点，再打印右子树上的节点，最后打印中间节点。

递归的实现：最小任务是打印节点，只不过打印的顺序不同。



如果你想要通过栈或者队列来实现循环，首先各个元素是有关联关系，然后存储第一个元素，判断容器不等于空等行为来实现循环。



#### 先序遍历

栈实现：

- 将头节点加入栈中。
- 弹出栈顶节点并输出节点，然后添加右节点，再添加左节点。
- 重复第二个步骤直到栈为空。

如果将先序遍历的结果倒序输出的话，等价于先右、再左、再中的输出顺序。



#### 中序遍历

每一颗子树都是先左再中再右，栈实现：

- 将当前节点以及当前节点的所有左子节点压入栈中，然后依次从栈中弹出节点，弹出时输出节点，并移动到右节点。

  输出处理的顺序为先左、再中的顺序。

- 而移动到右子节点的时候，将右子节点以及右子节点的所有左子节点压入栈中，弹出时输出节点。

- 处理的顺序也是先左、再中。

- 因此从整体的顺序看就变成先左、再中、再右。

中序遍历的输入结果倒序输出等价于先右，再中，再左。



#### 后续遍历

栈实现

- 遍历整棵树，实现先中、再右、再左的输出顺序，并将输出结果用另外一个辅助栈存储起来。
- 循环结束后将辅助栈依次弹出并输出，输出结果就是先左、再右、再中。

结论：先中、再右、再左的输出结果存储起来后倒序输出，输出顺序刚好是后续遍历的顺序。







### 题目1

> 随时找到数据流的中位数。
>
> 有一个源源不断吐出整数的数据流，假设你有足够的空间来保存吐出的数，请设计一个名叫MedianHolder的结构，可以随时取的之前吐出的所有数的中位数。
>
> 要求1：如果MedianHolder已经保存了吐出的数，那么任意时刻将一个新数加入到MedianHolder的过程，其时间复杂度是O(logN)。
>
> 要求2：取的已经吐出的N个数整体的中位数的过程，时间复杂度为O(1)

思路：假设有个数据结构能够存储前2/n的数，同时能取出最大的数；又有个数据结构能够存储后2/n的数，同时能取出最小的值，那么就可以解决随时取出中位数的问题。可以通过堆结构来解决，使用大根堆来存储前2/n的数，使用小根堆来存储后2/n的数。

add() API的设计

- 准备一个大根堆，一个小根堆。

- 大根堆要存储小于等于堆顶的数，小根堆存储大于大根堆堆顶的数。

- 如果俩个堆的大小相差的绝对值超过1，这时候堆的大小不平等，可以把尺寸大的堆中弹出一个数据项加入到尺寸小的堆中，这时候俩个堆的大小保持平衡。

poll()API的设计

- 弹出中位数的过程中，如果俩个堆的大小相等，可以随意在任意一个堆中弹出数据项。如果不相等，让尺寸大的堆中弹出数据项；同时要注意俩个堆的大小是否保持平衡。



### 题目2

> 哈夫曼编码问题。
>
> 一块金条切成俩半，是需要花费和长度数值一样的铜板的，比如长度20的金条不管切割成多大的俩半，都需要花费20铜板，一群人想要分整块金条，怎么分最省铜板。
>
> 例如给定数组10 20 30，代表一共3个人，整块金条长度10+20+30=60，金条要分成10、20、30三个部分。
>
> 如果先把金条分成10和50，花费60铜板，再将50分成20+30，花费50铜板，一共花费110；如果将金条分成30和30，花费60，再将30分成10和20，花费30，一共花费90。
>
> 要求输入一个数组，返回分割的最小代价。

思路：这是一个哈夫曼编码问题，该问题的本质是求所有非叶子节点代价的总和。

例如上面的例子中：

​          60

​     30       30

10       20

将要分割的目标值10、20、30放入一个最小堆中，每次取出俩个最小的数进行合并，这个就是节点合并代价，10和20的合并代价是30。

然后将30放入堆中，再取出俩个最小的值进行合并，第二次合并是30和30，合并代价是60，然后60丢入堆中，当堆只有一个数时就是最后一次的合并代价，这时候计算完毕。



### 题目3

> 假设有以下输入：
>
> 参数1，正数数组costs；参数2，正数数组profits；参数3，正数k；参数4，正数m。
>
> 其中costs[i]表示i号项目的花费，profits[i]表示i号项目的收益，参数k表示只允许串行做的项目，m表示初始资金。
>
> 说明：你每做完一个项目，马上获得的收益，可以支持你去做下一个项目。
>
> 要求你计算出最后获得的最大钱数。

思路：k表示允许做的项目数量，要获得最多的收益金钱树，那么只能在这多个项目中挑选出收益最大的且花费资金足够的项目来做了。

- 定义一个小根堆，以花费资金作为大小来存储项目；定义一个大根堆，以收益大小来存储项目，初始化时俩个堆都为空。

- 将项目添加到小根堆中，取出当前资金允许做的项目同时添加到大根堆中。

- 从大根堆中取出收益最高的项目，累计做完项目后的收益。
- 重复上述过程直到小根堆为空同时满足允许做大做的项目数，计算后的收益就是最大收益金额了。



### 题目4

> 请把一段纸条放在桌子上，然后从纸条的下边向上方对折一次，压出折痕后展开，此时折痕是凹下去的，即折痕突起的方向指向纸条的背面，如果从纸条的下边向上对折俩次，压出折痕后展开，此时有3条折痕，从上到下依次是下折痕、下折痕和上折痕。
>
> 要求：给定一个输入参数N，代表纸条从下向上连续对折n次，请从上到下打印所有折痕的方向。
>

分析：如果对折n次，将产生2^n-1个折痕，联想满二叉树。

从上到下将折痕建立成一颗满二叉树，你会这棵树的头节点为下折痕，每颗左子树的头节点都为下折痕，每颗右子树的头结点都为上折痕。

打印的方式其实是二叉树的中序遍历，只需要通过一个参数来区分左子树和右子树。



### 题目5

```java
public class Node{
    public int value;
    public Node left;
    public Node right;
    public Node parent;

    public Node(int value){
        this.value = value;
    }
}
```

> 该结构比普通的二叉树多出一个指向父节点的parent指针。
>
> 假设有一颗Node类型的节点组成的二叉树，树中每个节点的parent指针都正确的指向自己的父节点，头结点的parent指向null，只给二叉树中的某个节点，请实现返回Node的后继节点的函数。
>
> 注：在二叉树的中序遍历中，node的下一个节点叫做node的后继节点。

思路：根据先左、再中、再右，考虑节点分别在这三种位置下的情况。

- 该节点如果有右子节点，根据先左、再中、再右，该节点是中间节点，因此右子节点的最左节点就是它的后继节点。

- 该节点没有右子节点时，如果节点是左节点，那么它的父节点就是它的后继节点；

  如果节点是右节点，那么向上寻找节点，如果向上寻找的某个节点是它的父节点的左子节点，那么该父节点就是节点的后继节点。



### 题目6

> 在数组中找到一个局部最小的位置。
>
> 定义局部最小的概念：
>
> array[0]小于array[1]，array[0]是局部最小的；array[N-1] < array[N-2]，array[N-1]是最小的。这是头部元素与尾部元素的局部最小概念。
>
> 对于中间的数来说，array[i]小于array[i-1]，同时小于array[i+1]，那么array[i]被称为局部最小。
>
> 给定无需数组array，已知数组中任意相邻的俩个数不相等。写一个函数，只需要返回array中任意一个局部最小出现的位置即可。





### 题目7

> 一个字符串类型的数组array1，另外一个字符串数组array2。
>
> 判断array2中有哪些字符是array1中出现的，请打印出来。