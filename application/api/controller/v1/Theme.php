<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/15
 * Time: 14:56
 */

namespace app\api\controller\v1;


use app\api\model\Theme as ThemeModel;
use app\api\validate\IDCollection;
use app\api\validate\IDMustPositiveInt;
use app\lib\exception\ThemeException;

class Theme
{
    /**
     * @url /theme?ids=id1,id2,id3,...
     * @return 一组theme模型
     */
    public function getSimpleList($ids = '')
    {
        (new IDCollection()) -> goCheck();
        $ids = explode(',', $ids);
        $result = ThemeModel::with(['topicImg', 'headImg'])
            -> select($ids);
        if ($result -> isEmpty()) {
            throw new ThemeException();
        }
        return json($result);
    }

    /**
     * @url /theme/:id
     */
    public function getComplexOne($id)
    {
        (new IDMustPositiveInt()) -> goCheck();
        $theme = ThemeModel::getThemeWithProducts($id);
        if (!$theme) {
            throw new ThemeException();
        }
        return json($theme);
    }
}
