<?php

namespace common\models;

use backend\models\Name;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property int $id
 * @property int $name_id
 * @property string $text
 * @property string $time
 *
 * @property Name $name
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text'], 'required'],
            [['name_id'], 'integer'],
            [['text'], 'string', 'length' => [2, 200]],
            [['time'], 'safe'],
            [['name_id'], 'exist', 'skipOnError' => true, 'targetClass' => Name::className(), 'targetAttribute' => ['name_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_id' => 'Name ID',
            'text' => 'Komentovať',
            'time' => 'Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getName()
    {
        return $this->hasOne(Name::className(), ['id' => 'name_id']);
    }
}
