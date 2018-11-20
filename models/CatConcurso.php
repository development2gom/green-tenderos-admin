<?php

namespace app\models;

use Yii;
use yii\web\HttpException;

/**
 * This is the model class for table "cat_concurso".
 *
 * @property string $id_concurso
 * @property string $txt_nombre
 * @property string $fch_inicio
 * @property string $fch_fin
 * @property string $b_habilitado
 *
 * @property EntImagenes[] $entImagenes
 * @property EntVideos[] $entVideos
 * @property WrkHistorial[] $wrkHistorials
 * @property WrkPuntuajeActual[] $wrkPuntuajeActuals
 */
class CatConcurso extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cat_concurso';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fch_inicio', 'fch_fin'], 'safe'],
            [['b_habilitado'], 'integer'],
            [['txt_nombre'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_concurso' => 'Id Concurso',
            'txt_nombre' => 'Txt Nombre',
            'fch_inicio' => 'Fch Inicio',
            'fch_fin' => 'Fch Fin',
            'b_habilitado' => 'B Habilitado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntImagenes()
    {
        return $this->hasMany(EntImagenes::className(), ['id_concurso' => 'id_concurso']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntVideos()
    {
        return $this->hasMany(EntVideos::className(), ['id_concurso' => 'id_concurso']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWrkHistorials()
    {
        return $this->hasMany(WrkHistorial::className(), ['id_concurso' => 'id_concurso']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWrkPuntuajeActuals()
    {
        return $this->hasMany(WrkPuntuajeActual::className(), ['id_concurso' => 'id_concurso']);
    }

    public static function getConcursoActual(){

        

        $concursoActual = CatConcurso::find()->where(['between', 'date', "fch_inicio", "fch_fin" ])->one();

        if(!$concursoActual){
            throw new HttpException(404, "No existe concurso actual");
        }
    }
}
