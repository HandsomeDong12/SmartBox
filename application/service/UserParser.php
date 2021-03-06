<?php
/**
 * Created by PhpStorm.
 * User: fitz
 * Date: 1/16/19
 * Time: 6:19 AM
 */

namespace app\service;


use Firebase\JWT\JWT;

class UserParser
{
    private $key;
    private $alg = [];


    public function __construct()
    {
        $this->key = 'YUHAIDONG';
        $this->alg = ['HS256'];

    }

    public function getUser($token)
    {
        $data = JWT::decode($token, $this->key, $this->alg);
        $user = $data->uid;
        return $user;
    }

}