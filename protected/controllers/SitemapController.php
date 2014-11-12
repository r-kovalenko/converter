<?php

class SitemapController extends Controller
{

	const KEEP_DELAY = 86400;

	public function actionIndex()
	{
//		if (!$xml = Yii::app()->cache->get('sitemap')) {

			$sitemap = new DSitemap();

			$sitemap->addUrl('/', DSitemap::DAILY);

		$languages = Yii::app()->params->languages;

		$host = Yii::app()->request->hostInfo;
		foreach ($languages as $key => $lang) {
			$lang_map[] = array(
				'hreflang' => $key,
				'href' => $host . '/' . $key
			);
		}

		foreach ($languages as $lang_key => $value) {

			$sitemap->addUrlLang('/', $lang_map, $lang_key, DSitemap::DAILY, 1);
			$sitemap->addUrlLang('/site/page/view/about', $lang_map, $lang_key, DSitemap::WEEKLY, 0.5);
			$sitemap->addUrlLang('/contact', $lang_map, $lang_key, DSitemap::NEVER, 0.3);
			}

			$xml = $sitemap->render();
//			Yii::app()->cache->set('sitemap', $xml, self::KEEP_DELAY);
//		}

		header("Content-type: text/xml");
		echo $xml;
		Yii::app()->end();
	}
}