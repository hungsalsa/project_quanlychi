<?php

namespace backend\modules\doanhthu\models;

use Yii;

/**
 * This is the model class for table "tbl_doanh_thu".
 *
 * @property int $id
 * @property string $ngay
 * @property int $tt_ck
 * @property int $tt_the
 * @property int $tt_tien_mat
 * @property int $tien_chi
 * @property int $tien_hom Tiền đếm trong hòm
 * @property int $tien_le tiền lẻ giao còn thừa
 * @property int $chenh_lech
 * @property int $ketoan
 * @property int $nguoi_ky
 * @property string $note
 * @property int $cua_hang
 * @property int $created_at
 * @property int $updated_at
 * @property int $user_add
 */
class DoanhThu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_doanh_thu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ngay', 'giao_sang', 'tt_tien_mat', 'tien_hom', 'ketoan', 'nguoi_ky', 'cua_hang', 'status', 'created_at', 'updated_at', 'user_add'], 'required'],
            [['ngay', 'tien_chi', 'chenh_lech'], 'safe'],
            [['giao_sang', 'tt_ck', 'tt_the', 'tt_tien_mat', 'tong_doanh_thu_phieu', 'doanh_thu_thuc', 'thu_khac', 'tien_chi', 'tien_hom', 'tien_le', 'chenh_lech', 'ketoan', 'nguoi_ky', 'cua_hang', 'created_at', 'updated_at', 'user_add'], 'integer'],
            [['note'], 'string'],
            [['status'], 'string', 'max' => 4],
            [['ngay'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ngay' => 'Ngay',
            'giao_sang' => 'Giao Sang',
            'tt_ck' => 'Tiền chuyển khoản',
            'tt_the' => 'Tt The',
            'tt_tien_mat' => 'Tt Tien Mat',
            'tong_doanh_thu_phieu' => 'Tong Doanh Thu Phieu',
            'doanh_thu_thuc' => 'Doanh Thu Thuc',
            'thu_khac' => 'Thu Khac',
            'tien_chi' => 'Tien Chi',
            'tien_hom' => 'Tien Hom',
            'tien_le' => 'Tien Le',
            'chenh_lech' => 'Chenh Lech',
            'ketoan' => 'Ketoan',
            'nguoi_ky' => 'Nguoi Ky',
            'note' => 'Note',
            'cua_hang' => 'Cua Hang',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_add' => 'User Add',
        ];
    }
}
