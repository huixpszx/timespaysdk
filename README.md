使用说明

在ConfigChid文件配置整个ConfigTimes

pay方法为申请支付，需要传入订单号，订单金额，银联卡号

pay_query方法为申请支付后，主动查询，需要传入订单号。

注意，支付成功会有平台回调通知，不成功则不通知

支付结果，以平台通知为主，禁止频繁查询！！！