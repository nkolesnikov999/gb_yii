<?php

namespace app\models;

use Yii;
use yii\base\Event;

/**
 * This is the model class for table "emails".
 *
 * @property integer $id
 * @property string $email
 * @property string $username
 */
class Emails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'emails';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'username'], 'string', 'max' => 255],
            [['email'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'username' => 'Username',
        ];
    }

    public function saveEmail($event)
    {
        $this->username = $event->sender['username'];
        $this->email = $event->sender['email'];
        $this->save();
    }
}
