<?php
/**
 * Created by PhpStorm.
 * User: fxp
 * Date: 2018/3/9
 * Time: 14:46
 */

namespace app\api\model;


use think\Model;

class Banner extends Model
{
    protected $hidden = ['update_time', 'delete_time'];

    public function items()
    {
        return $this -> hasMany('BannerItem', 'banner_id', 'id');
    }

    public static function getBannerById($id)
    {
        $banner = self::with(['items', 'items.img'])
            -> find($id);
        return $banner;
    }
}