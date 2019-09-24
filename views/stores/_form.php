<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Stores */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="stores-form">
    <?php $selectorHint = '.price-block:eq(0) .previous-price .prev-price-total' ?>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'protocol')->textInput()->hint('1 = https, 0 = http') ?>

    <?= $form->field($model, 'host')->textInput(['maxlength' => true])->hint('site.ru') ?>

    <?= $form->field($model, 'price_selector')->textInput(['maxlength' => true])->hint($selectorHint) ?>

    <?= $form->field($model, 'price_old_selector')->textInput(['maxlength' => true])->hint($selectorHint) ?>

    <?= $form->field($model, 'sale_selector')->textInput(['maxlength' => true])->hint($selectorHint) ?>

    <?= $form->field($model, 'active')->textInput()->hint('0 or 1') ?>

    <?= $form->field($model, 'city_selector')->textInput(['maxlength' => true])->hint($selectorHint) ?>

    <?= $form->field($model, 'cookies')->textInput(['maxlength' => true])->hint('_gid=GA1.2.1983272262.1505508796') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
