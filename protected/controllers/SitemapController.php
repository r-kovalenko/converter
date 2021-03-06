<?php

class SitemapController extends Controller
{

	const KEEP_DELAY = 86400;

	public function actionIndex()
	{
		if (!$xml = Yii::app()->cache->get('sitemap')) {

			$sitemap = new DSitemap();

			$sitemap->addUrl('/', DSitemap::DAILY);

			foreach (Yii::app()->params->languages as $lang_key => $value) {
				$sitemap->addUrl('/' . $lang_key . '/', DSitemap::DAILY, 1);
				$sitemap->addUrl('/' . $lang_key . '/site/timer/', DSitemap::DAILY, 1);
				$sitemap->addUrl('/' . $lang_key . '/site/page/view/about/', DSitemap::WEEKLY, 0.5);
				$sitemap->addUrl('/' . $lang_key . '/contact/', DSitemap::NEVER, 0.3);
			}

			$xml = $sitemap->render();
			Yii::app()->cache->set('sitemap', $xml, self::KEEP_DELAY);
		}

		header("Content-type: text/xml");
		echo $xml;
		Yii::app()->end();
	}
}