<?php

namespace backend\modules\sanpham\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "tbl_motorbike".
 *
 * @property int $id
 * @property string $bikeName
 * @property string $note
 * @property int $status
 */
class Motorbike extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_motorbike';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bikeName', 'status'], 'required'],
            [['note'], 'string'],
            [['bikeName'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bikeName' => 'Bike Name',
            'note' => 'Note',
            'status' => 'Status',
        ];
    }

    public function getAllMotorbike($status=true)
    {
        return ArrayHelper::map(Motorbike::find()->where('status =:Status',['Status'=>$status])->all(),'id','bikeName');
    }

    public function getMotorName($id,$status=true)
    {
        $data =  Motorbike::find()->select('bikeName')->where('status =:Status AND id=:id',['Status'=>$status,'id'=>$id])->one();
        if (empty($data)) {
            return false;
        } else {
            return $data->bikeName;
        }
    }
}
