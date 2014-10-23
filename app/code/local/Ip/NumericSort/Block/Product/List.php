<?php

class Ip_NumericSort_Block_Product_List extends Mage_Catalog_Block_Product_List
{


    /**
     * Retrieve loaded category collection
     *
     * @return Mage_Eav_Model_Entity_Collection_Abstract
     */
    protected function _getProductCollection()
    {
        if (is_null($this->_productCollection)) {
            parent::_getProductCollection();
            $toolbar = $this->getToolbarBlock();
            $filterAttribute = $toolbar->getCurrentOrder();
            $filterAttributeDir = $toolbar->getCurrentDirection();
            $attributeType = Mage::getModel('eav/entity_attribute')->loadByCode('catalog_product', $filterAttribute);
            if ($attributeType->getAttributeCode() == 'catalog_position') {
                $this->_productCollection->getSelect()->reset(Zend_Db_Select::ORDER);
                $this->_productCollection->getSelect()->order('CAST(`' . $filterAttribute . '` AS SIGNED) ' . $filterAttributeDir . "'");

            }
        }
        return $this->_productCollection;
    }


}