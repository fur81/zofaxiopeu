<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_search
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('bootstrap.tooltip');

$lang = JFactory::getLanguage();
$upper_limit = $lang->getUpperLimitSearchWord();
?>
<form id="searchForm" action="<?php echo JRoute::_('index.php?option=com_search');?>" method="post">

	<div class="btn-toolbar">
		<div class="btn-group pull-left">
			<input type="text" name="searchword" placeholder="<?php echo JText::_('COM_SEARCH_SEARCH_KEYWORD'); ?>" id="search-searchword" size="30" maxlength="<?php echo $upper_limit; ?>" value="<?php echo $this->escape($this->origkeyword); ?>" class="inputbox" />
		</div>
		<div class="btn-group pull-left">
			<button name="Search" onclick="this.form.submit()" class="btn hasTooltip" title="<?php echo JHtml::tooltipText('COM_SEARCH_SEARCH');?>"><span class="icon-search"><?php echo JHtml::tooltipText('COM_SEARCH_SEARCH');?></span></button>
		</div>
		<input type="hidden" name="task" value="search" />
		<div class="clearfix"></div>
	</div>

	<div class="searchintro<?php echo $this->params->get('pageclass_sfx'); ?>">
		<?php if (!empty($this->searchword)):?>
		<p><?php echo JText::plural('COM_SEARCH_SEARCH_KEYWORD_N_RESULTS', '<span class="badge badge-info">'. $this->total. '</span>');?></p>
		<?php endif;?>
	</div>

	<fieldset class="phrases">
		<legend><?php echo JText::_('COM_SEARCH_FOR');?></legend>
			<table cellpadding="3" cellspacing="3">
            <tr>
            <div class="phrases-box">
			<td colspan="2"><?php echo $this->lists['searchphrase']; ?></td>
			</div>
            </tr>
			<div class="ordering-box">
       		<tr>
			<td width="30px"><label for="ordering" class="ordering">
				<?php echo JText::_('COM_SEARCH_ORDERING');?>
			</label></td>
			<td><?php echo $this->lists['ordering'];?></td>
            </tr>
            </table>
			</div>
	</fieldset>

	<?php if ($this->params->get('search_areas', 1)) : ?>
		<fieldset class="only">
		<legend><?php echo JText::_('COM_SEARCH_SEARCH_ONLY');?></legend>
		
		<table width="80%" cellpadding="2" cellspacing="2">
       	<tr>
		<?php foreach ($this->searchareas['search'] as $val => $txt) :
			$checked = is_array($this->searchareas['active']) && in_array($val, $this->searchareas['active']) ? 'checked="checked"' : '';
		?>
		<label for="area-<?php echo $val;?>" class="checkbox">
			<td width="10px">
            	<input type="checkbox" name="areas[]" value="<?php echo $val;?>" id="area-<?php echo $val;?>" <?php echo $checked;?> >
            </td>
            <td>
			<?php echo JText::_($txt); ?>
            </td>
		</label>
		<?php endforeach; ?>
        </tr>
        </table>
        
		</fieldset>
	<?php endif; ?>

<?php if ($this->total > 0) : ?>

	<div class="form-limit">
		<label for="limit">
			<?php echo JText::_('JGLOBAL_DISPLAY_NUM'); ?>
		</label>
		<?php echo $this->pagination->getLimitBox(); ?>
	</div>
<p class="counter">
		<?php echo $this->pagination->getPagesCounter(); ?>
	</p>

<?php endif; ?>

</form>
