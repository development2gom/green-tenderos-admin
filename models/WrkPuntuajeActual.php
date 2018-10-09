<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wrk_puntuaje_actual".
 *
 * @property string $id_puntuaje
 * @property string $txt_clave_bodega
 * @property string $txt_clave_tienda
 * @property string $id_nivel
 * @property string $id_concurso
 * @property string $num_puntuaje_actual
 * @property string $num_saldo_anterior
 * @property string $num_saldo_mes
 * @property string $num_saldo_acumulado
 * @property string $b_habilitado
 *
 * @property CatBodegas $txtClaveBodega
 * @property CatConcurso $concurso
 * @property CatNiveles $nivel
 * @property CatTiendas $txtClaveTienda
 */
class WrkPuntuajeActual extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wrk_puntuaje_actual';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['txt_clave_bodega', 'txt_clave_tienda'], 'required'],
            [['id_nivel', 'id_concurso', 'num_puntuaje_actual', 'num_saldo_anterior', 'num_saldo_mes', 'num_saldo_acumulado', 'b_habilitado'], 'integer'],
            [['txt_clave_bodega', 'txt_clave_tienda'], 'string', 'max' => 50],
            [['txt_leyenda'], 'string', 'max' => 200],
            [['txt_clave_bodega'], 'exist', 'skipOnError' => true, 'targetClass' => CatBodegas::className(), 'targetAttribute' => ['txt_clave_bodega' => 'txt_clave_bodega']],
            [['id_concurso'], 'exist', 'skipOnError' => true, 'targetClass' => CatConcurso::className(), 'targetAttribute' => ['id_concurso' => 'id_concurso']],
            [['id_nivel'], 'exist', 'skipOnError' => true, 'targetClass' => CatNiveles::className(), 'targetAttribute' => ['id_nivel' => 'id_nivel']],
            [['txt_clave_tienda'], 'exist', 'skipOnError' => true, 'targetClass' => CatTiendas::className(), 'targetAttribute' => ['txt_clave_tienda' => 'txt_clave_tienda']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_puntuaje' => 'Id Puntuaje',
            'txt_clave_bodega' => 'Txt Clave Bodega',
            'txt_clave_tienda' => 'Txt Clave Tienda',
            'id_nivel' => 'Id Nivel',
            'id_concurso' => 'Id Concurso',
            'num_puntuaje_actual' => 'Num Puntuaje Actual',
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
    public function getNivel()
    {
        return $this->hasOne(CatNiveles::className(), ['id_nivel' => 'id_nivel']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTxtClaveTienda()
    {
        return $this->hasOne(CatTiendas::className(), ['txt_clave_tienda' => 'txt_clave_tienda']);
    }
}
