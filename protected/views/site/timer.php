<?php
/* @var $this SiteController */

$this->pageTitle = Yii::t('translate', 'Timer');
$base_url = Yii::app()->request->getBaseUrl();
$cs = Yii::app()->getClientScript();
$cs->registerCssFile($base_url . '/css/timer.css');
$cs->registerScriptFile($base_url . '/js/timer.js');
$cs->registerScriptFile(Yii::app()->request->baseUrl . '/js/page.js');
$cs->registerMetaTag('index,follow', 'robots');
?>
<?php include_once("seo.php") ?>
<div id="text-description-page" class="seo-description">
	<?php if (!empty($this->seo_footer)) { ?>
		<div id="short_text" class="seo-description-content box-hide">
			<h2><?php echo Yii::t('translate', 'Timer') ?></h2>

			<p>
				<?php echo $this->seo_footer; ?>
			</p>
		</div>
	<?php } ?>
</div>
<!--<h1>Welcome to <i>--><?php //echo CHtml::encode(Yii::app()->name); ?><!--</i></h1>-->
<div class="timer_container">
	<!-- time to add the controls -->
	<div class="timer" id="timer">
		<div id="hours">00</div>
		<div class="twodot">:</div>
		<div id="minutes">00</div>
		<div class="twodot">:</div>
		<div id="seconds">00</div>
		<div id="miliseconds_twodot" class="twodot" style="display:none">:</div>
		<div id="miliseconds" style="display:none">000</div>
	</div>
	<!-- Lables for the controls -->
	<div class="timer_controls">
		<button id="start" type="button" onclick="start();"><?php echo Yii::t('translate', 'Start'); ?></button>
		<button id="stop" type="button" onclick="stop();"><?php echo Yii::t('translate', 'Stop'); ?></button>
		<button id="reset" type="button" onclick="reset();"><?php echo Yii::t('translate', 'Reset'); ?></button>
	</div>
</div>
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
<div class="checkbox-label">
	<div>
		<input type="checkbox" id="checkbox-label" onclick="checkbox();"/><label for="checkbox-label"></label>
	</div>
	<div>
		<span onclick="change_checkbox();"><?php echo Yii::t('translate', 'Milliseconds'); ?></span>
	</div>
</div>
<div id="seo_footer"></div>
<script>
	init();
	VK.Widgets.Like("vk_like", {type: "button", height: 24});
</script>