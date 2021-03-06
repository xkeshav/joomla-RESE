<?php
/**
* @package   yoo_symphony Template
* @version   1.5.2 2009-11-05 11:26:17
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) 2007 - 2009 YOOtheme GmbH
*/

// no direct access
defined('_JEXEC') or die('Restricted access');
?>
<div class="joomla" >
	<div class="user">
	<form action="<?php echo JRoute::_( 'index.php', true, $this->params->get('usesecure')); ?>" method="post" name="com-login" id="com-form-login">
			<fieldset>
				<legend><?php echo JText::_('LOGIN') ?></legend>

				<div>
					<label class="label-left" for="username"><?php echo JText::_('Username') ?></label>
					<input name="username" id="username" type="text" class="inputbox" alt="username" size="18" />
				</div>
				<div>
					<label class="label-left" for="passwd"><?php echo JText::_('Password') ?></label>
					<input type="password" id="passwd" name="passwd" class="inputbox" size="18" alt="password" />
				</div>
				<?php if(JPluginHelper::isEnabled('system', 'remember')) : ?>
				<div>
					<label for="remember"><?php echo JText::_('Remember me') ?></label>
					<input type="checkbox" id="remember" name="remember" class="inputbox" value="yes" alt="Remember Me" />
				</div>
				<?php endif; ?>
				<div>
					<input type="submit" name="Submit" class="button" value="<?php echo JText::_('LOGIN') ?>" />
				</div>

			</fieldset>
			<ul>
				<li>
					<a href="<?php echo JRoute::_( 'index.php?option=com_user&view=reset' ); ?>"><?php echo JText::_('FORGOT_YOUR_PASSWORD'); ?></a>
				</li>
				<li>
					<a href="<?php echo JRoute::_( 'index.php?option=com_user&view=remind' ); ?>"><?php echo JText::_('FORGOT_YOUR_USERNAME'); ?></a>
				</li>
				<?php $usersConfig = &JComponentHelper::getParams( 'com_users' ); ?>
			</ul>

			<input type="hidden" name="option" value="com_user" />
			<input type="hidden" name="task" value="login" />
			<input type="hidden" name="return" value="<?php echo $this->return; ?>" />
			<?php echo JHTML::_( 'form.token' ); ?>
		</form>
	</div>
</div>

