<?php

namespace app\services;

use app\models\Person;
use app\models\Role;
use app\models\User;
use Yii;

class SecurityService
{
//    const DEFAULT_ROLE = 'Покупатель';

    /**
     * Сохраняем форму с пользователем и персоной.
     * @param array $formData Форма с данными.
     * @return bool Успешно/неуспешно.
     * @throws \yii\base\Exception
     * @throws \yii\db\Exception
     */
    public function createUser($formData): bool
    {
        $person = new Person();

        $person->name = $formData['name'];
        $person->surname = $formData['surname'];
        $person->patronymic = $formData['patronymic'];

        if ($person->save()) {
            $userRole = Role::findOne(['name' => RoleService::DEFAULT_ROLE]);

            $user = new User();

            $user->login = $formData['login'];
            $user->password = Yii::$app->security->generatePasswordHash($formData['password']);
            $user->person_id = $person->id;
            $user->role_id = $userRole->id;

            if($user->save()) {
                return true;
            } else {
                Yii::error('Ошибки сохранения пользователя: ' . print_r($user->errors, true));
                return false;
            }
        } else {
            return false;
        }

        return true;
    }
}