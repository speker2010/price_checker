<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Stores;
use app\models\Products;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\ProductStore */
/* @var $form yii\widgets\ActiveForm */

$stores = Stores::find()->All();
$storesList = ArrayHelper::map($stores,'id','name');
$products = Products::find()->All();
$productList = ArrayHelper::map($products, 'id', 'name');
?>

<div class="product-store-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'store_id')->dropDownList($storesList) ?>

    <?= $form->field($model, 'product_id')->dropDownList($productList) ?>

    <?= $form->field($model, 'product_uri')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'active')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
