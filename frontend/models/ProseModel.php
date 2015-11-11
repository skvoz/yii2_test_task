<?php

namespace app\models;

use common\models\User;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "prose".
 *
 * @property integer $id
 * @property string $text
 * @property integer $grade_level_id
 * @property string $keywords
 * @property integer $created_at
 * @property integer $updated_at
 */
class ProseModel extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'prose';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text', 'grade_level_id', 'keywords'], 'required'],
            [['text'], 'string'],
            [['grade_level_id', 'created_at', 'updated_at'], 'integer'],
            [['keywords'], 'string', 'max' => 100]
        ];
    }


    public function beforeSave($insert)
    {
        parent::beforeSave($insert);
        $this->user_id = \Yii::$app->user->id;
        return true;
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Text',
            'grade_level_id' => 'Grade Level ID',
            'keywords' => 'Keywords',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getUser()
    {
        return self::hasOne(User::class, ['id' => 'user_id']);
    }

    public function getGradeLevel()
    {
        return self::hasOne(GradeLevelModel::class, ['id' => 'grade_level_id']);
    }
}
