<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Products */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'active'
        ],
    ]) ?>
	<div id="visual"></div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
	<script>
		function createChart(canvas, labels, datasets) {
		var ctx = canvas.getContext('2d');
		var chart = new Chart(ctx, {
			// The type of chart we want to create
			type: 'line',

			// The data for our dataset
			data: {
				labels: labels,
				datasets: [{
					label: "My First dataset",
					backgroundColor: 'rgb(255, 99, 132)',
					borderColor: 'rgb(255, 99, 132)',
					data: datasets,
				}]
			},

			// Configuration options go here
			options: {}
			});
		}
		var stores = <?=$storesPricesDatesJson;?>;
		var canvas;
		var chartHeadline;
		var canvasContainer = document.getElementById('visual');
		for (var i in stores) {
			canvas = document.createElement('canvas');
			chartHeadline = document.createElement('h2');
			chartHeadline.innerText = stores[i].storeName;
			canvasContainer.appendChild(chartHeadline);
			canvasContainer.appendChild(canvas);
			createChart(canvas, stores[i].date, stores[i].price)
		}
	</script>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'created_at:datetime',
            'price',
            'old_price',
            'city',
            'product_id',
            [
                'attribute'=>'store_id',
                'label'=>'Магазин',
                'format'=>'text', // Возможные варианты: raw, html
                'content'=>function($data){
                    return $data->getStoreName();
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
