<?php 

namespace backend\controllers;

use Yii;
use yii\rest\ActiveController;
use app\models\Employee;

use \Firebase\JWT\JWT;

class ResourceController extends ActiveController
{
    public $modelClass = 'app\models\Employee';

    public function actionLogin()
    {
        /*$model = new $this->modelClass;

        try {
            $provider = new ActiveDataProvider([
                'query' => $model->find()->where(['name' => Yii::$app->request->getBodyParam('name')]),
                'pagination' => false
            ]);
        } catch (Exception $ex) {
            throw new \yii\web\HttpException(500, 'Internal server error');
        }

        if ($provider->getCount() <= 0) {
            throw new \yii\web\HttpException(404, 'No entries found with this query string');
        }

        $employee_array = $provider->getModels();*/

        $employee = Employee::findOne([
            'name' => Yii::$app->request->getBodyParam('name'),
        ]);

        if ($employee === null) {
            throw new \yii\web\HttpException(404, 'User not exist');
        }else{
            if ($employee->password != Yii::$app->request->getBodyParam('password')) {
                throw new \yii\web\HttpException(403, 'Incorrect password');
            }else{
                /*Crear un token*/
                $time = time();
                $key = "example_key";
                $token = array(
                    "iat" => $time,
                    "exp" => $time + 600
                );

                $jwt = JWT::encode($token, $key);

                Yii::$app->response->content = $jwt;

            }
        }

        
               
    }

    public function actionAdd()
    {
    	//$params = Yii::$app->request->post();
    	$model = new Employee();

        $model->name = Yii::$app->request->getBodyParam('name');        
        $model->enable = Yii::$app->request->getBodyParam('enable');

        $model->save();

        //throw new \yii\web\HttpException(404, 'codigo = '.$codigo);

    }
}

