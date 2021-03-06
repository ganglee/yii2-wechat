<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use callmez\wechat\models\CustomMessage;
use callmez\wechat\widgets\MessageList;

$this->title = '发送客服消息';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="panel panel-default">
    <div class="panel-heading">和<code><?= $fans->open_id ?></code>的聊天记录</div>
    <div class="panel-body">
        <?= MessageList::widget([
            'dataProvider' => $dataProvider
        ]) ?>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">和<code><?= $fans->open_id ?></code>的聊天</div>
    <div class="panel-body">
        <?php $form = ActiveForm::begin([
            'layout' => 'horizontal',
        ]); ?>

        <?= $form->field($model, 'msgType')->inline()->radioList(CustomMessage::$messageTypes) ?>

        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'mediaId')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'thumbMediaId')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'mediaId')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'musicUrl')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'hqMusicUrl')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'content')->textarea() ?>

        <?= $form->field($model, 'description')->textarea() ?>

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <?= Html::submitButton('发送', ['class' => 'btn btn-block btn-primary']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
