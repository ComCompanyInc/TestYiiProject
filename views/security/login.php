<?php
use yii\helpers\Html;

use app\assets\LoginAsset;
LoginAsset::register($this);

use yii\widgets\ActiveForm; // позволяет инициализировать форму
?>

<div class="form-container">
    <h2>Вход в аккаунт</h2>

    <?php $form = ActiveForm::begin(['options' => ['id' => 'login-form']]) ?> <!-- это начало нашей формы (вызываем метод создания формы) -->
        <!-- выводим поля формы из модели формы -->
        <?= $form->field($loginForm, 'login')?>
        <?= $form->field($loginForm, 'password')->passwordInput()?>
        <?= Html::submitButton("Отправить", ['class' => 'btn btn-success']) ?>
    <?php ActiveForm::end() ?> <!-- конец нашей формы -->

    <p style="text-align:center; margin-top:1rem;">
        Нет аккаунта? <?= Html::a("Зарегестрироваться", '/security/register')?>
    </p>
</div>