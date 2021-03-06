<?php
session_start();
// ini_set('display_errors','On');
// error_reporting(E_ALL);

/**
 * @author Keshav Mohta
 * @package Joomla
 * @subpackage Joomla! 1.5.7 component `property`
 * @license Copyright (c) 2010 - All Rights Reserved
 *
 */

/**
 * Entry point file for `property` component
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

$controller = null;

require_once(JPATH_COMPONENT.DS.'admin.controller.php');

//Include file for the requested controller
if($controller = JRequest::getVar('controller'))
{
	$path = JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php';
    if (file_exists($path))
	{
        require_once $path;
    }
	else
	{
        $controller = '';
    }
}

 //~ Component Helper
jimport('joomla.application.component.helper');


//Create Instance of the relevant Controller Class
$classname = 'PropertyController'.ucfirst($controller);
$controller = new $classname();

//Perform the requested task
$controller->execute(JRequest::getVar('task'));

if (isset($_REQUEST["debug"])) {
	if ($_REQUEST["debug"] == "on") $_SESSION["debug"] = true;
	if ($_REQUEST["debug"] == "off") $_SESSION["debug"] = false;
}

function debug_Log($message) {
	if ($_REQUEST["debug"]) {
	echo "<br>Debug: ".$message."<br>";
	}
}

//Redirect if set by controller
$controller->redirect();

?>

