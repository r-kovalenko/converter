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
	$cs->registerCssFile($base_url . '/css/page.css');
	$cs->registerMetaTag(CHtml::encode(Yii::app()->params->vk_id), null, null, array('property' => 'vk:app_id'));
	//	for Facebook
	$cs->registerMetaTag(CHtml::encode($this->pageTitle), null, null, array('property' => 'og:title'));
	$cs->registerMetaTag(CHtml::encode($base_absolute_url . '/images/large-logo.png'), null, null, array('property' => 'og:image'));
	$cs->registerMetaTag(CHtml::encode($base_absolute_url), null, null, array('property' => 'og:url'));
	if (!empty($this->seo_description)) {
		$cs->registerMetaTag(CHtml::encode($this->seo_description), null, null, array('property' => 'og:description'));
	}
	?>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

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
<?php include_once("analyticstracking.php"); ?>
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
			js.src = "//connect.facebook.net/<?php echo $fb_locale; ?>/sdk.js#xfbml=1&appId=<?php echo Yii::app()->params->fb_id; ?>&version=v2.0";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>
	<div id="header" itemscope itemtype="http://schema.org/SoftwareApplication">
		<div id="logo" itemprop="name"><?php
			echo CHtml::tag('img', array('src' => $base_url . '/images/logo.png', 'width' => 20, 'height' => 20, 'class' => 'logo-img', 'itemprop' => 'image')),
			$this->head_title; ?>
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
				array('label' => Yii::t('translate', 'Stopwatch'), 'url' => array('/site/timer')),
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
	<?php if ($language == 'ru') { ?>
		<div style="text-align:center">
			<a href="http://recreativ.ru/?r=24038" target="_blank">
				<img src="http://recreativ.ru/images/banners/baner2.gif" border=0 width=468 height=60>
			</a>
		</div>
	<?php } ?>
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
		<!--LiveInternet counter-->
		<script type="text/javascript"><!--
			document.write("<a href='//www.liveinternet.ru/click' " +
			"target=_blank><img src='//counter.yadro.ru/hit?t42.10;r" +
			escape(document.referrer) + ((typeof(screen) == "undefined") ? "" :
			";s" + screen.width + "*" + screen.height + "*" + (screen.colorDepth ?
				screen.colorDepth : screen.pixelDepth)) + ";u" + escape(document.URL) +
			";h" + escape(document.title.substring(0, 80)) + ";" + Math.random() +
			"' alt='' title='LiveInternet' " +
			"border='0' width='31' height='31'><\/a>")
			//--></script>
		<!--/LiveInternet-->
	</div>
	<!-- footer -->

</div>
<!-- page -->
<?php include_once('yandexmetrika.php'); ?>
<?php include_once('mailru.php'); ?>
</body>
</html>
