<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Commerce */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Commerce',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Commerces'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="commerce-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
