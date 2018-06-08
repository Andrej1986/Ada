<?php

namespace backend\models;

use Yii;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "name".
 *
 * @property int $id
 * @property string $name
 */
class Name extends \yii\db\ActiveRecord
{
	public $imageFile;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'name';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['name'], 'string', 'max' => 200],
			[['name'], 'unique'],
			[['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
		];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Názov',
            'imageFile' => 'Fotka',
        ];
    }

	public function upload()
	{
		if ($this->validate() && !empty($this->imageFile)) {
			if (!is_dir(Yii::$app->basePath . '/web/uploads/main/' . $this->name)) {
				mkdir(Yii::$app->basePath . '/web/uploads/main/' . $this->name);
			}elseif(is_dir(Yii::$app->basePath . '/web/uploads/main/' . $this->name)){
				FileHelper::removeDirectory(Yii::$app->basePath . '/web/uploads/main/' . $this->name);
				mkdir(Yii::$app->basePath . '/web/uploads/main/' . $this->name);
			}

			$this->imageFile->saveAs('uploads/main/' . ($this->name ?: null) . ($this->name ? '/' : null) . $this->imageFile->baseName . '.' . $this->imageFile->extension);
			return true;
		} else {
			return true;
		}
	}
}
