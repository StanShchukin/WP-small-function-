<?php

// определяем обратный вызов wpcf7_mail_sent
	function action_wpcf7_mail_sent ( ) {
		$receiverID  = 'uSeM1GpAyavSU2A3GpSK9A=='; // id admin chat
		$TextMessage = 'Привет Это бот!  NewchildFunction  PHP';
		
		$curl      = curl_init();
		$json_data = '{
"receiver":"' . $receiverID . '",
"min_api_version":1,
"sender":{
"name":"NameBot",
"avatar":"avatar.example.com"
},
"tracking_data":"tracking data",
"type":"text",
"text":"  TextMessage  "

}
';
		$data      = json_decode( $json_data );
		
		curl_setopt_array( $curl, array(
			CURLOPT_URL            => "https://chatapi.viber.com/pa/send_message",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING       => "",
			CURLOPT_MAXREDIRS      => 10,
			CURLOPT_TIMEOUT        => 30,
			CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST  => "POST",
			CURLOPT_POSTFIELDS     => json_encode( $data ), // отправка кода
			
			CURLOPT_HTTPHEADER => array(
				"Cache-Control: no-cache",
				"Content-Type: application/JSON",
				"X-Viber-Auth-Token: 49da77da30a7d451-f0cd48ecdc5a16f8-a8be647ea767726e" //token
			),
		) );
		
		$response = curl_exec( $curl );
		$err      = curl_error( $curl );
		
		curl_close( $curl );
		
		/*if ( $err ) {
			echo "cURL Error #:" . $err;
		} else {
			echo $response;
		}*/
		
};

// добавить действие
add_action ( 'wpcf7_mail_sent' , 'action_wpcf7_mail_sent' , 10 , 1 );
