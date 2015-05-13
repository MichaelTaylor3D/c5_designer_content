<?php
namespace Concrete\Package\DesignerContent\Controller\SinglePage\Dashboard\Blocks;

defined('C5_EXECUTE') or die(_('Access Denied.'));

use Controller;
use Loader;
use \Concrete\Package\DesignerContent\Controller\SinglePage\Dashboard\Blocks\DesignerContent as DesignerContent;

//Outputs "1" if handle is not in use by anything (blocks, packages, files, database)
//Outputs "2" if a corresponding database table exists for this handle but it is otherwise not in use (no blocks, packages, or files)
//Outputs nothing otherwise.

class ValidateHandle extends Controller
{
	function view() {}
   
    public function validate()
    {
      	if (!empty($_GET['handle'])) {
			$handle = $_GET['handle'];
		
			if (DesignerContent::validate_unique_handle($handle)) {
				if (DesignerContent::validate_unique_tablename_for_handle($handle)) {
					echo "1";
				} else {
					echo "2";
				}
			}
	 	}
	 	exit;
    }
}