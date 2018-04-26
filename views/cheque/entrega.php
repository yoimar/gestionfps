<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Cheque */

$this->title = 'Agregar Cheque';
$this->params['breadcrumbs'][] = ['label' => 'Cheques', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cheque-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formentrega', [
        'modelcheque' => $modelcheque,
        'chequemanual' => $chequemanual,
        'iraentrega' => $iraentrega,
    ]) ?>

</div>
