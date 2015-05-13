<?php 
namespace Concrete\Package\DesignerContent;

use Loader;
use Page;
use SinglePage;
use CollectionAttributeKey;
use BlockType;
use Route;
use View;
use Plugin;
use \Core;
use \Concrete\Package\DesignerContent\Libraries\BlockGenerator as DesignerContentBlockGenerator;

defined('C5_EXECUTE') or die(_("Access Denied."));

class Controller extends \Concrete\Core\Package\Package {
	
	protected $pkgHandle = 'designer_content';
	protected $appVersionRequired = '5.7';
	protected $pkgVersion = '4.0';

	public function on_start()	{
	    Route::register('/validate_handle', '\Concrete\Package\DesignerContent\Controller\SinglePage\Dashboard\Blocks\ValidateHandle::validate');
	}

	public function getPackageName() {
		return t("Designer Content"); 
	}	
	
	public function getPackageDescription() {
		return t('Create custom content blocks via the dashboard.');
	}
	
	public function install() {
		$pkg = parent::install();
		$this->_upgrade($pkg);
	}
	
	public function upgrade() {
		$pkg = Package::getByHandle('designer_content');
		$this->_upgrade($pkg);
		parent::upgrade();
	}
	
	private function _upgrade(&$pkg) {
		Loader::model('single_page');
		
		$oldDashboardPage = Page::getByPath('/dashboard/pages/designer_content');
		if ($oldDashboardPage && is_object($oldDashboardPage) && $oldDashboardPage->getCollectionID()) {
			$oldDashboardPage->delete();
		}
		
		$newDashboardPage = Page::getByPath('/dashboard/blocks/designer_content');
		if (!$newDashboardPage || !is_object($newDashboardPage) || !$newDashboardPage->getCollectionID()) {
			$newDashboardPage = SinglePage::add('/dashboard/blocks/designer_content', $pkg);
		}
		
		$this->_setupDashboardIcon($newDashboardPage, 'icon-gift');
		
	}
	
	private function _setupDashboardIcon($page, $icon) {
		$cak = CollectionAttributeKey::getByHandle('icon_dashboard');
		if (is_object($cak)) {
			$page->setAttribute('icon_dashboard', $icon);
		}
	}
	
}
