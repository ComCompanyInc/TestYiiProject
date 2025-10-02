<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property int $person_id
 * @property string|null $login
 * @property string|null $password
 *
 * @property Bucket[] $buckets
 * @property Person $person
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['login', 'password'], 'default', 'value' => null],
            [['person_id', 'role_id'], 'required'],
            [['person_id', 'role_id'], 'integer'],
            [['login'], 'string', 'max' => 100],
            [['password'], 'string', 'max' => 150],
            [['person_id'], 'exist', 'skipOnError' => true, 'targetClass' => Person::class, 'targetAttribute' => ['person_id' => 'id']],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Role::class, 'targetAttribute' => ['role_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'person_id' => 'Person ID',
            'login' => 'Login',
            'password' => 'Password',
        ];
    }

    /**
     * Gets query for [[Buckets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBuckets()
    {
        return $this->hasMany(Bucket::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Person]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(Person::class, ['id' => 'person_id']);
    }

    public function getRole()
    {
        return $this->hasOne(Role::class, ['id' => 'role_id']);
    }

    //identityUserInterface methods:
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return null;
    }

    public function validateAuthKey($authKey)
    {
        return null;
    }

    /**
     * Поиск пользователя по логину
     * @param $username
     * @return User|null
     */
    public static function findByUsername($username) {
        return static::findOne(['login' => $username]);
    }

    public function validatePassword($password) {
        return Yii::$app->security->validatePassword($password, $this->password);
    }
}
