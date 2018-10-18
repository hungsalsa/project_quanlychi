<?php

namespace backend\modules\chi\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "tbl_cost_type".
 *
 * @property int $id
 * @property string $name
 * @property string $note
 * @property string $status
 */
class CostType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_cost_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'status'], 'required'],
            [['note'], 'string'],
            [['name', 'status'], 'string', 'max' => 255],
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
            'note' => 'Note',
            'status' => 'Status',
        ];
    }

    public function getAllCosttype()
    {
        return ArrayHelper::map(CostType::find()->asArray()->where('status=:status',['status'=>1])->all(),'id','name');
    }
}
