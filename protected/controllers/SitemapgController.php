<?php

class SitemapgController extends Controller
{

	const KEEP_DELAY = 86400;

	public function actionIndex()
	{
		if (!$xml = Yii::app()->cache->get('sitemap_google')) {

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
				$sitemap->addUrlLang('/site/timer/', $lang_map, $lang_key, DSitemap::DAILY, 1);
				$sitemap->addUrlLang('/site/page/view/about/', $lang_map, $lang_key, DSitemap::WEEKLY, 0.5);
				$sitemap->addUrlLang('/contact/', $lang_map, $lang_key, DSitemap::NEVER, 0.3);
			}

			$xml = $sitemap->render();
			Yii::app()->cache->set('sitemap_google', $xml, self::KEEP_DELAY);
		}

		header("Content-type: text/xml");
		echo $xml;
		Yii::app()->end();
	}
}