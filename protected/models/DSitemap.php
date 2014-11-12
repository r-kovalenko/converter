<?php

/**
 * @author ElisDN <mail@elisdn.ru>
 * @link http://www.elisdn.ru
 */
class DSitemap
{
	const ALWAYS = 'always';
	const HOURLY = 'hourly';
	const DAILY = 'daily';
	const WEEKLY = 'weekly';
	const MONTHLY = 'monthly';
	const YEARLY = 'yearly';
	const NEVER = 'never';

	protected $items = array();

	protected function _getUrlItem($url, $changeFreq = self::DAILY, $priority = 0.5, $lastMod = 0, $lang_key = '')
	{
		$host = Yii::app()->request->hostInfo;
		if ($lang_key) {
			$lang_key = '/' . $lang_key;
		}
		$item = array(
			'loc' => $host . $lang_key . $url,
			'changefreq' => $changeFreq,
			'priority' => $priority
		);
		if ($lastMod) {
			$item['lastmod'] = $this->dateToW3C($lastMod);
		}
		return $item;
	}

	/**
	 * @param $url
	 * @param string $changeFreq
	 * @param float $priority
	 * @param int $lastMod
	 */
	public function addUrl($url, $changeFreq = self::DAILY, $priority = 0.5, $lastMod = 0)
	{
		$this->items[] = $this->_getUrlItem($url, $changeFreq, $priority, $lastMod);
	}

	public function addUrlLang($url, array $lang_map = array(), $lang_key = 'en', $changeFreq = self::DAILY, $priority = 0.5, $lastMod = 0)
	{

		$url_item = $this->_getUrlItem($url, $changeFreq, $priority, $lastMod, $lang_key);

		foreach ($lang_map as $lang_item) {
			$url_item[] = array(
				'id' => 'xhtml:link',
				'rel' => 'alternate',
				'hreflang' => $lang_item['hreflang'],
				'href' => $lang_item['href'] . $url
			);
		}
		$this->items[] = $url_item;
	}
	/**
	 * @param CActiveRecord[] $models
	 * @param string $changeFreq
	 * @param float $priority
	 */
	public function addModels($models, $changeFreq = self::DAILY, $priority = 0.5)
	{
		$host = Yii::app()->request->hostInfo;
		foreach ($models as $model) {
			$item = array(
				'loc' => $host . $model->getUrl(),
				'changefreq' => $changeFreq,
				'priority' => $priority
			);

			if ($model->hasAttribute('update_time'))
				$item['lastmod'] = $this->dateToW3C($model->update_time);

			$this->items[] = $item;
		}
	}

	/**
	 * @return string XML code
	 */
	public function render()
	{
		$dom = new DOMDocument('1.0', 'utf-8');
		$nsUrl = 'http://www.w3.org/2000/xhtml';
		$urlset = $dom->createElementNS('http://www.sitemaps.org/schemas/sitemap/0.9', 'urlset');
		$urlset->setAttributeNS('http://www.w3.org/2000/xmlns/', 'xmlns:xhtml', $nsUrl);
		foreach ($this->items as $item) {
			$url = $dom->createElement('url');

			foreach ($item as $key => $value) {

				//добавляем аттрибуты, если есть
				if (is_array($value)) {
					$elem = $dom->createElement($value['id']);
					unset($value['id']);
					foreach ($value as $key_attr => $dom_attribute) {
						$attribute = $dom->createAttribute($key_attr);
						$attribute->value = $dom_attribute;
						$elem->appendChild($attribute);
					}
				} else {
					$elem = $dom->createElement($key, $value);

				}
				$url->appendChild($elem);
			}
			$urlset->appendChild($url);

		}
		$dom->appendChild($urlset);

		return $dom->saveXML();
	}

	protected function dateToW3C($date)
	{
		if (is_int($date))
			return date(DATE_W3C, $date);
		else
			return date(DATE_W3C, strtotime($date));
	}
}