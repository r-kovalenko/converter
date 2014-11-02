<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle = Yii::app()->name . ' - ' . Yii::t('translate', 'Contact Us');
$this->breadcrumbs = array(
	Yii::t('translate', 'Contact'),
);
?>

	<h1><?php echo Yii::t('translate', 'Contact Us'); ?></h1>

<?php if (Yii::app()->user->hasFlash('contact')): ?>

	<div class="flash-success">
		<?php echo Yii::app()->user->getFlash('contact'); ?>
	</div>

<?php else: ?>

	<p>
		<?php echo Yii::t('translate', 'If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.'); ?>
	</p>

	<div class="form">

		<?php $form = $this->beginWidget('CActiveForm', array(
			'id' => 'contact-form',
			'enableClientValidation' => true,
			'clientOptions' => array(
				'validateOnSubmit' => true,
			),
		)); ?>

		<p class="note"><?php echo Yii::t('translate', 'Fields with'); ?> <span
				class="required">*</span> <?php echo Yii::t('translate', 'are required'); ?>.</p>

		<?php echo $form->errorSummary($model); ?>

		<div class="row">
			<?php echo $form->labelEx($model, 'name', array('label' => Yii::t('translate', 'Name'), 'class' => 'form-label')); ?>
			<?php echo $form->textField($model, 'name', array('class' => 'form-input')); ?>
			<?php echo $form->error($model, 'name'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model, 'email', array('class' => 'form-label')); ?>
			<?php echo $form->textField($model, 'email', array('class' => 'form-input')); ?>
			<?php echo $form->error($model, 'email'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model, 'subject', array('label' => Yii::t('translate', 'Subject'), 'class' => 'form-label')); ?>
			<?php echo $form->textField($model, 'subject', array('size' => 60, 'maxlength' => 128, 'class' => 'form-input')); ?>
			<?php echo $form->error($model, 'subject'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model, 'body', array('label' => Yii::t('translate', 'Body'), 'class' => 'form-label')); ?>
			<?php echo $form->textArea($model, 'body', array('rows' => 6, 'cols' => 50)); ?>
			<?php echo $form->error($model, 'body'); ?>
		</div>

		<?php if (CCaptcha::checkRequirements()): ?>
			<div class="row">
				<?php echo $form->labelEx($model, 'verifyCode'); ?>
				<div>
					<?php $this->widget('CCaptcha'); ?>
					<?php echo $form->textField($model, 'verifyCode'); ?>
				</div>
				<div
					class="hint"><?php echo Yii::t('translate', 'Please enter the letters as they are shown in the image above'); ?>
					.
					<br/><?php echo Yii::t('translate', 'Letters are not case-sensitive'); ?>.
				</div>
				<?php echo $form->error($model, 'verifyCode'); ?>
			</div>
		<?php endif; ?>

		<div class="row buttons">
			<?php echo CHtml::submitButton('Submit', array('value' => Yii::t('translate', 'Submit'), 'class' => 'form-submit')); ?>
		</div>

		<?php $this->endWidget(); ?>

	</div><!-- form -->

<?php endif; ?>