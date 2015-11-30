<?php 

namespace common\components;

use Yii;
use \Firebase\JWT\JWT;

class MyTrackingClass extends \yii\base\Component{
    public function init() {
        //SOME CODE HERE
        //SOME CODE HERE
        //SOME CODE HERE
        //echo "Hi";
        //strpos($a,'are')

        $path = Yii::$app->request->pathInfo;

    	if($path === 'resource/stocks/save' || $path === 'resource/order/save'){
    		
    		$headers = Yii::$app->request->headers;
    		$authorizationHeader = $headers->get('AUTHORIZATION');

    		if ($authorizationHeader == null) {
		      throw new \yii\web\HttpException(401, 'No token was found');
		    }

		     // // validate the token
		    $token = str_replace('Bearer ', '', $authorizationHeader);
		    $secret = 'example_key';
		    $decoded_token = null;
		    try {
		      $decoded_token = JWT::decode($token, $secret, array('HS256'));
		    } catch(UnexpectedValueException $ex) {
		      	throw new \yii\web\HttpException(401, 'wrong token');
		    }		

    	}


        parent::init();
    }
}





 ?>