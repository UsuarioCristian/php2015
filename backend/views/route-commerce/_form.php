<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper; 
use app\models\Commerce; 
use app\models\Route; 

/* @var $this yii\web\View */
/* @var $model app\models\RouteCommerce */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="route-commerce-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'route_id')->dropDownList(
		   ArrayHelper::map(Route::find()->all(), 'id', 'id'),
		   ['prompt'=>'Select Route_id']
	) ?>
		   
	<?= $form->field($model, 'commerce_id')->dropDownList(
		       ArrayHelper::map(Commerce::find()->all(), 'id', 'name'),
		   ['prompt'=>'Select Commerce']
	) ?>

    <?= $form->field($model, 'position')->textInput() ?>

    <?= $form->field($model, 'visited')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
