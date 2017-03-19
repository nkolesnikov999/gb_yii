<?php

/* @var $model app\models\Product */

use yii\helpers\Html;

?>            
      
<div class="col-lg-6">
    <h3><?= Html::a($model->name, ['view', 'id' => $model->id]) ?></h3>
    <h4><?= Html::encode("Цена: $model->price р.") ?></h4>
    <p><?= $model->short_description ?></p>
</div>
    
