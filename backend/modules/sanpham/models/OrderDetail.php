<?php

namespace backend\modules\sanpham\models;

use Yii;
use backend\modules\sanpham\models\Product;
use yii\validators\Validator;
/**
 * This is the model class for table "tbl_order_detail".
 *
 * @property int $id
 * @property int $order_id
 * @property int $pro_id
 * @property int $quantity
 * @property int $price_sales
 * @property string $bill_number số hóa đơn
 *
 * @property TblOrder $order
 */
class OrderDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_order_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pro_id', 'quantity', 'bill_number'], 'required'],
            [['order_id', 'pro_id', 'quantity', 'price_sales','total_number'], 'integer'],
            [['bill_number'], 'string', 'max' => 255],
            [['note'], 'string'],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['order_id' => 'idOrder']],
            ['quantity','validateNumber','params'=>['note'=>'note']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'pro_id' => 'Tên sản phẩm',
            'quantity' => 'Số lượng',
            'price_sales' => 'Giá bán',
            'total_number' => 'Thành tiền',
            'bill_number' => 'Số hóa đơn',
            'note' => 'Ghi chú',
        ];
    }

    public function validateNumber($attribute, $params)
    {
        $product = new Product();

        $num_product = $product->getQuantity($this->pro_id);
        $quantity = $this->$attribute;
        // print_r($params);die;
        if ($num_product - $quantity <0 ) {
            $this->addError($attribute, 'So luong trong kho ko du');
        }
        if ($quantity <= 0 ) {
            $this->addError($attribute, 'So luong nhap vao phai > 0');
        }
    }

    // public function validateQuantity($attribute, $params)
    // {
    //     $product = new Product();

    //     $pro_id = $this->$params['pro_id'];
    //     $num_product = $product->getQuantity($pro_id);

    //     // $number_check = $this->$attribute;
    //     $number_salse= $this->$attribute;

    //     if ($num_product - $number_salse <= 0) {
    //         $this->addError($attribute, 'Sản phẩm này không đủ số lượng bạn yêu cầu');
    //     }
    // }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['idOrder' => 'order_id']);
    }
}
