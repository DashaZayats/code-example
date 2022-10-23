<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "profile_rating".
 *
 * @property int $id
 * @property int $user_id
 * @property int $rating
 * @property int $from_user_id
 */
class Rating extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profile_rating';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'rating', 'from_user_id'], 'required'],
            [['user_id', 'rating', 'from_user_id'], 'integer'],
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
            'rating' => 'Rating',
            'from_user_id' => 'From User ID',
        ];
    }
}
