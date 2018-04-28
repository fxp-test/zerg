<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/16
 * Time: 15:02
 */

namespace app\api\model;


class Category extends BaseModel
{
    protected $hidden = ['create_time', 'delete_time', 'update_time'];

    public function img()
    {
        return $this -> belongsTo('Image', 'topic_img_id', 'id');
    }
}