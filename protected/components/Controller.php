<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout = '//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu = array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs = array();

	public $default_language = 'ru';

	public $seo_description = '';
	public $seo_keywords = '';
	public $seo_footer = '';

	public function __construct($id, $module = null)
	{
		parent::__construct($id, $module);
		// If there is a post-request, redirect the application to the provided url of the selected language
		if (isset($_POST['language'])) {
			$lang = $_POST['language'];
			$MultilangReturnUrl = $_POST[$lang];
			$this->redirect($MultilangReturnUrl);
		}
		// Set the application language if provided by GET, session or cookie
		if (isset($_GET['language'])) {
			Yii::app()->language = $_GET['language'];
			Yii::app()->user->setState('language', $_GET['language']);
			$cookie = new CHttpCookie('language', $_GET['language']);
			$cookie->expire = time() + (60 * 60 * 24 * 365); // (1 year)
			Yii::app()->request->cookies['langage'] = $cookie;
//        } else if (Yii::app()->user->hasState('language')) {
//            Yii::app()->language = Yii::app()->user->getState('language');
		} else if (isset(Yii::app()->request->cookies['language'])) {
			Yii::app()->language = Yii::app()->request->cookies['language']->value;
			$this->redirect(Yii::app()->language);
		} else {
			$this->redirect($this->default_language);
		}
		$this->_setSeo();
	}

	protected function _setSeo()
	{
		$seo = new Seo();
		$model_seo = $seo::model();
		$language = Yii::app()->getLanguage();
		if ($record = $model_seo->find('name=:myParams', array(':myParams' => 'description_' . $language))) {
			$this->seo_description = $record->text;
		}
		if ($record = $model_seo->find('name=:myParams', array(':myParams' => 'keywords_' . $language))) {
			$this->seo_keywords = $record->text;
		}
		if ($record = $model_seo->find('name=:myParams', array(':myParams' => 'footer_' . $language))) {
			$this->seo_footer = $record->text;
		}
	}

	public function createMultilanguageReturnUrl($lang = 'en')
	{
		if (count($_GET) > 0) {
			$arr = $_GET;
			$arr['language'] = $lang;
		} else
			$arr = array('language' => $lang);
		return $this->createUrl('', $arr);
	}
}