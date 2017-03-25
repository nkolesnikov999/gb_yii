<?php

/* @var $model app\models\Product */

use yii\helpers\Html;

?>            
      
<div class="col-lg-6">
    <h3><?= Html::a($model->name, ['view', 'id' => $model->id]) ?></h3>
    <p><?= $model->short_description ?></p>
</div>
    
