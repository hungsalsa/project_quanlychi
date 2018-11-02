<?php

namespace backend\modules\phieu\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "phieu_sophieu".
 *
 * @property int $id
 * @property int $so_phieu
 * @property string $ngay_giao
 * @property int $status 0=> ko tồn
 1=>tồn
 */
class PhieuSophieu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phieu_sophieu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ngay_giao', 'so_phieu'], 'required'],
            [['ngay_giao', 'ngay_sd', 'ngay_tt'], 'safe'],
            [['so_phieu'], 'integer'],
            [['status'], 'string', 'max' => 4],
            [['so_phieu'], 'unique'],
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
            'ngay_sd' => 'Ngay Sd',
            'ngay_tt' => 'Ngay Tt',
            'so_phieu' => 'So Phieu',
            'status' => 'Status',
        ];
    }

    public function xoaphieu($ngay_giao,$so_phieu)
    {
        $data = PhieuSophieu::find()->where('ngay_giao =:Day AND so_phieu =:So',[':Day'=>$ngay_giao,':So'=>$so_phieu])->one();
        return $data->delete();
    }

    public function XoaPhieu_LuuPhieu($ngay_giao,$phieu_dau,$phieu_cuoi)
    {
        $data = $this->getAll_byDate($ngay_giao);
        foreach ($data as $value) {
            if($value->so_phieu >= $phieu_dau && $value->so_phieu <= $phieu_cuoi){
                continue;
            }else {
                $value->delete();
            }
        }

        $i = $phieu_dau;
        while ($i<=$phieu_cuoi) {
            $phieu = new PhieuSophieu();
            $phieu->so_phieu =$i;
            $phieu->ngay_giao =$ngay_giao;

            if(!$phieu->save()) {
                var_dump($phieu->errors);die;
            }
            $i++;
        }
    }

    public function getAll_byDate($ngay_giao)
    {
        return  PhieuSophieu::find()->where('ngay_giao =:Ngay_giao',[':Ngay_giao'=>$ngay_giao])->all();
    }

    public function getAllPhieu()
    {
        return ArrayHelper::map(PhieuSophieu::find()->all(),'so_phieu','so_phieu');
    }

    // public function getSubCatList($cat_id)
    // {
    //     return  PhieuSophieu::find()->select(['ngay_giao','so_phieu'])->distinct(true)->where('ngay_giao =:ngay',[':ngay'=>$cat_id])->asArray()->all();
    // }

    public function checkphieu($ngay_giao,$so_phieu)
    {
        return self::find()->where('ngay_giao =:Ngay AND so_phieu=:SO',[':Ngay'=>$ngay_giao,':SO'=>$so_phieu])->count();
        // return self::find()->where('ngay_giao =:Ngay AND so_phieu =:So',[':Ngay'=>$ngay,':So'=>$so_phieu])->count();
    }

    // Hàm update ngay su dung phieu
    public function updatePhieu($date,$sodau,$socuoi)
    {
        for ($i = $sodau; $i <= $socuoi; $i++) {
            $phieu2 = new PhieuSophieu();
            $phieu_result = $phieu2->getPhieu($i);
            if(!$phieu_result){
                continue;
            }
            $phieu_result->ngay_sd = $date;
            if($phieu_result->save(false)){
                var_dump($phieu_result->errors);
            }

        }
    }

    // Hàm tìm số phiếu trả về đối tượng
    public function getPhieu($sophieu)
    {
        return self::find()->where('so_phieu =:SO',[':SO'=>$sophieu])->one();
    }

    // Kiểm tra số phiếu đã sử dụng hay chưa, nếu rồi trả về true
    // Hàm này sử dụng cho tạo mới
    public function checkPhieuSD($sophieu,$ngay = true)
    {
        $data = self::find()->where('so_phieu =:SO AND ngay_sd !=:Ngay',[':SO'=>$sophieu,':Ngay'=>$ngay])->one();
        return $data;
    }
    // Kiểm tra số phiếu đã sử dụng hay chưa, nếu rồi trả về true
    // Hàm này sử dụng cho tạo mới
    public function checkPhieuSDUpdate($sophieu,$ngay)
    {
        $data = self::find()->where('so_phieu =:SO AND ngay_sd !=:Ngay',[':SO'=>$sophieu,':Ngay'=>$ngay])->one();
        return $data;
    }

    // Hàm trả về tất cả các phiếu có ngày sử dụng truyền vào
    public function getAllBillByDateUse($ngay_sd)
    {
        return self::find()->where('ngay_sd !=:Ngay',[':Ngay'=>$ngay_sd])->all();
    }
}
