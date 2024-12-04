<?php
/**
 * Created by Qoliber
 *
 * @category    Qoliber
 * @package     Qoliber_PaymentRestrictions
 * @author      qoliber <info@qoliber.com>
 */

declare(strict_types = 1);

namespace Qoliber\PaymentRestrictions\Plugin\Config;

use Magento\Config\Model\Config\Structure\Data;
use Qoliber\PaymentRestrictions\Model\Config\Source\AvailablePaymentMethods;

class AddFilterField
{
    /**
     * Before merge
     *
     * @param \Magento\Config\Model\Config\Structure\Data $object
     * @param array<mixed> $config
     *
     * @return array<mixed>
     */
    public function beforeMerge(Data $object, array $config): array
    {
        if (!isset($config['config']['system'])
            || !isset($config['config']['system']['sections']['carriers'])) {
            return [$config];
        }

        if (array_key_exists(
            'carriers',
            $config['config']['system']['sections']
        )) {
            $carriers =
                $config['config']['system']['sections']['carriers']['children'];
            foreach ($carriers as $index => $section) {
                $carriers[$index]['children'][AvailablePaymentMethods::AVAILABLE_PAYMENT_METHODS] =
                    $this->getNewField($index);
            }

            $config['config']['system']['sections']['carriers']['children'] =
                $carriers;
        }

        return [$config];
    }

    /**
     * Get new field
     *
     * @param string $groupId
     *
     * @return array<mixed>
     */
    protected function getNewField(string $groupId): array
    {
        return [
            'id'            => AvailablePaymentMethods::AVAILABLE_PAYMENT_METHODS,
            'type'          => 'multiselect',
            'sortOrder'     => 50,
            'showInDefault' => 1,
            'showInWebsite' => 1,
            'canRestore'    => 1,
            'label'         => __('Available Payments Methods'),
            'comment'       => __(
                'Select payment methods available with this delivery method'
            ),
            'source_model'  => AvailablePaymentMethods::class,
            '_elementType'  => 'field',
            'path'          => sprintf('carriers/%s', $groupId),
        ];
    }
}
