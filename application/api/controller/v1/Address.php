<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/20
 * Time: 10:29
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\model\User as UserModel;
use app\api\service\Token as TokenService;
use app\api\validate\AddressNew;
use app\lib\exception\SuccessMessage;
use app\lib\exception\UserException;

class Address extends BaseController
{
    //  前置操作的权限校验
    protected $beforeActionList = [
        'checkPrimaryScope' => ['only' => 'createOrUpdateAddress']
    ];

    public function createOrUpdateAddress()
    {
        $validate = new AddressNew();
        $validate->goCheck();

        //  根据Token来获取uid
        //  根据uid来查找用户数据，判断用户是否存在，如果不存在则抛出异常，
        //  获取用户从客户端提交过来的地址信息
        //  根据用户地址信息是否存在，从而判断是添加地址还是更新地址

        $uid = TokenService::getCurrentUid();
        $user = UserModel::get($uid);
        if (!$user) {
            throw new UserException();
        }

        $data = $validate->getDataByRule(input('post.'));

        $userAddress = $user->address;
        if (!$userAddress) {
            $user->address()->save($data);
        } else {
            $user->address->save($data);
        }
        return json(new SuccessMessage(), 201);
    }
}