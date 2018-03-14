<?php
/*
 * 账号类型的不同，数据库的初始化方式也不同；


- 初始化数据库的动作依赖接口
	功能一致的情况下，使用中央府连接动作

- 如果一个功能在不同类型的账号下初始化动作会不同，那么由它账号类型的DB对象来进行初始化
	如果是酒吧，直接读取自己的DB账号
	如果是平台，会预先查询缓存，如果缓存不存在配置，将会连接中央府


- 根据账号的不同，GameServer获取DB配置的动作也不同，这样就解决了
 */

interface DBRouter
{
    //返回缓存的DB配置
    public function getDBCache();
    
    //连接动作
    public function connection();
}

class DefaultDBRouter implements DBRouter
{
    public function getDBCache()
    {
        
    }

    public function connection()
    {

    }
}