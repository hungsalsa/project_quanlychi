<?php

namespace backend\modules\chi\models;

use Yii;

/**
 * This is the model class for table "tbl_expenditure".
 *
 * @property int $id
 * @property string $day Ngày chi
 * @property int $total_money
 * @property string $note
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $user_add
 *
 * @property TblExpenditureItems[] $tblExpenditureItems
 */
class Chingay extends \yii\db\ActiveRecord
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
            [['day','cuahang_id', 'status', 'created_at', 'updated_at', 'user_add'], 'required'],
            [['day'], 'safe'],
            [['created_at','cuahang_id', 'updated_at', 'user_add'], 'integer'],
            [['note'], 'string'],
            [['status'], 'string', 'max' => 4],
            [['day'], 'unique','message'=>'{attribute} này đã có'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'day' => 'Ngày chi',
            'cuahang_id' => 'Cửa hàng',
            'total_money' => 'Tổng tiền',
            'note' => 'Ghi chú',
            'status' => 'Kích hoạt',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_add' => 'User Add',
        ];
    }

    public function getAllChi()
    {
        return Chingay::find()
                    ->joinWith('chitietchi')
                    ->where(['tbl_expenditure.status' => true])
                    ->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChitietchi()
    {
        return $this->hasMany(Chitietchi::className(), ['expenditure_id' => 'id']);
    }

    public function getOneChingay($day,$status = true)
    {
        $data =  self::find()->select('total_money')->where('day =:date AND status=:status',[':date'=>$day,':status'=>$status])->one();
        return $data->total_money;
    }
}
