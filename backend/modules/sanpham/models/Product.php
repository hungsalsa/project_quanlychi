<?php

namespace backend\modules\sanpham\models;

use Yii;
use backend\modules\sanpham\models\Motorbike;
use backend\modules\sanpham\models\Manufacture;

/**
 * This is the model class for table "tbl_product".
 *
 * @property int $idPro
 * @property string $proName
 * @property int $quantity
 * @property string $price
 * @property string $note
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $unit đơn vị tính
 * @property int $user_add
 * @property int $bike_id lắp cho xe nào
 * @property int $manu_id Nhà sản xuất
 * @property int $cate_id thuộc nhóm nào
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idPro', 'proName', 'status', 'created_at', 'updated_at', 'unit', 'user_add', 'bike_id', 'manu_id', 'cate_id'], 'required'],
            [['idPro', 'quantity', 'created_at', 'updated_at', 'unit', 'user_add', 'bike_id', 'manu_id', 'cate_id'], 'integer'],
            [['price'], 'number'],
            [['note'], 'string'],
            [['proName'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 4],
            [['idPro', 'proName'], 'unique', 'targetAttribute' => ['idPro', 'proName']],
            [['idPro'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idPro' => 'Id Pro',
            'proName' => 'Pro Name',
            'quantity' => 'Quantity',
            'price' => 'Price',
            'note' => 'Note',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'unit' => 'Unit',
            'user_add' => 'User Add',
            'bike_id' => 'Bike ID',
            'manu_id' => 'Manu ID',
            'cate_id' => 'Cate ID',
        ];
    }

    public function getQuantity($idPro,$status = true)
    {
        $data =  Product::find()->select('quantity')->where('status =:Status AND idPro =:id',['Status'=>$status,'id'=>$idPro])->one();
        if(empty($data)){
            return false;
        }else {
            return $data->quantity;
        }
    }

    // Hàm trả về tên xe lắp trong dropdown list search trong xuất bán hàng
    public function getAllProduct($status = true)
    {
        return $data = Product::find()->asArray()->where('status =:Status',['Status'=>$status])->all();
    }

    public function updateProQuantity($id,$quantity,$status = true)
    {
        $data = Product::find()->where('status =:Status AND idPro =:id',['Status'=>$status,'id'=>$id])->one();

        return $data;
    }
}
