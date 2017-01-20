<?php

/**
 * @category    Defacto
 * @package     Defacto_FixFormKeyException
 * @author      De Facto Design <developers@de-facto.com>
 * @license     GPL-3.0
 */

/**
 * Class Defacto_FixFormKeyException_Model_Observer
 *
 * Prevent error reporting being generated when invalid form key occurs for
 * checkout/cart/ajaxdelete and checkout/cart/ajaxupdate.
 */
class Defacto_FixFormKeyException_Model_Observer
{
    /**
     * @param Varien_Event_Observer $event
     */
    public function preventAjaxInvalidKeyReport(Varien_Event_Observer $event)
    {
        $action = $event->getEvent()->getData('controller_action');
        if (!$this->_validateFormKey($action)) {
            $this->_returnErrorJson($action);
        }
    }

    /**
     * @param $action
     * @return bool
     */
    protected function _validateFormKey($action)
    {
        if (Mage::getStoreConfigFlag(Mage_Core_Controller_Front_Action::XML_CSRF_USE_FLAG_CONFIG_PATH)) {
            if (!($formKey = $action->getRequest()->getParam('form_key', null))
                || $formKey != Mage::getSingleton('core/session')->getFormKey()) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param $action
     */
    protected function _returnErrorJson($action)
    {
        // set no dispatch so the main action isn't triggered
        $action->setFlag(
            $action->getRequest()->getActionName(),
            Mage_Core_Controller_Varien_Action::FLAG_NO_DISPATCH,
            true
        );
        // set response to json error message
        $result = Mage::helper('core')
            ->jsonEncode(
                array(
                    'success' => 0,
                    'error'   => Mage::helper('checkout')->__('Invalid form key'),
                )
            );
        Mage::app()
            ->getResponse()
            ->setHeader('Content-type', 'application/json')
            ->setBody($result);
    }
}