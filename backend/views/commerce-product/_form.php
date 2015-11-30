<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use app\models\Commerce;
use app\models\Product;

/* @var $this yii\web\View */
/* @var $model app\models\CommerceProduct */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="commerce-product-form">

    <?php $form = ActiveForm::begin(); ?>

    
    <?= $form->field($model, 'commerce_id')->dropDownList(
    	ArrayHelper::map(Commerce::find()->all(), 'id', 'name'),
    	['prompt'=>'Select Commerce']
    ) ?>
    
    <?= $form->field($model, 'product_id')->dropDownList(
    	ArrayHelper::map(Product::find()->all(), 'id', 'name'),
    	['prompt'=>'Select Product']
    ) ?>

    <?= $form->field($model, 'stock')->textInput() ?>

    <?= $form->field($model, 'sold')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
