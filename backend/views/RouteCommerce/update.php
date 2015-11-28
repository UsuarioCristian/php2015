<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RouteCommerce */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Route Commerce',
]) . ' ' . $model->route_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Route Commerces'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->route_id, 'url' => ['view', 'route_id' => $model->route_id, 'commerce_id' => $model->commerce_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="route-commerce-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
