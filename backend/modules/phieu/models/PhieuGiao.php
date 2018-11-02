<?php

namespace backend\modules\phieu\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "phieu_giao".
 *
 * @property int $id
 * @property string $ngay_giao
 * @property int $sophieu_dau
 * @property int $sophieu_cuoi
 * @property int $nguoi_giao
 * @property int $nguoi_nhan
 * @property string $note
 */
class PhieuGiao extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phieu_giao';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ngay_giao', 'sophieu_dau', 'sophieu_cuoi', 'nguoi_giao', 'nguoi_nhan'], 'required'],
            [['ngay_giao'], 'safe'],
            [['sophieu_dau', 'sophieu_cuoi', 'nguoi_giao', 'nguoi_nhan'], 'integer'],
            [['note'], 'string'],
            [['ngay_giao'], 'unique'],
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
            'sophieu_dau' => 'Sophieu Dau',
            'sophieu_cuoi' => 'Sophieu Cuoi',
            'nguoi_giao' => 'Nguoi Giao',
            'nguoi_nhan' => 'Nguoi Nhan',
            'note' => 'Note',
        ];
    }

    public function getAllDatePhieu()
    {
        return ArrayHelper::map(PhieuGiao::find()->all(),'ngay_giao','ngay_giao');
    }

    
}
