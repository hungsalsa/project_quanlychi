<?php

namespace backend\modules\quantri\models;

use Yii;

/**
 * This is the model class for table "tbl_backend_user".
 *
 * @property int $id
 * @property string $username
 * @property string $fullName
 * @property string $password
 * @property string $authkey
 * @property int $created_et
 * @property int $updated_at
 * @property int $user_add
 */
class BackendUser extends \yii\db\ActiveRecord implements yii\web\IdentityInterface 
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_backend_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'fullName', 'password', 'authkey', 'created_et', 'updated_at', 'user_add'], 'required'],
            [['created_et', 'updated_at', 'user_add'], 'integer'],
            [['username', 'authkey'], 'string', 'max' => 50],
            [['fullName'], 'string', 'max' => 80],
            [['password'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'fullName' => 'Full Name',
            'password' => 'Password',
            'authkey' => 'Authkey',
            'created_et' => 'Created Et',
            'updated_at' => 'Updated At',
            'user_add' => 'User Add',
        ];
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

     public function getId()
    {
        return $this->id;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new \yii\base\NotSupportedException();
        // return static::findOne(['access_token' => $token]);
    }
}
