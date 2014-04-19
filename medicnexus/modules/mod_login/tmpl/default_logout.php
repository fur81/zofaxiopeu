<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_login
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
?>
<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post" id="login-form" class="mn-form-vertical">
<?php if ($params->get('greeting')) : ?>
	<div class="mn-login-greeting">
	<?php if ($params->get('name') == 0) : {
		echo JText::sprintf('MOD_LOGIN_HINAME', htmlspecialchars($user->get('name')));
	} else : {
		echo JText::sprintf('MOD_LOGIN_HINAME', htmlspecialchars($user->get('username')));
	} endif; ?>
	<br>
	<a href="<?php echo JRoute::_('index.php?option=com_users&view=profile'); ?>"><?php echo JText::_('TPL_MN_PROFILE_INFORMATION_UPPER');?></a>
	<br>
	<?php echo JText::_('TPL_MN_ACTIVE_LANGUAGE') . ': ';?>
	<?php echo JLanguage::getInstance(JFactory::getUser()->getParam('language'))->getName();?>
	</div>
<?php endif; ?>
	<div class="controls" align="right" style="margin-right: 5px;">
		<button type="submit" name="Submit"><?php echo JText::_('JLOGOUT'); ?></button>
		<input type="hidden" name="option" value="com_users" />
		<input type="hidden" name="task" value="user.logout" />
		<input type="hidden" name="return" value="<?php echo $return; ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>
