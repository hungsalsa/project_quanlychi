<?php

namespace backend\modules\chi\models;

use Yii;

/**
 * This is the model class for table "tbl_expenditure_items".
 *
 * @property int $id
 * @property int $type
 * @property string $items_name
 * @property int $quantity
 * @property double $money
 * @property string $motorbike
 * @property string $sea_control
 * @property int $accounting_id
 * @property int $employee_id
 * @property int $expenditure_id
 *
 * @property TblExpenditure $expenditure
 */
class Chitietchi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_expenditure_items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'items_name', 'quantity', 'money', 'motorbike', 'sea_control', 'accounting_id', 'employee_id'], 'required'],
            [['type', 'quantity', 'accounting_id', 'employee_id', 'expenditure_id','motorbike'], 'integer'],
            // [['money'], 'number'],
            [['items_name','note'], 'string', 'max' => 255],
            // [['motorbike'], 'string', 'max' => 50],
            [['sea_control'], 'string', 'max' => 20],
            [['expenditure_id'], 'exist', 'skipOnError' => true, 'targetClass' => Chingay::className(), 'targetAttribute' => ['expenditure_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Loại chi',
            'items_name' => 'Tên khoản chi',
            'quantity' => 'Số lượng',
            'money' => 'Số tiền',
            'motorbike' => 'Cho xe',
            'sea_control' => 'Biển số',
            'accounting_id' => 'Kế toán',
            'employee_id' => 'Người chi',
            'note' => 'Ghi chú',
            'expenditure_id' => 'Expenditure ID'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExpenditure()
    {
        return $this->hasOne(Expenditure::className(), ['id' => 'expenditure_id']);
    }
}
