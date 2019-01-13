<?php
/**
 * Created by PhpStorm.
 * User: fitz
 * Date: 1/12/19
 * Time: 9:34 AM
 */

namespace app\index\controller;

use app\index\model\LoginResult;
use app\index\service\Database;
use app\index\tools\Token;
use think\Request;

class Login
{

    /**
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function login()
    {
        $database = new Database();
        $loginJson = new LoginResult();
        $token = null;

        $request = Request::instance();
        $param = $request->param();
        $data = $database->login($param);

        if (count($data) == 0) {
            $result = $loginJson->getFailedResult();
        } else {
            $token = Token::getToken($request->param('usernum'));
            $result = $loginJson->getSuccessfulResult($token, $data);
        }
        return $result;
    }
}
