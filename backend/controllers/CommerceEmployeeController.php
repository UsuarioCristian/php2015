<?php

namespace backend\controllers;

use Yii;
use app\models\CommerceEmployee;
use app\models\CommerceEmployeeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CommerceEmployeeController implements the CRUD actions for CommerceEmployee model.
 */
class CommerceEmployeeController extends Controller
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
     * Lists all CommerceEmployee models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CommerceEmployeeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CommerceEmployee model.
     * @param integer $commerce_id
     * @param integer $employee_id
     * @return mixed
     */
    public function actionView($commerce_id, $employee_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($commerce_id, $employee_id),
        ]);
    }

    /**
     * Creates a new CommerceEmployee model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CommerceEmployee();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'commerce_id' => $model->commerce_id, 'employee_id' => $model->employee_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CommerceEmployee model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $commerce_id
     * @param integer $employee_id
     * @return mixed
     */
    public function actionUpdate($commerce_id, $employee_id)
    {
        $model = $this->findModel($commerce_id, $employee_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'commerce_id' => $model->commerce_id, 'employee_id' => $model->employee_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CommerceEmployee model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $commerce_id
     * @param integer $employee_id
     * @return mixed
     */
    public function actionDelete($commerce_id, $employee_id)
    {
        $this->findModel($commerce_id, $employee_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CommerceEmployee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $commerce_id
     * @param integer $employee_id
     * @return CommerceEmployee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($commerce_id, $employee_id)
    {
        if (($model = CommerceEmployee::findOne(['commerce_id' => $commerce_id, 'employee_id' => $employee_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
