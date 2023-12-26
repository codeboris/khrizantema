<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \shop\forms\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Контакты - ' . Yii::$app->name;
$this->params['breadcrumbs'][] = 'Контакты';
?>
<div class="site-contact">

    <p>
        Если у вас есть деловые вопросы или другие вопросы, пожалуйста, заполните следующую форму, чтобы связаться с нами. Спасибо.
    </p>

    <div class="row">
        <div class="col-md-5 col-xs-12">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'subject') ?>

                <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

                <?= $form->field($model, 'verifyCode')->widget(Captcha::class, [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
        <!--<div class="col-md-5 col-xs-12">
            <div class="phone_social">
                <div class="phone_viber">
                    <a title="Viber" href="viber://add?number=79240217070">
                        <img src="<?/*= Yii::getAlias('@web/image/viber.png') */?>">
                    </a>
                </div>
                <div class="phone_whatsapp">
                    <a title="WhatsApp" href="whatsapp://send?phone=+79240217070">
                        <img src="<?/*= Yii::getAlias('@web/image/whatsapp.png') */?>">
                    </a>
                </div>
                <div class="phone_telegram">
                    <a title="WhatsApp" href="#">
                        <img src="<?/*= Yii::getAlias('@web/image/telegram.png') */?>">
                    </a>
                </div>
            </div>
            <div class="phone_block"><span class="phone_num"><a title="Позвонить" href="tel:+79240217070">+7(924) 021-70-70</a></span></div>
        </div>-->
    </div>

</div>
