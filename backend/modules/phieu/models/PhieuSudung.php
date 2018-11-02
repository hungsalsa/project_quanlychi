<?php

namespace backend\modules\phieu\models;

use Yii;
use backend\modules\phieu\models\PhieuSophieu;
/**
 * This is the model class for table "phieu_sudung".
 *
 * @property int $id
 * @property int $so_phieu_dau
 * @property int $so_phieu_cuoi
 * @property string $ngay_sd
 * @property string $phieu_huy lam thanh select multi
 * @property int $sl_phieu_tot
 * @property int $ke_toan
 * @property string $note
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $user_create
 */
class PhieuSudung extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phieu_sudung';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['so_phieu_dau', 'so_phieu_cuoi', 'ngay_sd', 'created_at', 'updated_at', 'user_create','ke_toan'], 'required'],
            [['so_phieu_dau', 'so_phieu_cuoi', 'sl_phieu_tot', 'ke_toan', 'created_at', 'updated_at', 'user_create'], 'integer'],
            [['ngay_sd'], 'safe'],
            [['note'], 'string'],
            // [['so_phieu_dau'], 'unique'],
            // [['so_phieu_cuoi'], 'unique'],
            [['so_phieu_cuoi'], 'validatePhieu', 'on' => 'createnew'],
            [['so_phieu_cuoi'], 'validatePhieuUpdate', 'on' => 'update'],
            // [['phieu_huy'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 4],
            ['so_phieu_cuoi', 'compare','compareAttribute'=>'so_phieu_dau','operator'=>'>', 'message'=>'Số cuối phải lơn hơn số đầu', 'type' => 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'so_phieu_dau' => 'So Phieu Dau',
            'so_phieu_cuoi' => 'So Phieu Cuoi',
            'ngay_sd' => 'Ngay Sd',
            'phieu_huy' => 'Phieu Huy',
            'sl_phieu_tot' => 'Sl Phieu Tot',
            'ke_toan' => 'Ke Toan',
            'note' => 'Note',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_create' => 'User Create',
        ];
    }

    // Kiem tra so phieu da su dung chua tạo mới
    public function validatePhieu($attribute, $params)
    {
        $so_phieu_dau = $this->so_phieu_dau;
        $so_phieu_cuoi = $this->$attribute;
        while ($so_phieu_dau<=$so_phieu_cuoi) {
            $check = PhieuSophieu::checkPhieuSD($so_phieu_dau);
            if($check){
                $this->addError($attribute, 'trong các số phiếu này đã đã có phiếu sử dụng xin kiểm tra lại');
            }
            $so_phieu_dau++;
        }
        
    }
    // Kiem tra so phieu da su dung chua update
    public function validatePhieuUpdate($attribute, $params)
    {
        $ngay_sd = $this->ngay_sd;
        $so_phieu_dau = $this->so_phieu_dau;
        $so_phieu_cuoi = $this->$attribute;
        while ($so_phieu_dau<=$so_phieu_cuoi) {
            $check = PhieuSophieu::checkPhieuSDUpdate($so_phieu_dau,$ngay_sd);
            if($check){
                $this->addError($attribute, 'trong các số phiếu này đã đã có phiếu sử dụng xin kiểm tra lại');
            }
            $so_phieu_dau++;
        }
        
    }

    
    public function getPhieuTons()
    {
        return $this->hasMany(PhieuTon::className(), ['ngay_sd' => 'id']);
    }

    // public function check_phieu($attribute, $params)
    // {
    //     $phieu = new PhieuSophieu();
    //     if(!$phieu->checkphieu($this->ngay_giao,$this->$attribute)){
    //         $this->addError($attribute, 'Ngày này không có phiếu này, xin kiểm tra lại');
    //     }
    // }
}
