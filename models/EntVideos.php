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
    public $fileUpload;
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
            [['fileUpload'], 'file', 'skipOnEmpty' => true, 'on' => 'update'],
            [['id_concurso', 'b_habilitado', 'b_publicado'], 'integer'],
            [['txt_nombre'], 'required'],
            [['txt_nombre', 'txt_url'], 'string', 'max' => 50],
            [['txt_url'], 'string', 'max' => 100],
            [['fileUpload'], 'file', 'skipOnEmpty' => false, 'on' => 'create', 'extensions' => 'mp4,WebM,Ogg,mpeg4'],
            [['id_concurso'], 'exist', 'skipOnError' => true, 'targetClass' => CatConcurso::className(), 'targetAttribute' => ['id_concurso' => 'id_concurso']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_video' => 'Video',
            'id_concurso' => 'Concurso',
            'txt_nombre' => 'Nombre',
            'txt_url' => 'Url',
            'b_habilitado' => 'Habilitado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConcurso()
    {
        return $this->hasOne(CatConcurso::className(), ['id_concurso' => 'id_concurso']);
    }
    public function guardarRegistro()
    {
        $this->getPath();
        if($this->save())
        {
           if($this->subirVideo())
           {
               return true;
           }
        }
        return false;
    }
    public function subirVideo()
    {
       if($this->fileUpload && $this->fileUpload->saveAs($this->txt_url))
       {
        return true;
       }
          
          return false;
         
    }
    public function getPath()
    {
        if($this->fileUpload)
        {
            $path=Yii::$app->params['path_videos'].$this->txt_nombre.'.'.$this->fileUpload->extension;
            $this->txt_url=$path;
        }
    }
}
