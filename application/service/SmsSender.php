<?php
/**
 * Created by PhpStorm.
 * User: fitz
 * Date: 19-2-1
 * Time: 上午5:04
 */

namespace app\service;


use Qcloud\Sms\SmsSingleSender;

class SmsSender
{
    private $sender;
    private $registerId;
    private $takeMedicineId;


    public function __construct()
    {
        $appId = 1400125607;
        $appKey = "576634af0af8af302af510047fded680";;
        $this->registerId = 276013;
        $this->takeMedicineId = 276016;

        try{
            $sender = new SmsSingleSender($appId, $appKey);
            $this->sender = $sender;
        }catch (\ErrorException $e){
            return $e;
        }
    }

    public function sendRegisterSms($phoneNumber, $verification)
    {
        $phoneNumbers[] = $phoneNumber;
        $params[] = $verification;
        $result = $this->sender->sendWithParam("86", $phoneNumbers[0], $this->registerId,
            $params, "", "", "");

        return $result;
    }

    public function sendTakeMedicineSms($phoneNumber, $verification)
    {
        $phoneNumbers[] = $phoneNumber;
        $params[] = $verification;
        $result = $this->sender->sendWithParam("86", $phoneNumbers[0], $this->takeMedicineId,
            $params, "", "", "");

        return $result;
    }




}