<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CommerceEmployee */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Commerce Employee',
]) . ' ' . $model->commerce_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Commerce Employees'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->commerce_id, 'url' => ['view', 'commerce_id' => $model->commerce_id, 'employee_id' => $model->employee_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="commerce-employee-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
