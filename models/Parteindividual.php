<?php
namespace app\models;

use yii\base\Model;

/**
 * Para el ingreso de sigesp desde gestion
 *
 * 
 */
class Sepingreso extends Model
{
    /**
     * @inheritdoc
     */
    public $solicitud_id;
    public $fecha;
    public $sepconcepto_id;
    public $rpcbeneficiario_id;
    public $spgdtunidadadministrativa;
    
    
    public function rules()
    {
        return [
            [['trabajador', 'anho'], 'integer'],
            [['trabajador'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['trabajador' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'trabajador' => 'Trabajador Social',
            'anho' => 'Año',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Users::className(), ['id' => 'trabajador']);
    }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

