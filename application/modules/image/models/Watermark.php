<?php

namespace app\modules\image\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "watermark".
 * @property integer $id
 * @property string $watermark_src
 * @property string $position
 */
class Watermark extends \yii\db\ActiveRecord
{
    /**
     * @var mixed image the attribute for rendering the file input
     * widget for upload on the form
     */
    public $image;
    const POSITION_TOP_LEFT = 'TOP LEFT';
    const POSITION_TOP_RIGHT = 'TOP RIGHT';
    const POSITION_BOTTOM_LEFT = 'BOTTOM LEFT';
    const POSITION_BOTTOM_RIGHT = 'BOTTOM RIGHT';
    const POSITION_CENTER = 'CENTER';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%watermark}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image'], 'safe'],
            [['image'], 'file', 'extensions' => 'jpg, gif, png'],
            [['watermark_src'], 'required'],
            [['watermark_src'], 'string', 'max' => 255],
            [['position'], 'string'],
        ];
    }

    public static function getPositions()
    {
        return [
            self::POSITION_TOP_LEFT => Yii::t('app', 'TOP LEFT'),
            self::POSITION_TOP_RIGHT => Yii::t('app', 'TOP RIGHT'),
            self::POSITION_BOTTOM_LEFT => Yii::t('app', 'BOTTOM LEFT'),
            self::POSITION_BOTTOM_RIGHT => Yii::t('app', 'BOTTOM RIGHT'),
            self::POSITION_CENTER => Yii::t('app', 'CENTER'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'watermark_src' => Yii::t('app', 'Watermark Src'),
            'position' => Yii::t('app', 'Position'),
            'image' => Yii::t('app', 'Image'),
        ];
    }

    /**
     * Search tasks
     * @param $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        /** @var $query \yii\db\ActiveQuery */
        $query = self::find();
        $dataProvider = new ActiveDataProvider(
            [
                'query' => $query,
                'pagination' => [
                    'pageSize' => 10,
                ],
            ]
        );
        if (!($this->load($params))) {
            return $dataProvider;
        }
        $query->andFilterWhere(['id' => $this->id]);
        $query->andFilterWhere(['like', 'watermark_src' => $this->watermark_src]);
        return $dataProvider;
    }
}