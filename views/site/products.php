<?php

/* @var $this yii\web\View */
/* @var  $dataProvider  */

use yii\widgets\ListView;

$this->title = 'Продукты';

?>

<?php 

    // if ($this->beginCache('products', 
    //                        ['duration' => 60])) {

        echo ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_list',
        ]);
    //   $this->endCache();
    // }
?>
      