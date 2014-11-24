<?php
$cs = Yii::app()->getClientScript();
if (!empty($this->seo_description)) {
	$cs->registerMetaTag(CHtml::encode($this->seo_description), 'description');
} else {
}
if (!empty($this->seo_keywords)) {
	$cs->registerMetaTag(CHtml::encode($this->seo_keywords), 'keywords');
} else {
}