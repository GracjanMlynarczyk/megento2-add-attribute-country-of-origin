<?php


namespace Ghratzoo\AttributeCountryOfOrigin\Model\Config;


use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use Magento\Directory\Model\AllowedCountries;
use Magento\Directory\Model\CountryFactory;

class CountryOfOriginOptions extends AbstractSource
{
    /**
     * @var CountryFactory
     */
    private CountryFactory $countryFactory;

    /**
     * @var AllowedCountries
     */
    private AllowedCountries $allowedCountries;

    /**
     * CountryOfOriginOptions constructor.
     * @param CountryFactory $countryFactory
     * @param AllowedCountries $allowedCountries
     */
    public function __construct(CountryFactory $countryFactory, AllowedCountries $allowedCountries)
    {
        $this->countryFactory = $countryFactory;
        $this->allowedCountries = $allowedCountries;
    }

    /**
     * @return array
     */
    public function getAllOptions()
    {
        $countries = [
            ['label' => '', 'value' => 'undefined']
        ];

        $countryCollection = $this->allowedCountries->getAllowedCountries();

        foreach ($countryCollection as $country) {

            array_push($countries, [
                'label' => $this->countryFactory->create()->loadByCode($country)->getName(),
                'value' => $country
            ]);
        }

        $this->_options = $countries;

        return $this->_options;
    }
}
