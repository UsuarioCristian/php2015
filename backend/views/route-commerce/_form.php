<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RouteCommerce */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="route-commerce-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'route_id')->textInput() ?>

    <?= $form->field($model, 'commerce_id')->textInput() ?>

    <?= $form->field($model, 'position')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
