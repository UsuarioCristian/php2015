<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RouteCommerce */

$this->title = Yii::t('app', 'Create Route Commerce');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Route Commerces'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="route-commerce-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
