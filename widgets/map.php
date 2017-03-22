<?php
namespace app\widgets;

use yii\base\Widget;
use yii\helpers\Html;

class Map extends Widget
{

    public $src;
    public $width;
    public $height;
    public $frameborder;
    public $options;


    public function init()
    {
        parent::init();
        if (!$this->src) $this->src = "https://api-maps.yandex.ru/frame/v1/-/C6EkZVm5";
        if (!$this->width) $this->width = 300;
        if (!$this->height) $this->height = 300;
        if (!$this->frameborder) $this->frameborder = 0;
    }

    public function run()
    {
        $options = ['src' => 'https://api-maps.yandex.ru/frame/v1/-/C6EkaRYE',
                    'width' => $this->width, 'height' =>  $this->height,
                    'frameborder' => $this->frameborder];
        $content = Html::tag('iframe', '', $options);


        return  $content;
    }
}
