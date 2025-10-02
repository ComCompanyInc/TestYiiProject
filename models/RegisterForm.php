<?php

namespace app\models;

use yii\base\Model;

class RegisterForm extends Model
{
    public $name;
    public $surname;
    public $patronymic;

    public $login;
    public $password;

    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'patronymic' => 'Отчество',
            'login' => 'Логин',
            'password' => 'Пароль',
        ];
    }

    public function rules()
    {
        return [
            [['name', 'surname', 'patronymic', 'login', 'password'], 'required', 'message' => 'Поле обязательное!'],
            ['password', 'string', 'min' => 6],
            [['name', 'surname', 'patronymic'], 'string', 'max' => 40]
        ];
    }
}