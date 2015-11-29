<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CommerceEmployee */

$this->title = Yii::t('app', 'Create Commerce Employee');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Commerce Employees'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="commerce-employee-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
