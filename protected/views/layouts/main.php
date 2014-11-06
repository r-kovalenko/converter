<?php /* @var $this Controller */
$base_url = Yii::app()->request->getBaseUrl();
$base_absolute_url = Yii::app()->request->getBaseUrl(true);
$language = Yii::app()->getLanguage();
?>
<!DOCTYPE html>
<html lang="<?php echo Yii::app()->getLanguage(); ?>">
<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="language" content="<?php echo $language; ?>"/>

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>/css/screen.css"
	      media="screen, projection"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>/css/print.css"
	      media="print"/>
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>/css/ie.css"
	      media="screen, projection"/>
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>/css/main.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>/css/form.css"/>
	<?php
	$cs = Yii::app()->getClientScript();
	$cs->registerCssFile($base_url . '/css/page.css')
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
	$cs->registerMetaTag(CHtml::encode($this->vk_id), null, null, array('property' => 'vk:app_id'));
	?>
	<!-- VK -->
	<script type="text/javascript" src="//vk.com/js/api/openapi.js?115"></script>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo $base_url; ?>/images/favicon.ico"/>
	<link rel="icon" type="image/x-icon" href="<?php echo $base_url; ?>/images/favicon.ico">
	<link rel="alternate" hreflang="x-default" href="<?php echo $base_absolute_url; ?>/">
	<link rel="alternate" hreflang="en-us" href="<?php echo $base_absolute_url; ?>/en/">
	<link rel="alternate" hreflang="ru-ru" href="<?php echo $base_absolute_url; ?>/ru/">
	<link rel="alternate" hreflang="uk-ua" href="<?php echo $base_absolute_url; ?>/uk/">
</head>

<body>

<div class="container" id="page">
	<div id="fb-root"></div>
	<?php
	switch ($language) {
		case 'ru':
			$fb_locale = 'ru_RU';
			break;
		case 'en':
			$fb_locale = 'en_US';
			break;
		case 'uk':
			$fb_locale = 'uk_UA';
			break;
		default:
			$fb_locale = 'en_US';
	}
	?>
	<script>
		(function (d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s);
			js.id = id;
			js.src = "//connect.facebook.net/<?php echo $fb_locale; ?>/sdk.js#xfbml=1&appId=<?php echo $this->fb_id; ?>&version=v2.0";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>
	<div id="header">
		<div id="logo"><?php
			echo CHtml::tag('img', array('src' => $base_url . '/images/logo.png', 'width' => 20, 'height' => 20, 'class' => 'logo-img')),
			CHtml::encode(Yii::t('translate', 'Number to string')); ?>
		</div>
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
		<?php if ($language == 'uk') { ?>
			<div>
				<noindex>
					<a rel="nofollow" href="http://www.ukraine.com.ua/?page=180746" title="Хостинг Україна"
					   target="_blank">
						<img src="http://www.ukraine.com.ua/design/ukraine/img/ukraine_1.gif" title="Хостинг Украина"
						     border="0" alt="Hosting Ukraine"/>
					</a>
				</noindex>
			</div>
		<?php } ?>
		<div style="display: inline-block">
			Copyright &copy; <?php echo date('Y'); ?>.<br/>
			<?php echo Yii::t('translate', 'All Rights Reserved'); ?>.<br/>
		</div>
	</div>
	<!-- footer -->

</div>
<!-- page -->

</body>
</html>
