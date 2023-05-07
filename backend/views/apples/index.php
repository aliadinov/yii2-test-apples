<?php

/** @var View $this */
/* @var $apples Apple[] */
/* @var $apple Apple */
/* @var $eatAppleForm EatAppleForm */
/* @var $fallAppleForm FallAppleForm */

use backend\models\forms\FallAppleForm;
use common\models\Apple;
use backend\models\forms\EatAppleForm;
use yii\web\View;

?>
<div class="apples__wrapper">
    <div class="container">
        <h1>Яблоки</h1>
        <div class="apples__generate">
            <a id="apples-generate-button" href="<?php url('/apples/regenerate-random-apples')?>" class="btn btn-primary ">Сгенерировать яблоки</a>
        </div>
        <?php if ($apples) { ?>
            <div class="apples__items">
                <?php foreach ($apples as $apple) { ?>
                    <?= $this->render('_apple', [
                        'apple'           => $apple,
                        'eatAppleForm'    => $eatAppleForm,
                        'fallAppleForm'   => $fallAppleForm,
                    ]) ?>
                <?php } ?>
            </div>
        <?php } else { ?>
            <p>Яблоки отсутствуют</p>
        <?php } ?>
    </div>
</div>
