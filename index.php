<?php
function http_post_json($url, $dto)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($dto, JSON_UNESCAPED_UNICODE));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    $response = curl_exec($ch);
    curl_close($ch);
    if ($response === false ) {
        throw new \Exception(curl_error($ch),curl_errno($ch));
    }
    return $response;
}

$host = 'http://localhost:8000/';//替换成实际接口域名
$uid = '239359';//替换成你的uid
$key = '7a78691cf40254e9ca053bfe8da8d515';//替换成你自己的key
$url = $host . '/Open.Customer/CreateReceiveOrder';

$dto = [
    'uid'=>$uid,
    'timestamp'=>time(),//秒
    'data'=>'',
    'Lang'=>'zh',//zh 或en,影响返回的收款链接的中英文设置
    'sign'=>'',
];
// CreateReceiveOrder
$dto['data'] = json_encode([
    'Amount'=>'1',
    'Blockchain'=>'TRC20',
    'CustomerOrderNo'=>'TEST155',
    'EffectiveDuration'=>300,
    'JumpURL'=>'',
]);//注意data要转成json

// CreatePaymentOrder
// $dto['data'] = json_encode([
//     'Amount'=>'1',
//     'Blockchain'=>'TRC20',
//     'CustomerOrderNo'=>'TEST155',
//     'FromAddress'=>'Txxxxxxxxxxxxxxx1',
//     'ToAddress'=>'Txxxxxxxxxxxxxxxxx2',
// ]);//注意data要转成json

//GetReceiveOrderStatus
// $dto['data'] = json_encode([
//     'CustomerOrderNo'=>'TEST155',
// ]);//注意data要转成json

//GetPaymentOrderStatus
// $dto['data'] = json_encode([
//     'CustomerOrderNo'=>'TEST155',
// ]);//注意data要转成json

//GetAdvanceAccountBalance
// $dto['data'] = '{}';

$dto['sign'] = md5("{$dto['uid']}{$dto['data']}{$key}{$dto['timestamp']}");
var_dump($dto);
$r = http_post_json($url,$dto);
$r = json_decode($r,true);
var_dump($r);
