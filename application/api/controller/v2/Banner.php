<?php
/**
 * Created by PhpStorm.
 * User: fxp
 * Date: 2018/3/8
 * Time: 17:04
 */

namespace app\api\controller\v2;


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
        return 'This is V2 Version';
    }


}