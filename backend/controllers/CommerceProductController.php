<?php

namespace backend\controllers;

use Yii;
use app\models\CommerceProduct;
use app\models\CommerceProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CommerceProductController implements the CRUD actions for CommerceProduct model.
 */
class CommerceProductController extends Controller
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
     * Lists all CommerceProduct models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CommerceProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CommerceProduct model.
     * @param integer $commerce_id
     * @param integer $product_id
     * @return mixed
     */
    public function actionView($commerce_id, $product_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($commerce_id, $product_id),
        ]);
    }

    /**
     * Creates a new CommerceProduct model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CommerceProduct();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'commerce_id' => $model->commerce_id, 'product_id' => $model->product_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CommerceProduct model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $commerce_id
     * @param integer $product_id
     * @return mixed
     */
    public function actionUpdate($commerce_id, $product_id)
    {
        $model = $this->findModel($commerce_id, $product_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'commerce_id' => $model->commerce_id, 'product_id' => $model->product_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CommerceProduct model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $commerce_id
     * @param integer $product_id
     * @return mixed
     */
    public function actionDelete($commerce_id, $product_id)
    {
        $this->findModel($commerce_id, $product_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CommerceProduct model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $commerce_id
     * @param integer $product_id
     * @return CommerceProduct the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($commerce_id, $product_id)
    {
        if (($model = CommerceProduct::findOne(['commerce_id' => $commerce_id, 'product_id' => $product_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
