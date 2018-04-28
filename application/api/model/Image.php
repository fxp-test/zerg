<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/14
 * Time: 16:11
 */

namespace app\api\model;


class Image extends BaseModel
{
    protected $hidden = ['id', 'from', 'update_time', 'delete_time'];

    public function getUrlAttr($value, $data)
    {
        return $this -> prefixImgUrl($value, $data);
    }
}