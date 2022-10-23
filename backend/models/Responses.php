<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "responses".
 *
 * @property int $id
 * @property string $create_date
 * @property float $price
 * @property int $project_id
 * @property string $response
 * @property int $status
 * @property int $user_id
 */
class Responses extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'responses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['create_date'], 'safe'],
            [['price', 'project_id', 'response', 'status', 'user_id'], 'required'],
            [['price'], 'number'],
            [['project_id', 'status', 'user_id'], 'integer'],
            [['response'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'create_date' => 'Create Date',
            'price' => 'Price',
            'project_id' => 'Project ID',
            'response' => 'Response',
            'status' => 'Status',
            'user_id' => 'User ID',
        ];
    }
}
