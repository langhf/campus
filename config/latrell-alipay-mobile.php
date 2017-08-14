<?php
return [

	// 安全检验码，以数字和字母组成的32位字符。
	'key' => 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',

	// 签名方式
	'sign_type' => 'RSA2',

	// 商户私钥。
	'private_key_path' => __DIR__ . '/key/app_private_key.pem',

	// 阿里公钥。
	'public_key_path' => __DIR__ . '/key/alipay_public_key_sha256_2017080908112611.txt',

	// 异步通知连接。
	'notify_url' => 'http://xxx'
];
