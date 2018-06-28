<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StoresSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="stores-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'protocol') ?>

    <?= $form->field($model, 'host') ?>

    <?= $form->field($model, 'price_selector') ?>

    <?php // echo $form->field($model, 'price_old_selector') ?>

    <?php // echo $form->field($model, 'sale_selector') ?>

    <?php // echo $form->field($model, 'active') ?>

    <?php // echo $form->field($model, 'city_selector') ?>

    <?php // echo $form->field($model, 'cookies') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
