<?php
/**
 * Hello View for Hello World Component
 * 
 * @package    Joomla.Tutorials
 * @subpackage Components
 * @link http://docs.joomla.org/Developing_a_Model-View-Controller_Component_-_Part_4
 * @license		GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );

/**
 * Hello View
 *
 * @package    Joomla.Tutorials
 * @subpackage Components
 */
class TabsViewTab extends JView
{
	/**
	 * display method of Hello view
	 * @return void
	 **/
	function display($tpl = null)
	{
		//get the hello
		$tab		=& $this->get('Data');
		$isNew		= ($tab->id < 1);

		$text = $isNew ? JText::_( 'New' ) : JText::_( 'Edit' );
		JToolBarHelper::title(   JText::_( 'Tab' ).': <small><small>[ ' . $text.' ]</small></small>' );
		JToolBarHelper::save();
		if ($isNew)  {
			JToolBarHelper::cancel();
		} else {
			// for existing items the button is renamed `close`
			JToolBarHelper::cancel( 'cancel', 'Close' );
		}
			//print_r($tab);jexit();
		$this->assignRef('tab',$tab);

		parent::display($tpl);
	}
}