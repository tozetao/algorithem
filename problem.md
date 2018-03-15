
- 问题：一个long long型无序数组中，如果排好序后求相邻俩个数的最大差值，要求时间复杂度为O(N）
    1. 数据在有序的情况下，俩俩比较才能求出最大差值
    2. 从无序到有序下，普通排序算法时间复杂度不满足要求，使用数值范围的桶排序也不满足要求，需要使用桶排序的思想来改进算法。

- 猫狗队列
    起始就是归并排序的外排序过程



#### 链表

- 俩个有序的链表，要求查询出相同数据的节点

- 题目：
    复制含有随机指针节点的链表。
    public class Node{
        public int value;
        public Node next;
        public Node rand;

        public Node(int data){
            this.value = data;
        }
    }

- 链表还有一道题目没做完

### Hash
- 哈希函数实现
- HashTable实现
- 一致性哈希
- 布隆过滤器

 