<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use callmez\wechat\models\MessageHistory;

/* @var $this yii\web\View */
/* @var $model callmez\wechat\models\MessageHistory */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Message Histories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="message-history-view">

    <div class="page-header">
        <h3><?= Html::encode($this->title) ?></h3>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'wid',
            'rid',
            'kid',
            'open_id',
            'module',
//            [
//                'attribute' => 'message',
//                'value' => function($model) {
//                    return json_encode($model->message);
//                }
//            ],
//            [
//                'attribute' => 'type',
//                'value' => function($model) {
//                    return MessageHistory::$types[$model->type];
//                },
//            ],
            'created_at:datetime',
        ],
    ]) ?>

</div>
