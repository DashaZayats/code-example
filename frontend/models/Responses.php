<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "responses".
 *
 * @property int $id
 * @property int $project_id
 * @property int $user_id
 * @property string $response
 * @property float $price
 * @property int $status
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
            [['project_id', 'user_id', 'response', 'price', 'status'], 'required'],
            [['project_id', 'user_id', 'status'], 'integer'],
            [['response'], 'string'],
            [['price'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'project_id' => 'Project ID',
            'user_id' => 'User ID',
            'response' => 'Response',
            'price' => 'Price',
            'status' => 'Status',
        ];
    }
}
