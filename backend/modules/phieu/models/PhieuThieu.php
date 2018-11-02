<?php

namespace backend\modules\phieu\models;

use Yii;
use backend\modules\phieu\models\PhieuSophieu;
/**
 * This is the model class for table "phieu_thieu".
 *
 * @property int $id
 * @property string $ngay_giao
 * @property int $so_phieu
 * @property int $status
 */
class PhieuThieu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phieu_thieu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ngay_giao', 'so_phieu', 'status'], 'required'],
            [['ngay_giao'], 'safe'],
            [['so_phieu'], 'integer'],
            [['status'], 'string', 'max' => 4],
            [['so_phieu'], 'unique'],
            [['so_phieu'], 'check_phieu'],
            // ['quantity','validateNumber','params'=>['note'=>'note']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ngay_giao' => 'Ngay Giao',
            'so_phieu' => 'So Phieu',
            'status' => 'Status',
        ];
    }

    public function check_phieu($attribute, $params)
    {
        $phieu = new PhieuSophieu();
        if(!$phieu->checkphieu($this->ngay_giao,$this->$attribute)){
            $this->addError($attribute, 'Ngày này không có phiếu này, xin kiểm tra lại');
        }
    }
    
    // public function validateNumber($attribute, $params)
    // {
    //     $product = new Product();

    //     $num_product = $product->getQuantity($this->pro_id);
    //     $quantity = $this->$attribute;
    //     // print_r($params);die;
    //     if ($num_product - $quantity <0 ) {
    //         $this->addError($attribute, 'So luong trong kho ko du');
    //     }
    //     if ($quantity <= 0 ) {
    //         $this->addError($attribute, 'So luong nhap vao phai > 0');
    //     }
    // }
}
