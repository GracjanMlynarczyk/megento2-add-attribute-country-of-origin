<?php


namespace Ghratzoo\AttributeCountryOfOrigin\Model\Backend;


use Magento\Eav\Model\Entity\Attribute\Backend\AbstractBackend;
use Magento\Framework\Exception\LocalizedException;

class Backend extends AbstractBackend
{
    /**
     * @param \Magento\Framework\DataObject $object
     * @return bool
     * @throws LocalizedException
     */
    public function validate($object)
    {
        $value = $object->getData($this->getAttribute()->getAttributeCode());
        if (($object->getData($this->getAttribute()->getAttributeSetId()) == 10 ) && ($value == 'fur'))
        {
            throw new LocalizedException(__('Bottom cannot be fur'));
        }
    }


}
