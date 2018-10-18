<?php

namespace backend\modules\quantri\models;

use Yii;

/**
 * This is the model class for table "tbl_news".
 *
 * @property int $id
 * @property string $name
 * @property string $link
 * @property string $images
 * @property int $category_id
 * @property string $htmltitle
 * @property string $htmlkeyword
 * @property string $htmldescriptions
 * @property string $content
 * @property int $hot
 * @property int $view
 * @property string $tag
 * @property int $sort
 * @property int $status
 * @property int $user_add
 * @property string $created_at
 * @property string $updated_at
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'category_id', 'content', 'status', 'user_add', 'created_at', 'updated_at'], 'required'],
            [['category_id', 'hot', 'view', 'sort', 'user_add'], 'integer'],
            [['htmldescriptions', 'content'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'link', 'images', 'htmltitle', 'htmlkeyword', 'tag'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'link' => 'Link',
            'images' => 'Images',
            'category_id' => 'Category ID',
            'htmltitle' => 'Htmltitle',
            'htmlkeyword' => 'Htmlkeyword',
            'htmldescriptions' => 'Htmldescriptions',
            'content' => 'Content',
            'hot' => 'Hot',
            'view' => 'View',
            'tag' => 'Tag',
            'sort' => 'Sort',
            'status' => 'Status',
            'user_add' => 'User Add',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
