<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property int $id
 * @property int $user_id
 * @property string $description
 * @property string $photo
 * @property string $type
 * @property float $price_per_hour
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'description', 'price_per_hour'], 'required'],
            [['user_id'], 'integer'],
            [['description', 'type'], 'string'],
            [['price_per_hour'], 'number'],
            [['imageFile'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'description' => 'Description',
            'imageFile' => 'Photo',
            'type' => 'Type',
            'price_per_hour' => 'Price Per Hour',
        ];
    }
}
