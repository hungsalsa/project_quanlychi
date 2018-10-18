<?php

namespace backend\modules\chi\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "tbl_employee".
 *
 * @property int $id
 * @property string $name
 * @property string $phone
 * @property string $location
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $user_add
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_employee';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'location', 'status', 'created_at', 'updated_at', 'user_add'], 'required'],
            [['created_at', 'updated_at', 'user_add'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 12],
            [['location'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 4],
            ['status', 'default', 'value' => true],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'phone' => 'Phone',
            'location' => 'Location',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_add' => 'User Add',
        ];
    }

    public function getAllEmployee()
    {
        return ArrayHelper::map(Employee::find()->asArray()->where('status=:status',['status'=>true])->all(),'id','name');
    }
}
