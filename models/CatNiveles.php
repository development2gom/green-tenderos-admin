<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cat_niveles".
 *
 * @property string $id_nivel
 * @property string $txt_nombre
 * @property string $num_rango_inicial
 * @property string $num_rango_final
 * @property string $num_orden
 * @property string $b_habilitado
 *
 * @property WrkPuntuajeActual[] $wrkPuntuajeActuals
 */
class CatNiveles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cat_niveles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['num_rango_inicial', 'num_rango_final', 'num_orden'], 'required'],
            [['num_rango_inicial', 'num_rango_final', 'num_orden', 'b_habilitado'], 'integer'],
            [['txt_nombre'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_nivel' => 'Id Nivel',
            'txt_nombre' => 'Txt Nombre',
            'num_rango_inicial' => 'Num Rango Inicial',
            'num_rango_final' => 'Num Rango Final',
            'num_orden' => 'Num Orden',
            'b_habilitado' => 'B Habilitado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWrkPuntuajeActuals()
    {
        return $this->hasMany(WrkPuntuajeActual::className(), ['id_nivel' => 'id_nivel']);
    }
}
