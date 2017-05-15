<?php

namespace app\models;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\db\ActiveQuery;

use Yii;

/**
 * This is the model class for table "gestion".
 *
 * @property integer $id
 * @property integer $programaevento_id
 * @property integer $solicitud_id
 * @property integer $convenio_id
 * @property integer $estatus3_id
 * @property boolean $militar_solicitante
 * @property integer $rango_solicitante_id
 * @property boolean $militar_beneficiario
 * @property integer $rango_beneficiario_id
 * @property string $afrodescendiente
 * @property string $indigena
 * @property string $sexodiversidad
 * @property integer $trabajador_id
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 * @property integer $tipodecontacto_id
 *
 * @property Convenio $convenio
 * @property Estatus3 $estatus3
 * @property Programaevento $programaevento
 * @property Rangosmilitares $rangoSolicitante
 * @property Rangosmilitares $rangoBeneficiario
 * @property Solicitudes $solicitud
 * @property Tipodecontacto $tipodecontacto
 * @property Trabajador $trabajador
 */
class Gestion extends \yii\db\ActiveRecord
{
    public $estatus1_id;
    public $estatus2_id;
    public $mes_actividad;
    public $solicitante;
    public $cisolicitante;
    public $beneficiario;
    public $cibeneficiario;
    public $tratamiento;
    public $nino;
    public $trabajadorsocial;
    public $especialidad;
    public $recepcion;
    public $necesidad;
    public $monto;
    public $trabajadoracargoactividad;
    public $mesingreso;
    public $estado_actividad;
    public $tipodeayuda;
    public $estatussasyc;
    public $empresaoinstitucion;
    public $proceso;
    public $cantidad;
    public $descripcion;
    public $diasdeultimamodificacion;
    public $diasdesolicitud;
    public $diasdesdeactividad;
    public $cheque;
    public $fechadelcheque;
    public $anodelasolicitud;
    public $direccion;
    public $fechaactividad;
    public $fechaingreso;
    public $estadodireccion;
    public $fechaultimamodificacion;
    public $edadbeneficiario;
    
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gestion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['programaevento_id', 'solicitud_id', 'convenio_id', 'edadbeneficiario', 'estatus3_id', 'rango_solicitante_id', 'rango_beneficiario_id', 'trabajador_id', 'created_by', 'updated_by', 'tipodecontacto_id', 'cisolicitante', 'cibeneficiario', 'mes_actividad', 'trabajadoracargoactividad', 'estado_actividad', 'especialidad', 'recepcion', 'mesingreso', 'tipodeayuda', 'estatussasyc', 'empresaoinstitucion', 'proceso', 'diasdeultimamodificacion', 'diasdesolicitud', 'diasdesdeactividad', 'cheque', 'estadodireccion'], 'integer'],
            [['militar_solicitante', 'militar_beneficiario', 'nino'], 'boolean'],
            [['solicitante', 'estatus1_id', 'estatus2_id', 'beneficiario', 'necesidad', 'descripcion', 'fechadelcheque', 'anodelasolicitud', 'direccion', 'fechaactividad', 'fechaingreso', 'fechaultimamodificacion', 'tratamiento', 'trabajadorsocial', 'created_at', 'updated_at'], 'safe'],
            [['afrodescendiente', 'indigena', 'sexodiversidad'], 'string', 'max' => 2],
            [['monto', 'cantidad',], 'number'],
            [['convenio_id'], 'exist', 'skipOnError' => true, 'targetClass' => Convenio::className(), 'targetAttribute' => ['convenio_id' => 'id']],
            [['estatus3_id'], 'exist', 'skipOnError' => true, 'targetClass' => Estatus3::className(), 'targetAttribute' => ['estatus3_id' => 'id']],
            [['programaevento_id'], 'exist', 'skipOnError' => true, 'targetClass' => Programaevento::className(), 'targetAttribute' => ['programaevento_id' => 'id']],
            [['rango_solicitante_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rangosmilitares::className(), 'targetAttribute' => ['rango_solicitante_id' => 'id']],
            [['rango_beneficiario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rangosmilitares::className(), 'targetAttribute' => ['rango_beneficiario_id' => 'id']],
            [['solicitud_id'], 'exist', 'skipOnError' => true, 'targetClass' => Solicitudes::className(), 'targetAttribute' => ['solicitud_id' => 'id']],
            [['tipodecontacto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tipodecontacto::className(), 'targetAttribute' => ['tipodecontacto_id' => 'id']],
            [['trabajador_id'], 'exist', 'skipOnError' => true, 'targetClass' => Trabajador::className(), 'targetAttribute' => ['trabajador_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'programaevento_id' => 'Programa, Evento o Act. Presidencial',
            'solicitud_id' => 'N° Solicitud',
            'convenio_id' => 'Convenio',
            'estatus1_id' => 'Estatus Nivel 1',
            'estatus2_id' => 'Estatus Nivel 2',
            'estatus3_id' => 'Estatus Nivel 3',
            'militar_solicitante' => 'Militar Solicitante',
            'rango_solicitante_id' => 'Rango Solicitante',
            'militar_beneficiario' => 'Militar Beneficiario',
            'rango_beneficiario_id' => 'Rango Beneficiario',
            'afrodescendiente' => 'Afrodescendiente',
            'indigena' => 'Indigena',
            'sexodiversidad' => 'Sexodiversidad',
            'trabajador_id' => 'Trabajador a cargo Gestión',
            'created_at' => 'Creado el día',
            'created_by' => 'Creado Por',
            'updated_at' => 'Actualizado el día',
            'updated_by' => 'Actualizado Por',
            'tipodecontacto_id' => 'Tipo de Contacto',
            'mes_actividad' => 'Mes de la Actividad',
            'solicitante' => 'Solicitante',
            'cisolicitante' => 'C.I. Solicitante',
            'beneficiario' => 'Beneficiario',
            'cibeneficiario' => 'C.I. Beneficiario',
            'tratamiento' => 'Tratamiento',
            'nino' => 'Niño',
            'trabajadorsocial' => 'Trabajador Social',
            'especialidad' => 'Especialidad',
            'recepcion' => 'Recepcion',
            'necesidad' => 'Necesidad',
            'monto' => 'Monto del Presupuesto',
            'trabajadoracargoactividad' => 'Trabajador a Cargo de la Actividad',
            'mesingreso' => 'Mes de Ingreso',
            'estado_actividad' => 'Estado de la Actividad',
            'tipodeayuda' => 'Tipo de Ayuda',
            'estatussasyc' => 'Estatus SASYC',
            'empresaoinstitucion' => 'Empresa Institucion o Casa Comercial',
            'proceso' => 'Proceso',
            'cantidad' => 'Cantidad',
            'descripcion' => 'Descripción',
            'diasdeultimamodificacion' => 'Dias desde la Última modificación',
            'diasdesolicitud' => 'Dias desde el Ingreso de la Solicitud',
            'diasdesdeactividad' => 'Dias desde la Actividad',
            'cheque' => 'Numero de Cheque',
            'fechadelcheque' => 'Fecha del Cheque',
            'anodelasolicitud' => 'Año de la Solicitud',
            'direccion' => 'Dirección',
            'fechaactividad' => 'Fecha de la Actividad',
            'fechaingreso' => 'Fecha del ingreso',
            'estadodireccion' => 'Estado del Beneficiario',
            'fechaultimamodificacion' => 'Fecha de la ultima modificación',
        ];
    }
    
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],

        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConvenio()
    {
        return $this->hasOne(Convenio::className(), ['id' => 'convenio_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstatus3()
    {
        return $this->hasOne(Estatus3::className(), ['id' => 'estatus3_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProgramaevento()
    {
        return $this->hasOne(Programaevento::className(), ['id' => 'programaevento_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRangosolicitante()
    {
        return $this->hasOne(Rangosmilitares::className(), ['id' => 'rango_solicitante_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRangobeneficiario()
    {
        return $this->hasOne(Rangosmilitares::className(), ['id' => 'rango_beneficiario_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitud()
    {
        return $this->hasOne(Solicitudes::className(), ['id' => 'solicitud_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipodecontacto()
    {
        return $this->hasOne(Tipodecontacto::className(), ['id' => 'tipodecontacto_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrabajador()
    {
        return $this->hasOne(Trabajador::className(), ['id' => 'trabajador_id']);
    }

}
