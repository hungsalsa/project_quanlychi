<?php

namespace backend\modules\sanpham\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "tbl_product_cate".
 *
 * @property int $idCate
 * @property string $cateName
 * @property string $note
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $user_add
 */
class ProductCate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_product_cate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cateName', 'status', 'created_at', 'updated_at', 'user_add'], 'required'],
            [['note'], 'string'],
            [['created_at', 'updated_at', 'user_add'], 'integer'],
            [['cateName'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idCate' => 'Id Cate',
            'cateName' => 'Cate Name',
            'note' => 'Note',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_add' => 'User Add',
        ];
    }

    public function getAllCate($status=true)
    {
        return ArrayHelper::map(ProductCate::find()->where('status =:Status',['Status'=>$status])->all(),'idCate','cateName');
    }

    public function getCateName($id,$status=true)
    {
        $data =  ProductCate::find()->select('cateName')->where('status =:Status AND idCate=:id',['Status'=>$status,'id'=>$id])->one();
        return $data->cateName;
    }
}
