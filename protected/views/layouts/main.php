<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html lang="<?php echo Yii::app()->language; ?>">
<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="language" content="<?php echo Yii::app()->language; ?>"/>

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css"
	      media="screen, projection"/>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css"
	      media="print"/>
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css"
	      media="screen, projection"/>
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css"/>
	<?php
	$cs = Yii::app()->getClientScript();
	$cs->registerCssFile(Yii::app()->request->baseUrl . '/css/page.css')
	?>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<?php
	if (!empty($this->seo_description)) {
		$cs->registerMetaTag(CHtml::encode($this->seo_description), 'description');
	} else {

	}
	if (!empty($this->seo_keywords)) {
		$cs->registerMetaTag(CHtml::encode($this->seo_keywords), 'keywords');
	} else {

	}
	$cs->registerMetaTag('index,follow', 'robots');
	?>
	<link rel="shortcut icon" type="image/x-icon"
	      href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.ico"/>
	<link rel="icon" type="image/x-icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.ico">
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php
			echo CHtml::tag('img', array('src' => Yii::app()->request->baseUrl . '/images/logo.png', 'width' => 20, 'height' => 20, 'class' => 'logo-img')),
			CHtml::encode(Yii::t('translate', 'Number to string')); ?></div>
	</div>
	<!-- header -->
	<div id="language-selector" style="float:right; margin:5px;">
		<?php
		$this->widget('application.components.widgets.LanguageSelector');
		?>
	</div>
	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu', array(
			'items' => array(
				array('label' => Yii::t('zii', 'Home'), 'url' => array('/site/index')),
				array('label' => Yii::t('translate', 'About'), 'url' => array('/site/page', 'view' => 'about')),
				array('label' => Yii::t('translate', 'Contact'), 'url' => array('/site/contact')),
			),
		)); ?>
	</div>
	<!-- mainmenu -->
	<?php if (isset($this->breadcrumbs)): ?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links' => $this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif ?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?>.<br/>
		All Rights Reserved.<br/>
	</div>
	<!-- footer -->

</div>
<!-- page -->

</body>
</html>
