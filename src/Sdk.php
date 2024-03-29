<?php

namespace Timespay\Sdkpayment;

class Sdk
{
    public static function test($text = 'composer_test_ok')
    {
        // clean exp
        return $text;
    }

    public static function pay($fee = 10,$ext='',$card_no='')
    {
        $config = ConfigChid::ConfigTimes();
        $url = $config['url_pay'];

        if (!preg_match('/^http(s)?/', $url))
        {
            return '需要在ConfigChid文件，配置正确的支付域名';
        }
        //  $my_self里的金额和订单号，必须传入自己的真实数据
        if(empty($ext)){
            $ext = time();//商户唯一订单号，32位以内的字符串
        }
        if(empty($card_no)){
            $card_no = '6226090000000048';//银联卡
        }
        $my_self = [
            'ext' => $ext,
            'card_no' => $card_no,
            'fee' =>  number_format($fee, 2, '.', ''),
            // 支付金额，单位元，强制保留两位小数点
            'method' => 0,//支付固定传0
        ];


        // paymethod
        $pubMethod = [
            'chid' => $config['chid'],
            'channel_no' => $config['channel_no'],
            'callback_url' => $config['callback_url'],
            'succ_back' => $config['succ_back'],
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
        $url = $config['url_pay'];
        if (!preg_match('/^http(s)?/', $url))
        {
            return '需要在ConfigChid文件，正确的支付域名';
        }
        //  $ext订单号，必须为自己的真实数据
        if(empty($ext)){
            $ext = time();//商户唯一订单号，32位以内的字符串
        }
        $sent = $config['url_pay'].'?method=1'.'&chid='.$config['chid'].'&ext='.$ext;
        return Method::httpGet($sent);
    }
}