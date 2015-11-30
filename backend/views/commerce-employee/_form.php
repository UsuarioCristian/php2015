<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

Employee
use app\models\Employee;

/* @var $this yii\web\View */
/* @var $model app\models\CommerceEmployee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="commerce-employee-form">

    <?php $form = ActiveForm::begin(); ?>
    
	<?= $form->field($model, 'commerce_id')->dropDownList(
    	ArrayHelper::map(Commerce::find()->all(), 'id', 'name'),
    	['prompt'=>'Select Commerce']
    ) ?>

    <?= $form->field($model, 'employee_id')->dropDownList(
    	ArrayHelper::map(Employee::find()->all(), 'id', 'name'),
    	['prompt'=>'Select Employee']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
