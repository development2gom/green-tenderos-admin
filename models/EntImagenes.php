<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ent_imagenes".
 *
 * @property string $id_imagen
 * @property string $id_concurso
 * @property string $txt_nombre
 * @property string $txt_url
 * @property string $b_habilitado
 *
 * @property CatConcurso $concurso
 */
class EntImagenes extends \yii\db\ActiveRecord
{
    public $fileUpload;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ent_imagenes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_concurso', 'b_habilitado'], 'integer'],
            [['txt_nombre'], 'required'],
            [['txt_nombre'], 'string', 'max' => 50],
            [['txt_url'], 'string', 'max' => 100],
            [['fileUpload'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg,jpeg'],
            [['id_concurso'], 'exist', 'skipOnError' => true, 'targetClass' => CatConcurso::className(), 'targetAttribute' => ['id_concurso' => 'id_concurso']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_imagen' => 'Id Imagen',
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
    public function subirFoto()
    {
       
        if($this->validate())
        {
            $this->fileUpload->saveAs('imagenes-ganadores/'.$this->fileUpload->basename.'.'.$this->fileUpload->extension);
            return true;
        }
        else{
            return false;
        }
    }
}
