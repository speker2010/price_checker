<?php
use yii\helpers\Html;

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message being composed */
/* @var $content string main view render result */
?>
<?php $this->beginPage() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?= Yii::$app->charset ?>" />
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>table{width:100%;}tr:first-child{border-bottom:1px solid #ccc;}tr:nth-child(odd){background:#ddd;}</style>
</head>
<body>
    <?php $this->beginBody() ?>
    <?= $content ?>
    <?php
    $th_row = '<tr><th>Магазин</th><th>raw_price</th><th>price</th><th>raw_old_price</th><th>old_price</th><th>http status</th><th>Город</th></tr>';
    foreach ($mail as $product_name=>$info) {
		$mail_body .= "<h2>{$product_name}</h2>";
		$mail_body .= '<table>';
		$mail_body .= $th_row;
		foreach ($info as $store_name=>$product_data) {
			$row = "<tr><td>$store_name</td><td>{$product_data['price_raw']}</td><td>{$product_data['price']}</td><td>{$product_data['old_price_raw']}</td><td>{$product_data['old_price']}</td><td>{$product_data['http_code']}</td><td>{$product_data['city']}</td></tr>";
			$mail_body .= $row;
		}
		$mail_body .= '</table>';
	}
	?>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
