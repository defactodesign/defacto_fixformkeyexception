<?php

/**
 * @category    Defacto
 * @package     Defacto_FixFormKeyException
 * @author      De Facto Design <developers@de-facto.com>
 * @license     GPL-3.0
 */

/**
 * Class Defacto_FixFormKeyException_Helper_Data
 */
class Defacto_FixFormKeyException_Helper_Data
    extends Mage_Core_Helper_Abstract
{
    const XML_PATH_FORM_KEY_MESSAGE = 'checkout/cart/defacto_form_key_message';

    /**
     * Returns the error message that is displayed to the customer on invalid form keys.
     *
     * @return string
     */
    public function getErrorMessage()
    {
        return Mage::getStoreConfig(self::XML_PATH_FORM_KEY_MESSAGE);
    }
}
