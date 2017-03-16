<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customers".
 *
 * @property integer $id
 * @property string $firstname
 * @property string $secondname
 * @property string $adress
 * @property string $telephone
 */
class Customers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['firstname'], 'string', 'max' => 32],
            [['secondname'], 'string', 'max' => 50],
            [['adress'], 'string', 'max' => 256],
            [['telephone'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstname' => 'Имя',
            'secondname' => 'Фамилия',
            'adress' => 'Адрес',
            'telephone' => 'Телефон',
        ];
    }
}
