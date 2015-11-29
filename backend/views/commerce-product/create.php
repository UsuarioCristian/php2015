<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CommerceProduct */

$this->title = Yii::t('app', 'Create Commerce Product');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Commerce Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="commerce-product-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
