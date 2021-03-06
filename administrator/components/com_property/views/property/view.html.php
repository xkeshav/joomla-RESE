<?php
	/**
	* @package		Joomla
	* @author Keshav Mohta
	* @subpackage	`property` manage view
	* @license		GNU/GPL, see LICENSE.php
	* @date Sep 10,2010
	*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

class PropertyViewProperty extends JView
{
	function display($tpl = null)
    {
		JToolBarHelper::title( JText::_( 'Property Manager' ), 'property.png' );
		// Make an object of Main Model class contains Main functions
		$propertyModel =& $this->getModel();
		//JRequest::watch($propertyModel);
		$prop_info=$propertyModel->getPropertyInfo();
		//JRequest::watch($prop_detail);
		unset($_SESSION['prop_id']);
		$this->assignRef('prop_info', $prop_info);
        parent::display($tpl);
    }

}
?>