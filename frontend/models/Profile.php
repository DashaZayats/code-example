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
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'description', 'price_per_hour'], 'required'],
            [['username'], 'string', 'max' => 250],
            [['description'], 'string'],
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
            'username' => 'Имя (псевдоним)',
            'description' => 'Обо мне',
            'imageFile' => 'Фото',
            'price_per_hour' => 'Стоимость работы час, $',
        ];
    }
}
