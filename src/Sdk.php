<?php

namespace Timespay\Sdkpayment;

class Sdk
{
    public static function test($text = 'composer_test_ok')
    {
        // clean exp
        return $text;
    }

    public static function pay($fee = 100,$ext='')
    {
        $config = ConfigChid::ConfigTimes();
        if(empty($config['url_pay'])){
            return 'url_pay is empty';
        }
        //  $my_self里的金额和订单号，必须传入自己的真实数据
        if(empty($ext)){
            $ext = time();//商户唯一订单号，32位以内的字符串
        }
        $my_self = [
            'ext' => $ext,
            'fee' =>  number_format($fee, 2, '.', ''),
            // 支付金额，单位元，强制保留两位小数点
            'method' => 0,//支付固定传0
        ];


        // paymethod
        $pubMethod = [
            'chid' => $config['chid'],
            'channel_no' => $config['channel_no'],
            'callback_url' => $config['callback_url'],
            'remark' => $config['remark'],
            'timeamp' => date('YmdHis'),
        ];

        $pubMethod['sign'] = Method::Sign($pubMethod, $my_self,$config);
        $paramArr = $pubMethod +  $my_self;
        return Method::Send_post_form($config['url_pay'],$paramArr);
    }

    public static function pay_query($ext='')
    {
        $config = ConfigChid::ConfigTimes();
        if(empty($config['url_pay'])){
            return 'url_pay is empty';
        }
        //  $ext订单号，必须为自己的真实数据
        if(empty($ext)){
            $ext = time();//商户唯一订单号，32位以内的字符串
        }
        $sent = $config['url_pay'].'?method=1'.'&chid='.$config['chid'].'&ext='.$ext;
        return Method::httpGet($sent);
    }
}