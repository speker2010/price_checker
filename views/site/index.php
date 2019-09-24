<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul>
                    <li><?= \yii\helpers\Html::a('products', ['products/index']) ?></li>
                    <li><?= \yii\helpers\Html::a('prices', ['prices/index']) ?></li>
                    <li><?= \yii\helpers\Html::a('stores', ['stores/index']) ?></li>
                    <li><?= \yii\helpers\Html::a('product store', ['product-store/index']) ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>
