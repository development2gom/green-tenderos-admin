<?php

namespace app\models;

use Yii;
use Codeception\Lib\Connector\Yii1;
use yii\imagine\Image;

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
            [['fileUpload'], 'file', 'skipOnEmpty' => true, 'on' => 'update'],
            [['id_concurso', 'b_habilitado', 'b_publicado'], 'integer'],
            [['txt_nombre'], 'required'],
            [['txt_nombre'], 'string', 'max' => 50],
            [['txt_url'], 'string', 'max' => 100],
            [['fileUpload'], 'file', 'skipOnEmpty' => false, 'on' => 'create', 'extensions' => 'png, jpg,jpeg'],
            [['id_concurso'], 'exist', 'skipOnError' => true, 'targetClass' => CatConcurso::className(), 'targetAttribute' => ['id_concurso' => 'id_concurso']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_imagen' => 'Imagen',
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
        if ($this->save()) {
            if ($this->subirFoto()) {
                return true;
            }
        }
    }
    public function subirFoto()
    {
        if ($this->fileUpload && $this->fileUpload->saveAs($this->txt_url)) {

            Image::autorotate($this->txt_url);

            return true;
        }

        return false;

    }
    public function getPath()
    {
        if ($this->fileUpload) {
            $path = Yii::$app->params['path_imagenes'] . $this->txt_nombre . '.' . $this->fileUpload->extension;

            $this->txt_url = $path;
        }
    }
}
