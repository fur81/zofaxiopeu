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
JHtml::_('bootstrap.tooltip');
?>
<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post" id="login-form" class="form-inline">
	<?php if ($params->get('pretext')) : ?>
		<div class="pretext">
		<p><?php echo $params->get('pretext'); ?></p>
		</div>
	<?php endif; ?>
	<div class="mn-userdata">
		<div id="form-login-username" class="control-group">
			<div class="controls">
				<?php if (!$params->get('usetext')) : ?>
                <table>
                	<tr>
                    	<td colspan="2">
                        	<label for="modlgn-username" class="mn-element-invisible"><?php echo JText::_('MOD_LOGIN_VALUE_USERNAME'); ?></label>
                        </td>
                    </tr>
                    <tr>
                    	<td colspan="2">
                        	<input id="modlgn-username" type="text" name="username" class="mn-input-small" tabindex="0" size="18" placeholder="<?php echo JText::_('MOD_LOGIN_VALUE_USERNAME') ?>" />
                        </td>
                    </tr>
                    <?php else: ?>
                    <tr>
                    	<td colspan="2">
                        	<label for="modlgn-username"><?php echo JText::_('MOD_LOGIN_VALUE_USERNAME') ?></label>
                        </td>
                    </tr>
                    <tr>
                    	<td colspan="2">
                        	<input id="modlgn-username" type="text" name="username" class="mn-input-small" tabindex="0" size="18" placeholder="<?php echo JText::_('MOD_LOGIN_VALUE_USERNAME') ?>" />
                        </td>
                    </tr>
                    <?php endif; ?>
                    <?php if (!$params->get('usetext')) : ?>
                    <tr>
                    	<td colspan="2">
                        	<label for="modlgn-passwd" class="mn-element-invisible"><?php echo JText::_('JGLOBAL_PASSWORD'); ?></label>
                        </td>
                    </tr>
                    <tr>
                    	<td colspan="2">
                        	<input id="modlgn-passwd" type="password" name="password" class="mn-input-small" tabindex="0" size="18" placeholder="<?php echo JText::_('JGLOBAL_PASSWORD') ?>" />
                        </td>
                    </tr>
                    <?php else: ?>
                    <tr>
                    	<td colspan="2">
                        	<label for="modlgn-passwd"><?php echo JText::_('JGLOBAL_PASSWORD') ?></label>
                        </td>
                    </tr>
                    <tr>
                    	<td colspan="2">
                        	<input id="modlgn-passwd" type="password" name="password" class="mn-input-small" tabindex="0" size="18" placeholder="<?php echo JText::_('JGLOBAL_PASSWORD') ?>" />
                        </td>
                    </tr>
                    <?php endif; ?>
                    <?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
                    <tr>
                    	<td width="35%">
                        	<label for="modlgn-remember" class="mn-control-label"><?php echo JText::_('MOD_LOGIN_REMEMBER_ME') ?></label>
                        </td>
                        <td>
                        	<input id="modlgn-remember" type="checkbox" name="remember" class="inputbox" value="yes"/>
                        </td>
                    </tr>
                    <tr>
                    	<td colspan="2">
                        	<?php
			$usersConfig = JComponentHelper::getParams('com_users');
			if ($usersConfig->get('allowUserRegistration')) : ?>
			<ul class="mn-unstyled">
				<li>
					<a href="<?php echo JRoute::_('index.php?option=com_users&view=registration'); ?>">
					<?php echo JText::_('MOD_LOGIN_REGISTER'); ?> <span class="icon-arrow-right"></span></a>
				</li>
				<li>
					<a href="<?php echo JRoute::_('index.php?option=com_users&view=remind'); ?>">
					  <?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_USERNAME'); ?></a>
				</li>
				<li>
					<a href="<?php echo JRoute::_('index.php?option=com_users&view=reset'); ?>"><?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_PASSWORD'); ?></a>
				</li>

			</ul>
		<?php endif; ?>
		<input type="hidden" name="option" value="com_users" />
		<input type="hidden" name="task" value="user.login" />
		<input type="hidden" name="return" value="<?php echo $return; ?>" />
		<?php echo JHtml::_('form.token'); ?>
                        </td>
                    </tr>
                    <?php endif; ?>
                    <tr>
                    	<td colspan="2" align="right">
                        	<button type="submit" tabindex="0" name="Submit" class="mn-btn-login"><?php echo JText::_('JLOGIN') ?></button>
                        </td>
                    </tr>
                </table>
				
                <!--
                
                <?php if (!$params->get('usetext')) : ?>
					<div class="input-prepend input-append">
						<span class="add-on">
							<span class="icon-user tip" title="<?php echo JText::_('MOD_LOGIN_VALUE_USERNAME') ?>"></span>
							<label for="modlgn-username" class="mn-element-invisible"><?php echo JText::_('MOD_LOGIN_VALUE_USERNAME'); ?></label>
						</span>
						<input id="modlgn-username" type="text" name="username" class="mn-input-small" tabindex="0" size="18" placeholder="<?php echo JText::_('MOD_LOGIN_VALUE_USERNAME') ?>" />
					</div>
				<?php else: ?>
					<label for="modlgn-username"><?php echo JText::_('MOD_LOGIN_VALUE_USERNAME') ?></label>
						<input id="modlgn-username" type="text" name="username" class="mn-input-small" tabindex="0" size="18" placeholder="<?php echo JText::_('MOD_LOGIN_VALUE_USERNAME') ?>" />
				<?php endif; ?>
                
                -->
			</div>
		</div>
		
        <!--
        
        <div id="form-login-password" class="control-group">
			<div class="controls">
				<?php if (!$params->get('usetext')) : ?>
					<div class="input-prepend input-append">
						<span class="add-on">
							<span class="icon-lock tip" title="<?php echo JText::_('JGLOBAL_PASSWORD') ?>">
							</span>
								<label for="modlgn-passwd" class="mn-element-invisible"><?php echo JText::_('JGLOBAL_PASSWORD'); ?>
							</label>
						</span>
						<input id="modlgn-passwd" type="password" name="password" class="mn-input-small" tabindex="0" size="18" placeholder="<?php echo JText::_('JGLOBAL_PASSWORD') ?>" />
				</div>
				<?php else: ?>
					<label for="modlgn-passwd"><?php echo JText::_('JGLOBAL_PASSWORD') ?></label>
					<input id="modlgn-passwd" type="password" name="password" class="mn-input-small" tabindex="0" size="18" placeholder="<?php echo JText::_('JGLOBAL_PASSWORD') ?>" />
				<?php endif; ?>

			</div>
		</div>
        
        -->
        
        <!--
        
        <?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
		<div id="form-login-remember" class="control-group checkbox">
			<label for="modlgn-remember" class="control-label"><?php echo JText::_('MOD_LOGIN_REMEMBER_ME') ?></label> <input id="modlgn-remember" type="checkbox" name="remember" class="inputbox" value="yes"/>
		</div>
		<?php endif; ?>
		<div id="form-login-submit" class="control-group">
			<div class="controls">
				<button type="submit" tabindex="0" name="Submit" class="btn btn-primary"><?php echo JText::_('JLOGIN') ?></button>
			</div>
		</div>
        
        -->
		
		<!--
		
		<?php
			$usersConfig = JComponentHelper::getParams('com_users');
			if ($usersConfig->get('allowUserRegistration')) : ?>
			<ul class="mn-unstyled">
				<li>
					<a href="<?php echo JRoute::_('index.php?option=com_users&view=registration'); ?>">
					<?php echo JText::_('MOD_LOGIN_REGISTER'); ?> <span class="icon-arrow-right"></span></a>
				</li>
				<li>
					<a href="<?php echo JRoute::_('index.php?option=com_users&view=remind'); ?>">
					  <?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_USERNAME'); ?></a>
				</li>
				<li>
					<a href="<?php echo JRoute::_('index.php?option=com_users&view=reset'); ?>"><?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_PASSWORD'); ?></a>
				</li>

			</ul>
		<?php endif; ?>
		<input type="hidden" name="option" value="com_users" />
		<input type="hidden" name="task" value="user.login" />
		<input type="hidden" name="return" value="<?php echo $return; ?>" />
		<?php echo JHtml::_('form.token'); ?>
        
        -->
        
        
	</div>
	<?php if ($params->get('posttext')) : ?>
		<div class="posttext">
		<p><?php echo $params->get('posttext'); ?></p>
		</div>
	<?php endif; ?>
</form>
