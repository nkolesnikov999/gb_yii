<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use app\widgets\Map;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is the About page. You may modify the following file to customize its content:
    </p>

    <div>
        <?= Map::widget(['width' => 560, 'height' => 400]) ?>
    </div>



    <code><?= __FILE__ ?></code>
</div>
