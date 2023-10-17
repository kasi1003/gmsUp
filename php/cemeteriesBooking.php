<?php
//payment gateway
//encryption key set in the Merchant Access Portal
$encryptionKey = 'secret';

$DateTime = new DateTime();

$data = array(
    'PAYGATE_ID'        => 10011072130,
    'REFERENCE'         => 'pgtest_123456789',
    'AMOUNT'            => 3299,//based on user input
    'CURRENCY'          => 'NAD',
    'RETURN_URL'        => 'https://my.return.url/page',//when transaction is done it should take you to another page
    'TRANSACTION_DATE'  => $DateTime->format('Y-m-d H:i:s'),
    'LOCALE'            => 'en-za',
    'COUNTRY'           => 'NAM',
    'EMAIL'             => 'customer@paygate.co.za',
);

$checksum = md5(implode('', $data) . $encryptionKey);

$data['CHECKSUM'] = $checksum;

$fieldsString = http_build_query($data);

//open connection
$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch, CURLOPT_URL, 'https://secure.paygate.co.za/payweb3/initiate.trans');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_NOBODY, false);
curl_setopt($ch, CURLOPT_REFERER, $_SERVER['HTTP_HOST']);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fieldsString);

//execute post
$result = curl_exec($ch);

//close connection
curl_close($ch);


?>