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
            // username is validated by validateUsername()
            ['username', 'validateUsername'],
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

    /**
     * Validates the username.
     * This method serves as the inline validation for username.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateUsername($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = User::findByUsername($this->username);

            if ($user) {
                $this->addError($attribute, 'Такое имя уже есть');
            }
        }
    }

    
    
}
