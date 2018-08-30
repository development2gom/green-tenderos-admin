<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ent_videos".
 *
 * @property string $id_video
 * @property string $id_concurso
 * @property string $txt_nombre
 * @property string $txt_url
 * @property string $b_habilitado
 *
 * @property CatConcurso $concurso
 */
class EntVideos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ent_videos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_concurso', 'b_habilitado'], 'integer'],
            [['txt_nombre', 'txt_url'], 'required'],
            [['txt_nombre', 'txt_url'], 'string', 'max' => 50],
            [['id_concurso'], 'exist', 'skipOnError' => true, 'targetClass' => CatConcurso::className(), 'targetAttribute' => ['id_concurso' => 'id_concurso']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_video' => 'Id Video',
            'id_concurso' => 'Id Concurso',
            'txt_nombre' => 'Txt Nombre',
            'txt_url' => 'Txt Url',
            'b_habilitado' => 'B Habilitado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConcurso()
    {
        return $this->hasOne(CatConcurso::className(), ['id_concurso' => 'id_concurso']);
    }
}
