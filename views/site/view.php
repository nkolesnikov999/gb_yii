<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->name;

?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [                      
                'label' => 'Название',
                'value' => $model->name,
            ],
            [                      
                'label' => 'Описание',
                'value' => $model->short_description,
            ],
            [                      
                'label' => 'Поподробнее',
                'value' => $model->description,
            ],
            [                      
                'label' => 'Цена',
                'value' => Html::encode("$model->price р."),
            ],
        ],
    ]) ?>

</div>
