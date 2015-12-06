<?php 

namespace backend\controllers;

use Yii;
use yii\rest\ActiveController;
use app\models\Employee;
use app\models\Commerce;
use app\models\CommerceProduct;
use app\models\Order;
use app\models\Product;
use app\models\Route;
use app\models\RouteCommerce;

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
            throw new \yii\web\HttpException(404, 'User not exist ');
        }else{
            if ($employee->password != Yii::$app->request->getBodyParam('password')) {
                throw new \yii\web\HttpException(403, 'Incorrect password');
            }else{
                /*Crear un token*/
                $time = time();
                $key = "example_key";
                $token = array(
                    "iat" => $time,
                    "exp" => $time + 3000,
                    "id" => $employee->id,
                    "lat" => $employee->lat,
                    "long" => $employee->long
                );

                $jwt = JWT::encode($token, $key);

                Yii::$app->response->content = json_encode($jwt);

            }
        }
        
               
    }

    public function actionRoutesbyemployee()
    {
    	//$params = Yii::$app->request->post();
        $userId = Yii::$app->request->getBodyParam('id');
    	$employee = Employee::findOne($userId);

        if ($employee === null) {
            throw new \yii\web\HttpException(404, 'User not found ');
        }else{
            $routes = $employee->getRoutes()->asArray()->all();
            Yii::$app->response->content = json_encode($routes);
        }

        //throw new \yii\web\HttpException(404, 'codigo = '.$codigo);

    }

    public function actionStocksave()
    {
        
        $stock = Yii::$app->request->getBodyParam('stock');

        $commerceProduct = CommerceProduct::findOne([
            'commerce_id' => Yii::$app->request->getBodyParam('commerceId'),
            'product_id' => Yii::$app->request->getBodyParam('productId'),
        ]);

        if ($commerceProduct === null) {
            throw new \yii\web\HttpException(404, 'Data not found ');
        }else{
            $commerceProduct->stock = $stock;
            $commerceProduct->save();
        }
    }

    public function actionAllcommerce()
    {
        $allCommerce = Commerce::find()->asArray()->all();;
        Yii::$app->response->content = json_encode($allCommerce);

    }

    public function actionAllproductbycommerce()
    {
        $commerceId = Yii::$app->request->getBodyParam('id');

        $commerce = Commerce::findOne($commerceId);
        $products = $commerce->getProducts()->asArray()->all();
        Yii::$app->response->content = json_encode($products);

    }

    public function actionOrdersave()
    {
        
        $model = new Order();
        $model->commerce_id = Yii::$app->request->getBodyParam('commerceId');
        $model->product_id = Yii::$app->request->getBodyParam('productId');
        $model->quantity = Yii::$app->request->getBodyParam('quantity');

        $model->save();
    }


    public function actionProductsold(){
        $commerceProduct = CommerceProduct::findOne([
            'commerce_id' => Yii::$app->request->getBodyParam('commerceId'),
            'product_id' => Yii::$app->request->getBodyParam('productId'),
        ]);

        if ($commerceProduct === null) {
            throw new \yii\web\HttpException(404, 'commerceProduct not found ');
        }else{
            return json_encode($commerceProduct->sold);
        }
    }

    public function actionAllproduct(){
        $allProduct = Product::find()->asArray()->all();
        Yii::$app->response->content = json_encode($allProduct);
    }

    public function actionCurrentroute(){

        $date = date('Y-m-d');

        $route = Route::find()
            ->where(['date' => $date, 'employee_id' => Yii::$app->request->getBodyParam('employeeId')])
            ->one();

        if($route!= null && $route->finished == 0){
            $allRouteCommerce = RouteCommerce::find()
            ->where(['route_id' => $route->id])
            ->asArray()->all();

            Yii::$app->response->content = json_encode($allRouteCommerce);
        }else{
            throw new \yii\web\HttpException(404, 'route not found ');
        }        
    }
}

