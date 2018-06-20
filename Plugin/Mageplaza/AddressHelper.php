<?php
/**
 *
 *          ..::..
 *     ..::::::::::::..
 *   ::'''''':''::'''''::
 *   ::..  ..:  :  ....::
 *   ::::  :::  :  :   ::
 *   ::::  :::  :  ''' ::
 *   ::::..:::..::.....::
 *     ''::::::::::::''
 *          ''::''
 *
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Creative Commons License.
 * It is available through the world-wide-web at this URL:
 * http://creativecommons.org/licenses/by-nc-nd/3.0/nl/deed.en_US
 * If you are unable to obtain it through the world-wide-web, please send an email
 * to servicedesk@tig.nl so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this module to newer
 * versions in the future. If you wish to customize this module for your
 * needs please contact servicedesk@tig.nl for more information.
 *
 * @copyright   Copyright (c) Total Internet Group B.V. https://tig.nl/copyright
 * @license     http://creativecommons.org/licenses/by-nc-nd/3.0/nl/deed.en_US
 */
namespace TIG\Postcode\Plugin\Mageplaza;

use TIG\Postcode\Config\Provider\ModuleConfiguration;

class AddressHelper
{
    private $moduleConfig;

    public function __construct(
        ModuleConfiguration $moduleConfiguration
    ) {
        $this->moduleConfig = $moduleConfiguration;
    }

    /**
     * Subject => \Mageplaza\Osc\Helper\Address
     * Compatible plugin, Mageplaza skippes grouped fields, so we need to add this manualy.
     *
     * @param         $subject
     * @param         $fieldPostion
     *
     * @return mixed
     */
    // @codingStandardsIgnoreLine
    public function afterGetAddressFieldPosition($subject, $fieldPostion)
    {
        if ($this->moduleConfig->isModusOff()) {
            return $fieldPostion;
        }

        return $this->addPostcodeFieldGroup($fieldPostion);
    }

    /**
     * @param $fieldPostion
     *
     * @return mixed
     */
    private function addPostcodeFieldGroup($fieldPostion)
    {
        $fieldPostion['postcode-field-group'] = [
            'sortOrder' => 3,
            'colspan'   => 12,
            'isNewRow'  => true
        ];

        return $fieldPostion;
    }
}
