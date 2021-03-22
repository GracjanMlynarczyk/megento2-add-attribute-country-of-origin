<?php


namespace Ghratzoo\AttributeCountryOfOrigin\Model\Frontend;


use Magento\Directory\Model\CountryFactory;
use Magento\Eav\Model\Entity\Attribute\Frontend\AbstractFrontend;
use Magento\Eav\Model\Entity\Attribute\Source\BooleanFactory;
use Magento\Framework\App\CacheInterface;
use Magento\Framework\DataObject;
use Magento\Framework\Serialize\Serializer\Json as Serializer;
use Magento\Store\Model\StoreManagerInterface;

class Frontend extends AbstractFrontend
{

    /**
     * @var CountryFactory
     */
    private CountryFactory $countryFactory;

    /**
     * Frontend constructor.
     * @param CountryFactory $countryFactory
     * @param BooleanFactory $attrBooleanFactory
     * @param CacheInterface|null $cache
     * @param null $storeResolver
     * @param array|null $cacheTags
     * @param StoreManagerInterface|null $storeManager
     * @param Serializer|null $serializer
     */
    public function __construct(
        CountryFactory $countryFactory,
        BooleanFactory $attrBooleanFactory,
        CacheInterface $cache = null,
        $storeResolver = null,
        array $cacheTags = null,
        StoreManagerInterface $storeManager = null,
        Serializer $serializer = null
    ){
        $this->countryFactory = $countryFactory;
        parent::__construct($attrBooleanFactory,
            $cache,
            $storeResolver,
            $cacheTags,
            $storeManager,
            $serializer
        );
    }


    /**
     * @param DataObject $object
     * @return bool|mixed
     */
    public function getValue(DataObject $object)
    {
        $value = $object->getData($this->getAttribute()->getAttributeCode());
        if ($value !== '') {
            return $this->countryFactory->create()->loadByCode($value)->getName();
        } else {
            return __('Unknown');
        }

    }


}
