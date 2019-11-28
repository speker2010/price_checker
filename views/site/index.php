<?php

/* @var $this yii\web\View */

$this->title = 'Price checker';
?>
<div class="site-index">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul>
                    <li><?= \yii\helpers\Html::a(Yii::t('app', 'Products'), ['products/index']) ?></li>
                    <li><?= \yii\helpers\Html::a(Yii::t('app', 'Prices'), ['prices/index']) ?></li>
                    <li><?= \yii\helpers\Html::a(Yii::t('app','Stores'), ['stores/index']) ?></li>
                    <li><?= \yii\helpers\Html::a(Yii::t('app', 'Product store'), ['product-store/index']) ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>
