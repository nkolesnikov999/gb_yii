<?php

/* @var $this yii\web\View */
/* @var  $dataProvider  */

use yii\widgets\ListView;

$this->title = 'Продукты';

?>

<?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_list',
    ]) 
?>
      