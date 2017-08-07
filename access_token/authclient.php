<?php
/**
 * Created by PhpStorm.
 * User: chenyi
 * Date: 2017/2/10
 * Time: 14:00
 */

return [
    'class' => 'yii\authclient\Collection',
    'clients' => [
        'qq' => [
            'class'=>'app\oauth\QQOAuth',
            'clientId'=>'101385034',
            'clientSecret'=>'ccca8f05a3678553777de12199276521'
        ],
        'wechat' => [
            'class'=>'app\oauth\WechatOAuth',
            'clientId'=>'wxfef77f175fb7ce01',
            'clientSecret'=>'2c4f58c1e9a157025d3812100dcce8ee'
        ],
    ],
];