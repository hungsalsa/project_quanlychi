<?php

namespace backend\modules\chi\models;

use Yii;

/**
 * This is the model class for table "tbl_expenditure".
 *
 * @property int $id
 * @property string $day Ngày chi
 * @property int $total_money
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $user_add
 *
 * @property TblExpenditureItems[] $tblExpenditureItems
 */
class Expenditure extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_expenditure';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['day', 'status', 'created_at', 'updated_at', 'user_add'], 'required'],
            [['day'], 'safe'],
            [['total_money', 'created_at', 'updated_at', 'user_add'], 'integer'],
            [['note'], 'string'],
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
            'day' => 'Day',
            'total_money' => 'Total Money',
            'note' => 'Note',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_add' => 'User Add',
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExpenditureItems()
    {
        return $this->hasMany(ExpenditureItems::className(), ['expenditure_id' => 'id']);
    }

}
