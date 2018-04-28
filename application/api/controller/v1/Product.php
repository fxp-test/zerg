<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/16
 * Time: 14:18
 */

namespace app\api\controller\v1;

use app\api\model\Product as ProductModel;
use app\api\validate\Count;
use app\api\validate\IDMustPositiveInt;
use app\lib\exception\ProductException;

class Product
{
    public function getRecent($count = 15)
    {
        (new Count()) -> goCheck();
        $products = ProductModel::getMostRecent($count);
        if ($products -> isEmpty()) {
            throw new ProductException();
        }
        $products = $products -> hidden(['summary']);
        return json($products);
    }

    public function getAllInCategory($id)
    {
        (new IDMustPositiveInt()) -> goCheck();
        $products = ProductModel::getProductsByCategoryID($id);
        if ($products -> isEmpty()) {
            throw new ProductException();
        }
        return json($products);
    }

    public function getOne($id)
    {
        (new IDMustPositiveInt()) -> goCheck();
        $product = ProductModel::getProductDetail($id);

        if (!$product) {
            throw new ProductException();
        }

        return $product;
    }

    public function deleteOne($id)
    {

    }
}