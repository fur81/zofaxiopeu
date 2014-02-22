<?php
if (isset($_SESSION ['msg'])) {
	switch ($_SESSION ['msg']) {
		case 'msg_info_consult_inserted' :
			JFactory::getApplication()->enqueueMessage(getValueIn('msg_info_consult_inserted'), getValueIn('msg_info'));
			break;

		case 'msg_error_consult_inserted' :
			JFactory::getApplication()->enqueueMessage(getValueIn('msg_error_consult_inserted'), getValueIn('msg_error'));
			break;

		case 'msg_info_upload_inserted' :
			JFactory::getApplication()->enqueueMessage(getValueIn('msg_info_upload_inserted'), getValueIn('msg_info'));
			break;
			
		case 'msg_error_upload_size' :
			JFactory::getApplication()->enqueueMessage(getValueIn('msg_error_upload_size'), getValueIn('msg_error'));
			break;
	}
	unset($_SESSION ['msg']);
}
?>