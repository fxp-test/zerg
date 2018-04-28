<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/15
 * Time: 14:57
 */

namespace app\api\model;

use app\api\model\Product as ProductModel;

class Product extends BaseModel
{
    protected $hidden = ['update_time', 'delete_time', 'create_time', 'from', 'category_id', 'main_img_id', 'pivot'];

    public function getMainImgUrlAttr($value, $data)
    {
        return $this -> prefixImgUrl($value, $data);
    }

    public function imgs()
    {
        return $this -> hasMany('ProductImage', 'product_id', 'id');
    }

    public function properties()
    {
        return $this -> hasMany('ProductProperty', 'product_id', 'id');
    }

    public static function getMostRecent($count)
    {
        $products = self::limit($count)
            -> order('create_time desc')
            -> select();
        return $products;
    }

    public static function getProductsByCategoryID($categoryID)
    {
        $products = self::where('category_id', '=', $categoryID)
            -> select();
        return $products;
    }

    public static function getProductDetail($id)
    {
        $products = self::with([
                'imgs' => function($query){
                    $query -> with(['imgUrl'])
                        -> order('order','asc');
                }
            ])
            -> with(['properties'])
            -> find($id);
        return json($products);
    }
}