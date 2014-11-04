<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name . ' - ' . Yii::t('translate', 'About');

/* Подключаем css для календарика */
Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl . '/css/calendar.css');


$this->breadcrumbs = array(
	Yii::t('translate', 'About'),
);
?>
<h1><?php echo Yii::t('translate', 'About'); ?></h1>

<!-- the icon as a time element -->
<?php
$date_formatter = Yii::app()->getDateFormatter();
$current_time = time();
?>
<time datetime="<?php echo $date_formatter->format('yyyy-MM-dd', $current_time); ?>" class="icon">
	<em><?php echo $date_formatter->format('EEEE', $current_time); ?></em>
	<strong><?php echo $date_formatter->format('MMMM', $current_time); ?></strong>
	<span><?php echo $date_formatter->format('d', $current_time); ?></span>
</time>
<div>
	<?php echo Yii::t('translate', 'Just calendar now...'); ?>
</div>