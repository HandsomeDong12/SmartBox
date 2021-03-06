<?php

namespace app\index\controller;

use app\index\model\LoginResult;
use app\index\model\Medicine;
use app\index\model\User;
use app\service\Database;
use app\service\SmsSender;
use app\service\UserParser;
use app\index\tools\Token;
use Firebase\JWT\JWT;
use Qcloud\Sms\SmsSingleSender;
use think\Request;


class TestController extends Controller
{
    private $database;
    private $smsSender;

    public function __construct(Database $database, SmsSender $smsSender)
    {
        $this->database = $database;
        $this->smsSender = $smsSender;
    }

    /**
     * @param $phoneNumber
     * @return bool
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    private function isUserIdExist($phoneNumber)
    {
        $isExist = $this->database->isUserIdExist($phoneNumber);
        return $isExist;
    }

    /**
     * @param Request $request
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function sendVerification(Request $request)
    {
        $param = $request->only(['phoneNumber']);

        $phoneNumber = $param['phoneNumber'];

        $isUserIdExist = $this->isUserIdExist($phoneNumber);

        if ($isUserIdExist) {
            $status = -1;
        }else{
            $status = 1;
        }
        return ['status' => $status];

    }


    /**
     * @param Request $request
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function test(Request $request)
    {
        $param = $request->only(['phoneNumber']);

        $phoneNumber = $param['phoneNumber'];
        $verification = rand(1000, 9999);
        $result = $this->database->test($phoneNumber, $verification);
        return ['result' => $result];
    }
}
