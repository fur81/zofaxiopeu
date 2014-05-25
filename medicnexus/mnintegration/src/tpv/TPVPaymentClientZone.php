<?php 
# Medicnexus - sistema de gestión médica desarrollado en php

# Medicnexus es un programa para la realización de consultas
# en línea con médicos especializados. El sitio cuenta con noticias
# y artículos que podrán mantener actualizados al cliente con los
# últimos acontecimientos existentes en el área. Cuenta con un sistema
# de respuesta rápida a partir de las consultas realizadas por el cliente.

# Todos los derechos reservados

/**
 * Establece la comunicación con la pasarela de pago TPV. En el formulario se colocan
 * todos los valores que serán enviados al servicio de pago.
 */
include_once ( $GLOBALS['TPV_COMMON'] ); // se incluye el fichero de configuración para TPV

$tpvData = setTPVEnviromentConfiguration('live', $idData);  // las opciones pueden ser 'sandbox' o 'live'
?>

<form id="f_tpv" name="f_tpv" action="<?php echo $tpvData->urlTPV;?>" method="post" style="height:1px; width:1px; overflow: hidden;">
	<input type="hidden" size="80" id="Ds_Merchant_Amount" name="Ds_Merchant_Amount" value="<?php echo $tpvData->import;?>" title="Import. 12N. Dos últimes posicions són els decimals" />
    <input type="hidden" size="80" id="Ds_Merchant_Currency" name="Ds_Merchant_Currency" value="<?php echo $tpvData->currency;?>" title="Moneda. EURO" />
    <input type="hidden" size="80" id="Ds_Merchant_Order" name="Ds_Merchant_Order" value="<?php echo $tpvData->order;?>" title="Codi ID de la compra. Mín:4N Màx:12AN" />
    <input type="hidden" size="80" id="Ds_Merchant_ProductDescription" name="Ds_Merchant_ProductDescription" value="<?php echo $tpvData->producDescription .' ('. $tpvData->email .')';?>" title="Descripció de la compra. Màx:125AN" />
    <input type="hidden" size="80" id="Ds_Merchant_Titular" name="Ds_Merchant_Titular" value="<?php echo $tpvData->name;?>" title="Titular. Màx:60AN" />
    <input type="hidden" size="80" id="Ds_Merchant_MerchantCode" name="Ds_Merchant_MerchantCode" value="<?php echo $tpvData->code;?>" title="Codi subministrat pel banc. 9N" />
    <input type="hidden" size="80" id="Ds_Merchant_MerchantSignature" name="Ds_Merchant_MerchantSignature" size="80" value="<?php echo $tpvData->hash;?>" title="HASH" />
    <input type="hidden" size="80" id="Ds_Merchant_Terminal" name="Ds_Merchant_Terminal" value="<?php echo $tpvData->terminal;?>" title="Número de terminal de la tenda. 3N" />

	<input type="hidden" size="80" id="Ds_Merchant_MerchantURL" name="Ds_Merchant_MerchantURL" value="<?php echo $tpvData->urlReturn;?>" />
    <input type="hidden" size="80" id="Ds_Merchant_MerchantName" name="Ds_Merchant_MerchantName" value="<?php echo $tpvData->nameSistem;?>" />
	<input type="hidden" size="80" id="Ds_Merchant_MerchantLanguage" name="Ds_Merchant_MerchantLanguage" value="<?php echo $tpvData->language;?>" />
    <input type="hidden" size="80" id="Ds_Merchant_MerchantData" name="Ds_Merchant_MerchantData" value="" />
    <input type="hidden" size="80" id="Ds_Merchant_TransactionType" name="Ds_Merchant_TransactionType" value="<?php echo $tpvData->type;?>" />
                    
    <?php // URL de retorn ?>
    <input type="hidden" size="80" id="Ds_Merchant_UrlOK" name="Ds_Merchant_UrlOK" value="<?php echo $tpvData->urlSuccess;?>" />
    <input type="hidden" size="80" id="Ds_Merchant_UrlKO" name="Ds_Merchant_UrlKO" value="<?php echo $tpvData->urlUnsuccess;?>" />
</form>
                
<script>
	document.getElementById("f_tpv").submit();                                       
</script>
