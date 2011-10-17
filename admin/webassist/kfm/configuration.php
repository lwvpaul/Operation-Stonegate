<?php
@session_start();
$startKFMDir = getcwd();
chdir(dirname(__FILE__));
require_once( "library.php" );
?>
<?php require_once( "../../Connections/GoCreate.php" ); ?>
<?php //Security ?>
<?php chdir($startKFMDir); ?>
<?php
$kfm_hidden_sidebar = false;
if(isset($_GET['showsidebar']) && $_GET['showsidebar'] == 'false') {
	$kfm_hidden_sidebar = true;
}
$kfm_db_type = 'mysql';
$kfm_db_prefix   = 'wafm2_';
$kfm_db_host = $hostname_GoCreate;
$kfm_db_name = $database_GoCreate;
$kfm_db_username = $username_GoCreate;
$kfm_db_password = $password_GoCreate;
$kfm_db_port     = '';
$use_kfm_security = false;
$kfm_userfiles_address = '../../siteimg/';
if (isset($_SESSION['useOverrideRoot']))  {
  $kfm_userfiles_address = abs2rel($_SESSION['useOverrideRoot'],dirname(__FILE__));
}
$kfm_userfiles_output = rel2abs($kfm_userfiles_address,dirname(__FILE__));
$kfm_workdirectory = '.thumbnails';
$kfm_imagemagick_path = '/usr/bin/convert';
$kfm_dont_send_metrics = 1;
$kfm_server_hours_offset = 1;

/**
 * This function is called in the admin area. To specify your own admin requirements or security, un-comment and edit this function
 */
function kfm_admin_check(){
	return false;
}
?>