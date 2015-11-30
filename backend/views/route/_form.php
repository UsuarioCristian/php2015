<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\models\Employee;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\Route */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="route-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'employee_id')->dropDownList(
		ArrayHelper::map(Employee::find()->all(), 'id', 'name'),
		['prompt'=>'Select Employee']
	) ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'finished')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
