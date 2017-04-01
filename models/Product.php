<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property string $name
 * @property string $short_description
 * @property string $description
 * @property double $price
 * @property integer $customer_id
 */
class Product extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['price'], 'number'],
            [['customer_id'], 'integer'],
            [['name', 'short_description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'short_description' => 'Short Description',
            'description' => 'Description',
            'price' => 'Price',
            'customer_id' => 'Customer ID',
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    public function saveImage($filename)
    {
        $this->image = $filename;
        return $this->save();
    }

    public function getImage()
    {
        if($this->image)
        {
            return '/uploads/' . $this->image;
        }
        return '/no-image.png';
    }

    public function deleteImage()
    {
        $imageUploadModel = new ImageUpload();
        $imageUploadModel->deleteCurrentImage($this->image);
    }

    public function beforeDelete()
    {
        $this->deleteImage();

        return parent::beforeDelete();
    }

    public static function updatePrices($prices)
    {
        $id = $prices[0];
        $product = self::findOne($id);

        if($product){
            $product->price = (double)$prices[1];
            if($product->save())
            {
                echo "New price for " . $product->name . " id: " . $id . " is " . $product->price . "\n";
            }
        } else {
            echo "No product with id: " . $id . "\n";
        }
        
    }
}
