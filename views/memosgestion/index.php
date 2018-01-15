<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Departamentos;
use app\models\Recepciones;
use app\models\Trabajador;
use app\models\Estatus3;
use yii\db\Query;
use kartik\widgets\DatePicker;
/* @var $this yii\web\View */
/* @var $searchModel app\models\MemosgestionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Memorandums Localizador';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="memosgestion-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
//            'dirorigen',
            [
            'attribute' => 'dirorigen',
            'value' => 'dirorigennombre.nombre',
            'options' => ['width'=>'10%',],
            'format' => 'text',
            'label' => 'Dir. Origen',
            'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'dirorigen',
                    'data' => ArrayHelper::map(Departamentos::find()->orderBy('id')->all(), 'id', 'nombre'),
                    'options' => 
                        ['placeholder' => '¿Dir. Origen?'],
                    'pluginOptions' => [ 'allowClear' => true ],
            ]),
            ],
            
            [
            'attribute' => 'unidadorigen',
            'value' => 'unidadorigennombre.nombre',
            'options' => ['width'=>'10%',],
            'format' => 'text',
            'label' => 'Unidad Origen',
            'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'unidadorigen',
                    'data' => ArrayHelper::map(Recepciones::find()->orderBy('id')->all(), 'id', 'nombre'),
                    'options' => 
                        ['placeholder' => '¿Unidad Origen?'],
                    'pluginOptions' => [ 'allowClear' => true ],
            ]),
            ],
            [
            'attribute' => 'trabajadororigen',
            'value' => 'trabajadororigennombre.Trabajadorfps',
            'options' => ['width'=>'10%',],
            'format' => 'text',
            'label' => 'Trabajador Origen',
            'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'trabajadororigen',
                    'data' => ArrayHelper::map(Trabajador::find()->asArray()->all(),'id', function($model, $defaultValue) {
                        return $model['dimprofesion'].' '.$model['primernombre'].' '.$model['primerapellido'];}),
                    'options' => 
                        ['placeholder' => '¿Trabajador?'],
                    'pluginOptions' => [ 'allowClear' => true ],
            ]),
            ],
            
            [
            'attribute' => 'dirfinal',
            'value' => 'dirfinalnombre.nombre',
            'options' => ['width'=>'10%',],
            'format' => 'text',
            'label' => 'Dir. Final',
            'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'dirfinal',
                    'data' => ArrayHelper::map(Departamentos::find()->orderBy('id')->all(), 'id', 'nombre'),
                    'options' => 
                        ['placeholder' => '¿Dir Final?'],
                    'pluginOptions' => [ 'allowClear' => true ],
            ]),
            ],
            
            [
            'attribute' => 'unidadfinal',
            'value' => 'unidadfinalnombre.nombre',
            'options' => ['width'=>'10%',],
            'format' => 'text',
            'label' => 'Unidad Final',
            'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'unidadfinal',
                    'data' => ArrayHelper::map(Recepciones::find()->orderBy('id')->all(), 'id', 'nombre'),
                    'options' => 
                        ['placeholder' => '¿Unidad Final?'],
                    'pluginOptions' => [ 'allowClear' => true ],
            ]),
            ],
            [
            'attribute' => 'trabajadorfinal',
            'options' => ['width'=>'10%',],
            'value' => 'trabajadorfinalnombre.Trabajadorfps',
            'format' => 'text',
            'label' => 'Trabajador Final',
            'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'trabajadorfinal',
                    'data' => ArrayHelper::map(Trabajador::find()->asArray()->all(),'id', function($model, $defaultValue) {
                        return $model['dimprofesion'].' '.$model['primernombre'].' '.$model['primerapellido'];}),
                    'options' => 
                        ['placeholder' => '¿Trabajador Final?'],
                    'pluginOptions' => [ 'allowClear' => true ],
            ]),
            ],
            
            //'estatus1origen',
            // 'estatus2origen',
            //'estatus3origen',
            //'dirfinal',
            //'unidadfinal',
            //'trabajadorfinal',
            // 'estatus1final',
            // 'estatus2final',
            //'estatus3final',
            [
            'attribute' => 'estatus3final',
            'value' => 'estatus3finalnombre.nombre',
            'options' => ['width'=>'10%',],
            'format' => 'text',
            'label' => 'Estatus3',
            'options' => ['width'=>'100px',],
            'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'estatus3final',
                    'data' => ArrayHelper::map((new Query())->select(["CONCAT(estatus1.nombre, ' // ', estatus2.nombre, ' // ', estatus3.nombre) as nombre", "estatus3.id as id"])
                    ->from('estatus3')
                    ->join('join', 'estatus2', 'estatus3.estatus2_id = estatus2.id')
                    ->join('join', 'estatus1', 'estatus2.estatus1_id = estatus1.id')
                    ->all(),'id','nombre'),
                    'options' => 
                        ['placeholder' => '¿Estatus?'],
                    'pluginOptions' => [ 'allowClear' => true ],
            ]),
            ],
            
    
            //'fechamemo',
                                
            [
                'attribute' => 'fechamemo',
                'format' => 'text',
                'options' => ['width'=>'10%',],
                'filter' =>DatePicker::widget([
                     'model' => $searchModel,
                     'attribute' => 'fechamemo',
                    'name' => 'datetime_20',
                    'options' => ['placeholder' => 'Fecha'],
                    'type' => DatePicker::TYPE_INPUT,
                    'pluginOptions' => [
                        'orientation' => 'up right',
                        'todayHighlight' => true,
                        'todayBtn' => true,
                        'format' => 'dd/mm/yyyy',
                        'showMeridian' => true,
                        'autoclose' => true,
                        'language' => 'es',
                ]

            ]),
            ],
            // 'asunto',
            // 'created_at',
            // 'created_by',
            // 'updated_at',
            // 'updated_by',

            [
            'class'=>'yii\grid\ActionColumn',
            'template' => '{print} {update}',
            'buttons' => [
                'print' => function($url, $model){
                        return Html::a('<span class="glyphicon glyphicon-print"></span>',
                                    yii\helpers\Url::to(['gestion/memorandum', 'id' => $model->id]),
                                    [
                                        'title' => 'Imprimir',
                                        'target'=>'_blank',
                                    ]
                                );
                },
                'update' => function($url, $model){
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>',
                                    yii\helpers\Url::to(['update', 'id' => $model->id]),
                                    [
                                        'title' => 'Actualizar',
                                    ]
                                );
                }
            ],
            ],
        ],
    ]); ?>
</div>
