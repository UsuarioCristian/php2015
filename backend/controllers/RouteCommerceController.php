<?php

namespace backend\controllers;

use Yii;
use app\models\RouteCommerce;
use app\models\RouteCommerceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RouteCommerceController implements the CRUD actions for RouteCommerce model.
 */
class RouteCommerceController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all RouteCommerce models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RouteCommerceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RouteCommerce model.
     * @param integer $route_id
     * @param integer $commerce_id
     * @return mixed
     */
    public function actionView($route_id, $commerce_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($route_id, $commerce_id),
        ]);
    }

    /**
     * Creates a new RouteCommerce model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RouteCommerce();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'route_id' => $model->route_id, 'commerce_id' => $model->commerce_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing RouteCommerce model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $route_id
     * @param integer $commerce_id
     * @return mixed
     */
    public function actionUpdate($route_id, $commerce_id)
    {
        $model = $this->findModel($route_id, $commerce_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'route_id' => $model->route_id, 'commerce_id' => $model->commerce_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing RouteCommerce model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $route_id
     * @param integer $commerce_id
     * @return mixed
     */
    public function actionDelete($route_id, $commerce_id)
    {
        $this->findModel($route_id, $commerce_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the RouteCommerce model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $route_id
     * @param integer $commerce_id
     * @return RouteCommerce the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($route_id, $commerce_id)
    {
        if (($model = RouteCommerce::findOne(['route_id' => $route_id, 'commerce_id' => $commerce_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
