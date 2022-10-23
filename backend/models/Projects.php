<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "projects".
 *
 * @property int $id
 * @property int $category_id
 * @property string $url
 * @property string $title
 * @property string $description
 * @property string $create_date
 * @property string $end_date
 * @property float $price
 * @property int $responses
 * @property int $views
 * @property int $created_by_id
 * @property int $worker_id
 * @property int $status
 * @property int $rating
 */
class Projects extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projects';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'responses', 'views', 'created_by_id', 'worker_id', 'status', 'rating'], 'integer'],
            [['url', 'title', 'description', 'create_date', 'end_date', 'price', 'created_by_id', 'worker_id', 'rating'], 'required'],
            [['description'], 'string'],
            [['create_date', 'end_date'], 'safe'],
            [['price'], 'number'],
            [['url'], 'string', 'max' => 500],
            [['title'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'url' => 'Url',
            'title' => 'Title',
            'description' => 'Description',
            'create_date' => 'Create Date',
            'end_date' => 'End Date',
            'price' => 'Price',
            'responses' => 'Responses',
            'views' => 'Views',
            'created_by_id' => 'Created By ID',
            'worker_id' => 'Worker ID',
            'status' => 'Status',
            'rating' => 'Rating',
        ];
    }
}
