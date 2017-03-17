<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * RegisterForm is the model behind the login form.
 *
 *
 */
class RegisterForm extends Model
{
    public $username;
    public $password;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
        ];
    }
    
     /**
     * Registers a new user account..
     *
     * @return bool
     */
    public function register()
    {
        if (!$this->validate()) {
            return false;
        }

        /** @var User $user */
        $user = Yii::createObject(User::className());
        $user->setAttributes($this->attributes);

        if (!$user->register()) {
            return false;
        }

        return Yii::$app->user->login(User::findByUsername($this->username));
    }

}
