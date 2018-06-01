<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "paid".
 *
 * @property int $id
 * @property string $paid
 */
class Paid extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'paid';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['paid'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'paid' => 'Paid',
        ];
    }
}
