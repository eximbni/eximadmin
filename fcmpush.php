<?php
#prep the bundle
function FCM($message,$id,$title){
	 foreach ($id as $ids) {
     $msg = array
          (
		'body' 	=> $message,
		'title'	=> $title
             	
          );
	$fields = array
			(
				'to'=> $ids,
				'notification'	=> $msg
			);
	
	
	$headers = array
			(
				'Authorization: key=' ."AAAA_Q9W2Yo:APA91bHkIAsjjOmYlBqZRp3ybcN83BBX74662KSfYL_Ksb1ty6ihF3Ub5tX6enQHLRUFJKg30IvB-1JoNlNZzAD5_nYoI2SiUA9ZtEyEOanlwUQNWmJCT4JDBOj9UpPTb269XOouY4V5",
				'Content-Type: application/json'
			);
#Send Reponse To FireBase Server	
		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
		$result = curl_exec($ch );
		$result= array($result);
		curl_close( $ch );
}
}

?>