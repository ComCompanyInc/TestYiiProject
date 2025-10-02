<?php
use yii\widgets\ActiveForm; // позволяет инициализировать форму

use yii\helpers\Html; // для вывода динамических html элементов (в нашем случае для создания кнопки отправки формы)
?>

    <?php $form = ActiveForm::begin() ?> <!-- это начало нашей формы (вызываем метод создания формы) -->
        <!-- выводим поля формы из модели формы -->
        <?= $form->field($registerForm, 'name')?> <!-- label() задает пояснительную надпись полю -->
        <?= $form->field($registerForm, 'surname')?>
        <?= $form->field($registerForm, 'patronymic')?>
        <?= $form->field($registerForm, 'login')?>
        <?= $form->field($registerForm, 'password')->passwordInput()?> <!-- passwordInput() делает тип поля с паролем  -->
        <?= Html::submitButton("Отправить", ['class' => 'btn btn-success']) ?>
    <?php ActiveForm::end() ?> <!-- конец нашей формы -->

<?= $result ?>