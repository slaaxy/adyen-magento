<?php

/**
 * Adyen Payment Module
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * @category    Adyen
 * @package    Adyen_Payment
 * @copyright    Copyright (c) 2011 Adyen (http://www.adyen.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * @category   Payment Gateway
 * @package    Adyen_Payment
 * @author     Adyen
 * @property   Adyen B.V
 * @copyright  Copyright (c) 2019 Adyen BV (http://www.adyen.com)
 */
class Adyen_Payment_ThreeDS2ProcessController extends Mage_Core_Controller_Front_Action
{

    /**
     * Execute 3DS 2.0 request
     *
     * @return mixed
     * @throws Adyen_Payment_Exception
     */
    public function indexAction()
    {
        $payload = $this->getRequest()->getParams();

        // get current order
        $session = Mage::getSingleton('checkout/session');
        $order = Mage::getModel('sales/order')->loadByIncrementId($session->getLastRealOrderId());
        $storeId = $order->getStoreId();

        // get payment details
        $payment = $order->getPayment();

        return Mage::getSingleton('adyen/api')->authoriseThreeDS2Payment($payload, $payment, $storeId);
    }
}