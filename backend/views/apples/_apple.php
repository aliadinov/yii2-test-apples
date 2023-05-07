<?php

/** @var View $this */
/* @var $apple Apple */
/* @var $eatAppleForm EatAppleForm */
/* @var $fallAppleForm FallAppleForm */

use backend\models\forms\FallAppleForm;
use common\models\Apple;
use backend\models\forms\EatAppleForm;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

?>

<div class="apples__item" data-id="<?= $apple->id ?>">
    <div class="apples__id"><?= $apple->id ?></div>
    <div class="apples__color"><?= $apple->color ?></div>
    <div class="apples__size"><?= $apple->size ?></div>
    <div class="apples__status"><?= $apple->status ?></div>
    <div class="apples__create-date"><?= $apple->created_at ?></div>
    <div class="apples__full-date"><?= $apple->fell_at ?></div>
    <div class="apples__button">
        <?php $form = ActiveForm::begin([
            'action' => url(['apples/fall-to-ground']),
            'options' => ['class' =>'fall-apple-form w-100 ajax-form']
        ]); ?>
        <?= Html::activeHiddenInput($fallAppleForm, 'appleId', ['value' => $apple->id]) ?>
        <?= Html::submitButton('Упасть', ['class' => 'btn btn-warning btn-block w-100']) ?>
        <?php ActiveForm::end(); ?>
    </div>
    <div class="apples__button">
        <?php $form = ActiveForm::begin([
            'action' => url(['apples/eat-apple']),
            'options' => ['class' =>'eat-apple-form ajax-form']
        ]); ?>
        <?= Html::activeHiddenInput($eatAppleForm, 'appleId', ['value' => $apple->id]) ?>
        <?= $form->field($eatAppleForm, 'size')->textInput() ?>
        <?= Html::submitButton('Откусить', ['class' => 'btn btn-primary btn-block']) ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>


