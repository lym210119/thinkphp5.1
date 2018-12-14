<?php

namespace app\user\model;

use think\Model;

class User extends Model
{
    // 定义数据表名
    protected $table = 'users';

    // 定义时间戳字段名
    protected $createTime = 'created_at';
    protected $updateTime = 'updated_at';
    
    // 定义运行操作的字段
    protected $field = ['name', 'email', 'password', 'avatar'];

    // 设置修改器
    public function setPasswordAttr($value)
    {
        return password_hash($value, PASSWORD_DEFAULT); // password_hash 是 PHP 语言内置的一个 非对称加密
    }

    public function setEmailAttr($value)
    {
        return strtolower($value);  // strtolower 将字符串转化为小写
    }
}
