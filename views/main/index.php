<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Alert;

/* @var $this yii\web\View */
/* @var $model app\models\Url */
/* @var $form yii\widgets\ActiveForm */
?>
<div >
	<h1 class="text-center">TinyURL</h1>
	<div class="url-form">

	    <?php $form = ActiveForm::begin([
	    "action"=>"/",
	    "enableClientValidation"=>false
	    ]); ?>

	    <?= $form->field($model, 'url')->textInput()->label("Paste URL you want to make shorter.") ?>
	    <div class="form-group  text-center">
	        <?= Html::submitButton('Make It!' , ['class' => 'btn btn-lg btn-primary']) ?>
	    </div>

	    <?php ActiveForm::end(); ?>
	    
	</div>
	<?php if($result): ?>
		<?= Alert::widget([
			    'options' => [
			        'class' => 'alert-info text-center ',
			    ],
			    'body' => "<a href='$result'>$result</a>",
			])?>
	<?php endif;?>
</div>