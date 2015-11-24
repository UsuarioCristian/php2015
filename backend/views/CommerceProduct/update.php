<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CommerceProduct */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Commerce Product',
]) . ' ' . $model->commerce_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Commerce Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->commerce_id, 'url' => ['view', 'commerce_id' => $model->commerce_id, 'product_id' => $model->product_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="commerce-product-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
