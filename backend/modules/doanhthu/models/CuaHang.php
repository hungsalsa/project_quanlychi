<?php

namespace backend\modules\doanhthu\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "tbl_cua_hang".
 *
 * @property int $id
 * @property string $name
 * @property string $note
 * @property string $address
 * @property int $status
 * @property string $phone
 */
class CuaHang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_cua_hang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'status', 'phone'], 'required'],
            [['note'], 'string'],
            [['name', 'address'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 4],
            [['phone'], 'string', 'max' => 11],
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
            'note' => 'Note',
            'address' => 'Address',
            'status' => 'Status',
            'phone' => 'Phone',
        ];
    }

    public function getAllCuahang($status=true)
    {
        return ArrayHelper::map(self::find()->asArray()->where('status=:status',['status'=>$status])->all(),'id','name');
    }
}
