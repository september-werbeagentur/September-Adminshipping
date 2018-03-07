<?php
/**
 * Provides a shipping method which may only be chosen in the backend (by the admin).
 *
 * @package    September_Adminshipping
 * @author     hauke@september-werbeagentur.de
 * @website    https://www.september-werbeagentur.de
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class September_Adminshipping_Model_Shipping extends Mage_Shipping_Model_Shipping
{
    public function collectCarrierRates($carrierCode, $request)
    {
        if (!$this->_checkCarrierAvailability($carrierCode, $request)) {
            return $this;
        }
        return parent::collectCarrierRates($carrierCode, $request);
    }

    /**
     * @param $carrierCode
     * @param null $request
     * @return bool true if method is awailable
     */
    protected function _checkCarrierAvailability($carrierCode, $request = null)
    {
        if ($carrierCode == 'september_adminshipping' && !$this->isAdmin()) {
            return false;
        }
        return true;
    }

    /**
     * @return bool true if logged in in backend
     */
    protected function isAdmin()
    {
        if (Mage::app()->getStore()->isAdmin() || Mage::getDesign()->getArea() == 'adminhtml') {
            return true;
        }
        return false;
    }
}
