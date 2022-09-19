<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "messages".
 *
 * @property int $id
 * @property int $project_id
 * @property int $response_id
 * @property int $from_user_id
 * @property int $to_user_id
 * @property string $message
 * @property string $create_date
 * @property int $status
 */
class Messages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'messages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_id', 'response_id', 'from_user_id', 'to_user_id', 'message', 'status'], 'required'],
            [['project_id', 'response_id', 'from_user_id', 'to_user_id', 'status'], 'integer'],
            [['message'], 'string'],
            [['create_date'], 'safe'],
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
            'response_id' => 'Response ID',
            'from_user_id' => 'From User ID',
            'to_user_id' => 'To User ID',
            'message' => 'Message',
            'create_date' => 'Create Date',
            'status' => 'Status',
        ];
    }
}
