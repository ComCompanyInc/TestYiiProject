<?php

namespace app\models;

use Yii;
use yii\base\Model;

class LoginForm extends Model
{
    public $login;
    public $password;

    public function attributeLabels() {
        return [
            'login' => 'Логин',
            'password' => 'Пароль'
        ];
    }

    public function rules() {
        return [
            [['login', 'password'], 'required'],
            ['password', 'string', 'min' => 6, 'max' => 50],
        ];
    }

    /**
     * Проверка по данным из бд с данными из формы
     * @return false
     */
    public function login()
    {
        // Сначала проверяем, что данные прошли rules() проверку
        if ($this->validate()) {

            // ИЩЕМ пользователя в базе данных по логину
            $user = User::findByUsername($this->login);

            // ПРОВЕРЯЕМ: если пользователь найден И пароль верный
            if ($user && $user->validatePassword($this->password)) {

                // ВХОДИМ в систему
                return Yii::$app->user->login($user);
            }

            // Если логин/пароль неверные - показываем ошибку
            $this->addError('password', 'Неверный логин или пароль');
        }

        return false;
    }
}