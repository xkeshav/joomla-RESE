<?php
/**
 * Joomla! 1.5.7 component `property`
 *
 * @author Keshav Mohta
 * @package Joomla
 * @subpackage `property`admin controller
 * @license Copyright (c) 2010 - All Rights Reserved Agile technosys, Pune
 * @date Sep 10, 2010
 */


// no direct access
defined('_JEXEC') or die('Restricted access');

JHTML::_('behavior.mootools');

$document =& JFactory::getDocument();
$rootURL = JURI::root();
$document->addScript($rootURL.'media/system/js/jquery.min.js' );
//$document->addScript('jQuery.noConflict();');
jimport('joomla.application.component.controller');

/* Advertise Default Controller Class */

class PropertyController extends JController
{

	public function __construct()
	{
    	parent::__construct();
	}
	public function __toString()
	{
		$statement = "<br/>This is <b>".__CLASS__."</b> Class.<br/>Defined in <i>".__FILE__."</i>";
		return $statement;
 	}
}
?>
