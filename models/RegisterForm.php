<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\base\Event;


/**
 * RegisterForm is the model behind the login form.
 *
 *
 */
class RegisterForm extends Model
{
    const EVENT_REGISTER = 'userRegister';

    public $username;
    public $password;
    public $email;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password', 'email'], 'required'],
            // username is validated by validateUsername()
            ['username', 'validateUsername'],
            ['email', 'email'],
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

        $event = new Event;
        $event->data = ['username' => $this->username,
                        'email' => $this->email];

        $this->trigger(self::EVENT_REGISTER, $event);

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
