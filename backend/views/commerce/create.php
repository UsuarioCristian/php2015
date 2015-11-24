<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Commerce */

$this->title = Yii::t('app', 'Create Commerce');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Commerces'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="commerce-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
