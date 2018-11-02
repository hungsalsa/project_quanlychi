<?php

namespace backend\modules\sanpham\models;

use Yii;

/**
 * This is the model class for table "tbl_order".
 *
 * @property int $idOrder
 * @property string $cusName
 * @property int $user_sales
 * @property string $date
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $user_add
 *
 * @property TblOrderDetail[] $tblOrderDetails
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cusName', 'user_sales', 'date', 'status', 'created_at', 'updated_at', 'user_add'], 'required'],
            [['user_sales', 'created_at', 'updated_at', 'user_add'], 'integer'],
            [['date'], 'safe'],
            [['cusName'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idOrder' => 'Id Order',
            'cusName' => 'Tên khách',
            'user_sales' => 'Người bán',
            'date' => 'Ngày bán',
            'status' => 'Trạng thái',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_add' => 'User Add',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderDetails()
    {
        return $this->hasMany(OrderDetail::className(), ['order_id' => 'idOrder']);
    }
}
