<?php
/**
 * Created by PhpStorm.
 * User: fxp
 * Date: 2018/3/8
 * Time: 17:04
 */

namespace app\api\controller\v1;


use app\api\model\Banner as BannerModel;
use app\api\validate\IDMustPositiveInt;
use app\lib\exception\BannerMissException;

class Banner
{
    /**
     * 获取指定id的banner信息
     * @url /banner/:id
     * @http GET
     * @id banner的id号
     */
    public function getBanner($id)
    {
        (new IDMustPositiveInt()) -> goCheck();

        $banner = BannerModel::getBannerByID($id);
        if (!$banner) {
            throw new BannerMissException();
        }
        return json($banner);
    }


}