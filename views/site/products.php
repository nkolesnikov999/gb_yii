<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>
    <h1>Продукты</h1>
    <div class="row">
        <?php foreach ($products as $product): ?>
            <div class="col-lg-6">
                <h3><?= $product->name ?></h3>
                <h4><?= Html::encode("Цена: {$product->price} р.") ?></h4>
                <p><?= $product->short_description ?></p>
            </div>
        <?php endforeach; ?>
    </div>

<?= LinkPager::widget(['pagination' => $pagination]) ?>