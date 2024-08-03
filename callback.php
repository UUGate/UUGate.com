<?php
$input = json_decode(file_get_contents('php://input'), true);
if (empty($input)) {
    echo 'failed';
    exit;
}
$uid = $input['uid'];
$data = $input['data'];
$timestamp = $input['timestamp'];
$sign = $input['sign'];
$key = '991746e..........3117';//替换成你自己的key
if (strtolower($sign) === strtolower(md5($uid . $data . $key . $timestamp))) {
    $dataArr = json_decode($data, true);
    if ($dataArr['OrderType'] === 'ReceiveOrder') {
        //todo 收款订单的回调处理逻辑
    } else if ($dataArr['OrderType'] === 'PaymentOrder') {
        //todo 付款订单的回调处理逻辑
    } else {
        //暂无其他情形回调
    }
    echo 'success';
    exit;
} else {
    echo 'failed';
}
