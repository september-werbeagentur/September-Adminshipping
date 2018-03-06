<?php

class September_Adminshipping_Model_Carrier_Adminshipping extends Mage_Shipping_Model_Carrier_Abstract
{
    protected $_code = 'september_adminshipping';

    public function getAllowedMethods()
    {
        return array(
            'standard' => 'Pickup by customer',
        );
    }

    public function collectRates(Mage_Shipping_Model_Rate_Request $request)
    {
        /** @var Mage_Shipping_Model_Rate_Result $result */
        $result = Mage::getModel('shipping/rate_result');
        $result->append($this->_getStandardRate());
        return $result;
    }

    protected function _getStandardRate()
    {
        /** @var Mage_Shipping_Model_Rate_Result_Method $rate */
        $rate = Mage::getModel('shipping/rate_result_method');

        $rate->setCarrier($this->_code);
        $rate->setCarrierTitle($this->getConfigData('title'));
        $rate->setMethod('large');
        $rate->setMethodTitle('Selbstabholung');
        $rate->setPrice(0);
        $rate->setCost(0);

        return $rate;
    }
}
