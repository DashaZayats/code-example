<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jobs".
 *
 * @property int $id
 * @property int $parent_id
 * @property string $url
 * @property string $title
 * @property string $description
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property int $pos
 * @property int $status
 * @property string $icon
 */
class Jobs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jobs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'pos', 'status'], 'integer'],
            [['url', 'title', 'description', 'meta_title', 'meta_description', 'meta_keywords', 'icon'], 'required'],
            [['description', 'meta_description', 'meta_keywords'], 'string'],
            [['url', 'title', 'icon'], 'string', 'max' => 250],
            [['meta_title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'url' => 'Url',
            'title' => 'Title',
            'description' => 'Description',
            'meta_title' => 'Meta Title',
            'meta_description' => 'Meta Description',
            'meta_keywords' => 'Meta Keywords',
            'pos' => 'Pos',
            'status' => 'Status',
            'icon' => 'Icon',
        ];
    }
}
