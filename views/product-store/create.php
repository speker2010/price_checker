<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProductStore */

$this->title = 'Create Product Store';
$this->params['breadcrumbs'][] = ['label' => 'Product Stores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-store-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
