<?php

$universe 		= "yoox_cn";
$pass 			= "645cbe37fbf2d3a58cb6076909d22219168e15dd";
$service_url 	= "https://api.spl4cn.com/api/triggersms/nph-3.pl";


$rcpts = array(
				'cellphone'=>'13817941613',
				'firstname'=>'test',
				'lastname'=>'test',
				//'c0'=>'cd32131d'        //´æ·ÅÓÅ»ÝÂë
			);

$params = array(
				'universe'=>$universe,
				'key'=>$pass,
				//'opcode'=>'',
				'message'=>'6nNjxgijA',
				'rcpts'=>json_encode($rcpts),
			);

$params_str = http_build_query($params);


//init curl
$curl = curl_init();
//post url
curl_setopt($curl,CURLOPT_URL,$service_url);
//turn of ssl 
curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
//can solve
curl_setopt($curl, CURLOPT_HTTPHEADER, array("Expet:"));
//post request
curl_setopt($curl, CURLOPT_POST,count($params));
curl_setopt($curl, CURLOPT_POST, $params_str);
//actual call
$curl_response = curl_exec($curl);
curl_close($curl);

//print
//var_dump($curl_response);
var_dump(json_decode($curl_response),true);









