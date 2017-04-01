<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "currency".
 *
 * @property integer $id
 * @property string $code
 * @property string $value
 * @property integer $date
 */
class Currency extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'currency';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date'], 'integer'],
            [['code', 'value'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'value' => 'Value',
            'date' => 'Date',
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['date'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['date'],
                ],
            ],
        ];
    }

    public static function updateData($data)
    {
        $currency = self::find()
            ->where(['code' => $data['code']])
            ->one();

        if($currency)
        {
            if($currency->value == $data['value']) {
                echo "No changies ";
            } else {
                $currency->value = $data['value'];
                echo "Updated ";
                $currency->save();
            }
        } else {
            $currency = new Currency();
            $currency->code = $data['code'];
            $currency->value = $data['value']; 
            echo "Created ";
            $currency->save();
        }

        echo $currency->code . " - " . $currency->value . "\n";
    } 
}
