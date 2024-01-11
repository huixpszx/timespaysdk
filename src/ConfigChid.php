<?php

namespace Timespay\Sdkpayment;

class ConfigChid
{
    public static function ConfigTimes()
    {
        $domain = '';//测试域名，生产改为正式域名
        return [
            'url_pay'=> $domain.'/pay/index/index',
            'chid' => 'QD101',//测试商户号，生产改为正式商户号
            'appkey'   => 'cgefmuzmtri38x9s5kf898xuigea88ox',//测试密钥，生产改为正式密钥
            'channel_no' => '12580',//测试通道号，生产改为正式通道号
            'callback_url' => 'https://www.baidu.com',//接受订单状态的，商户自己的回调地址
            'succ_back' => 'https://www.unionpayintl.com/index.shtml',//支付成功后跳转的地址，一般为自己的产品主页
            'remark'=>'clothing',//测试商品备注，，生产改为商户自己的商品备注
        ];
    }
}