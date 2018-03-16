<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Lugar */

$this->title = 'Actualizar Lugar: '.$model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Lugares', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nombre, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="lugar-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
