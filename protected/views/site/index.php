<?php
/* @var $this SiteController */
$this->pageTitle = Yii::t('translate', Yii::app()->name);
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl . '/js/page.js');
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
	<i>"<?php echo CHtml::encode(Yii::t('translate', Yii::app()->name)); ?>"</i>
</h1>
<div class="form">
	<?php $form = $this->beginWidget('CActiveForm', array(
		'id' => 'site-form',
		'enableClientValidation' => true,
		'enableAjaxValidation' => false,
		'clientOptions' => array(
			'validateOnSubmit' => true,
		),
	)); ?>
	<div style="float: right;padding-top: 2em">
		<!--FB -->
		<div class="fb-like" data-href="<?php echo Yii::app()->request->getBaseUrl(true); ?>"
		     data-width="164 " data-layout="button" data-action="like" data-show-faces="true" data-share="true"></div>
		<!--VK -->
		<div id="vk_like" style="float: right;padding-top: 0.5em"></div>
		<div id="twlike" style="float: right;padding-top: 0.5em">
			<a href="https://twitter.com/share" class="twitter-share-button"
			   data-url="<?php echo Yii::app()->request->getBaseUrl(true); ?>" data-via="romakovalenkoua"
			   data-hashtags="numbertowords">Tweet</a>
			<script>!function (d, s, id) {
					var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
					if (!d.getElementById(id)) {
						js = d.createElement(s);
						js.id = id;
						js.src = p + '://platform.twitter.com/widgets.js';
						fjs.parentNode.insertBefore(js, fjs);
					}
				}(document, 'script', 'twitter-wjs');</script>
		</div>
	</div>
	<div class="row">
		<?php //echo $form->labelEx($model, CHtml::encode(Yii::t('translate', 'Number')), array('for' => 'form_input', 'class' => 'form-label')); ?>
		<?php echo CHtml::tag('label', array('class' => 'form-label', 'for' => 'form_input'), Yii::t('translate', 'Number')); ?>
		<?php echo $form->textField($model, 'number', array('id' => 'form_input', 'class' => 'form-input')); ?>
		<?php echo $form->error($model, 'number', array('inputID' => 'form_input')); ?>
	</div>

	<div class="row buttons">
		<!--		--><?php //echo CHtml::submitButton('OK', array('class' => 'form-submit')); ?>
		<?php echo CHtml::ajaxSubmitButton('OK', '', array('update' => '#converted_number'),
			array('class' => 'form-submit')
		); ?>
	</div>
	<?php $this->endWidget(); ?>
</div>
<div class="converted-text" id="converted_number">
	<p>
		<?php if ($model->converted_number) echo ucfirst($model->converted_number); ?>
	</p>
</div>
<div id="seo_footer"></div>
<script type="text/javascript">VK.Widgets.Like("vk_like", {type: "button", height: 24});</script>