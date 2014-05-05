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
	<span style="color: #333;"><?php echo JText::_('MOD_LOGIN_HINAME'); ?></span>
	<?php if ($params->get('name') == 0) :?>
		<?php echo JText::sprintf(htmlspecialchars($user->get('name'))); ?>
	<?php else: ?>
		<?php echo JText::sprintf(htmlspecialchars($user->get('username'))); ?>
	<?php endif; ?>
	!
	<br>
	<div style="margin-top: 15px; line-height: 22px;">
	<a style="margin-top: 15px;" href="<?php echo JRoute::_('index.php?option=com_users&view=profile'); ?>">
		<?php echo JText::_('TPL_MN_PROFILE_INFORMATION_UPPER') . ' | ';?>
	</a>
	<a href="<?php echo JRoute::_('index.php?option=com_users&view=profile'); ?>">
		<img alt="icon_profile.gif" src="templates/medicnexus/images/icon_profile.gif">
	</a>
	</div>	
	<?php echo JText::_('TPL_MN_ACTIVE_LANGUAGE') . ': ';?>
	<?php echo JLanguage::getInstance(JFactory::getUser()->getParam('language'))->getName();?>
	</div>
<?php endif; ?>
	<div class="controls" align="right" style="margin: 10px 5px 0 0;">
		<button type="submit" name="Submit"><?php echo JText::_('JLOGOUT'); ?></button>
		<input type="hidden" name="option" value="com_users" />
		<input type="hidden" name="task" value="user.logout" />
		<input type="hidden" name="return" value="<?php echo $return; ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>
