<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tinyUrl".
 *
 * @property integer $id
 * @property string $url
 * @property string $tiny
 */
class TinyUrl extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tinyUrl';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url', 'tiny'], 'required'],
            [['url'], 'string'],
            [['tiny'], 'string', 'max' => 255],
            [['url'], 'unique'],
            [['tiny'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'Url',
            'tiny' => 'Tiny',
        ];
    }
}
