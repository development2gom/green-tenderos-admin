<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wrk_historial".
 *
 * @property string $id_historial
 * @property string $id_concurso
 * @property string $txt_clave_bodega
 * @property string $txt_clave_tienda
 * @property string $fch_registro
 * @property string $fch_compra
 * @property string $num_saldo_anterior
 * @property string $num_saldo_mes
 * @property string $num_saldo_acumulado
 * @property string $b_habilitado
 *
 * @property CatBodegas $txtClaveBodega
 * @property CatConcurso $concurso
 * @property CatTiendas $txtClaveTienda
 */
class WrkHistorial extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wrk_historial';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['num_saldo_anterior', 'num_saldo_mes', 'b_habilitado'], 'number'],
            [['id_concurso','b_habilitado'], 'integer'],
            [['txt_clave_bodega', 'txt_clave_tienda'], 'required'],
            [['fch_registro', 'fch_compra'], 'safe'],
            [['txt_clave_bodega', 'txt_clave_tienda'], 'string', 'max' => 50],
            [['txt_clave_bodega'], 'exist', 'skipOnError' => true, 'targetClass' => CatBodegas::className(), 'targetAttribute' => ['txt_clave_bodega' => 'txt_clave_bodega']],
            [['id_concurso'], 'exist', 'skipOnError' => true, 'targetClass' => CatConcurso::className(), 'targetAttribute' => ['id_concurso' => 'id_concurso']],
            [['txt_clave_tienda'], 'exist', 'skipOnError' => true, 'targetClass' => CatTiendas::className(), 'targetAttribute' => ['txt_clave_tienda' => 'txt_clave_tienda']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_historial' => 'Id Historial',
            'id_concurso' => 'Id Concurso',
            'txt_clave_bodega' => 'Txt Clave Bodega',
            'txt_clave_tienda' => 'Txt Clave Tienda',
            'fch_registro' => 'Fch Registro',
            'fch_compra' => 'Fch Compra',
            'num_saldo_anterior' => 'Num Saldo Anterior',
            'num_saldo_mes' => 'Num Saldo Mes',
            'num_saldo_acumulado' => 'Num Saldo Acumulado',
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
    public function getConcurso()
    {
        return $this->hasOne(CatConcurso::className(), ['id_concurso' => 'id_concurso']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTxtClaveTienda()
    {
        return $this->hasOne(CatTiendas::className(), ['txt_clave_tienda' => 'txt_clave_tienda']);
    }
}
