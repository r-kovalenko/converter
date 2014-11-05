<?php
/* @var $this SiteController */

$this->pageTitle = Yii::t('translate', Yii::app()->name);
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl . '/js/page.js')
?>
<div id="text-description-page" class="seo-description">
	<?php if (!empty($this->seo_footer)) { ?>
		<div id="short_text" class="seo-description-content box-hide">
			<h2><?php echo Yii::t('translate', Yii::app()->name) ?></h2>

			<p>
				<?php echo $this->seo_footer; ?>
			</p>
		</div>
	<?php } ?>
</div>
<h1><?php echo Yii::t('translate', 'Welcome to'); ?>
	<i><?php echo CHtml::encode(Yii::t('translate', Yii::app()->name)); ?></i>
</h1>
<div class="form">
	<?php $form = $this->beginWidget('CActiveForm', array(
		'id' => 'site-form',
		'enableClientValidation' => true,
		'enableAjaxValidation' => true,
		'clientOptions' => array(
			'validateOnSubmit' => true,
		),
	)); ?>
	<div class="row">
		<?php echo $form->labelEx($model, CHtml::encode(Yii::t('translate', 'Number')), array('for' => 'form_input', 'class' => 'form-label')); ?>
		<?php echo $form->textField($model, 'number', array('id' => 'form_input', 'class' => 'form-input')); ?>
		<?php echo $form->error($model, 'number', array('inputID' => 'form_input')); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton('OK', array('class' => 'form-submit')); ?>
	</div>
	<?php $this->endWidget(); ?>
</div>
<div class="converted-text">
	<p>
		<?php if ($model->converted_number) echo ucfirst($model->converted_number); ?>
	</p>
</div>
<div id="seo_footer"></div>