<?php defined('C5_EXECUTE') or die("Access Denied.");

if (!isset($editor_selector)) {
	$editor_selector = 'ccm-advanced-editor';
}

$options = "{
	'plugins': ['concrete5']
}";
?>

<script type="text/javascript">
var CCM_EDITOR_SECURITY_TOKEN = "<?php echo Loader::helper('validation/token')->generate('editor')?>";
$(function() {
	$('.<?php echo $editor_selector?>').redactor(<?php echo $options?>);
});
</script>