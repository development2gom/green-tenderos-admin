<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cat_bodegas".
 *
 * @property string $txt_clave_bodega
 * @property string $txt_nombre
 * @property string $b_habilitado
 *
 * @property CatTiendas[] $catTiendas
 * @property WrkHistorial[] $wrkHistorials
 * @property WrkPuntuajeActual[] $wrkPuntuajeActuals
 */
class CatBodegas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cat_bodegas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['txt_clave_bodega'], 'required'],
            [['b_habilitado'], 'integer'],
            [['txt_clave_bodega', 'txt_nombre'], 'string', 'max' => 50],
            [['txt_clave_bodega'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'txt_clave_bodega' => 'Txt Clave Bodega',
            'txt_nombre' => 'Txt Nombre',
            'b_habilitado' => 'B Habilitado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCatTiendas()
    {
        return $this->hasMany(CatTiendas::className(), ['txt_clave_bodega' => 'txt_clave_bodega']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWrkHistorials()
    {
        return $this->hasMany(WrkHistorial::className(), ['txt_clave_bodega' => 'txt_clave_bodega']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWrkPuntuajeActuals()
    {
        return $this->hasMany(WrkPuntuajeActual::className(), ['txt_clave_bodega' => 'txt_clave_bodega']);
    }
}
