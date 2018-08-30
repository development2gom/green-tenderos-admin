<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cat_tiendas".
 *
 * @property string $txt_clave_tienda
 * @property string $txt_clave_bodega
 * @property string $txt_nombre
 * @property string $b_habilitado
 *
 * @property CatBodegas $txtClaveBodega
 * @property WrkHistorial[] $wrkHistorials
 * @property WrkPuntuajeActual[] $wrkPuntuajeActuals
 */
class CatTiendas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cat_tiendas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['txt_clave_tienda', 'txt_clave_bodega'], 'required'],
            [['b_habilitado'], 'integer'],
            [['txt_clave_tienda', 'txt_clave_bodega', 'txt_nombre'], 'string', 'max' => 50],
            [['txt_clave_tienda'], 'unique'],
            [['txt_clave_bodega'], 'exist', 'skipOnError' => true, 'targetClass' => CatBodegas::className(), 'targetAttribute' => ['txt_clave_bodega' => 'txt_clave_bodega']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'txt_clave_tienda' => 'Txt Clave Tienda',
            'txt_clave_bodega' => 'Txt Clave Bodega',
            'txt_nombre' => 'Txt Nombre',
            'b_habilitado' => 'B Habilitado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTxtClaveBodega()
    {
        return $this->hasOne(CatBodegas::className(), ['txt_clave_bodega' => 'txt_clave_bodega']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWrkHistorials()
    {
        return $this->hasMany(WrkHistorial::className(), ['txt_clave_tienda' => 'txt_clave_tienda']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWrkPuntuajeActuals()
    {
        return $this->hasMany(WrkPuntuajeActual::className(), ['txt_clave_tienda' => 'txt_clave_tienda']);
    }
}
