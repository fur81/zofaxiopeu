<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<div class="registration-complete<?php echo $this->pageclass_sfx;?>">
	<div class="remind-reset-form-title"><?php echo JText::_('COM_USERS_REGISTRATION_DEFAULT_LABEL'); ?></div>
	<?php if ($this->params->get('show_page_heading')) : ?>
	<h1>
		<?php echo $this->escape($this->params->get('page_heading')); ?>
	</h1>
	<?php endif; ?>
</div>
<div>
<?php 
// Compile the notification mail values.
	$data['siteurl'] = JUri::root();
	$data['sitename'] = JFactory::getConfig()->get('sitename');
?>
<p>
<?php 
echo JText::sprintf('COM_USERS_EMAIL_REGISTERED_BODY_NOPW',
			$data['sitename'],
			$data['siteurl'])?>
</p>
</div>