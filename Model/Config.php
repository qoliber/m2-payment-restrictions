<?php
/**
 * Created by Qoliber
 *
 * @category    Qoliber
 * @package     Qoliber_PaymentRestrictions
 * @author      qoliber <info@qoliber.com>
 */

declare(strict_types = 1);

namespace Qoliber\PaymentRestrictions\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Qoliber\PaymentRestrictions\Model\Config\Source\AvailablePaymentMethods;

class Config
{
    /**
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     */
    public function __construct(protected ScopeConfigInterface $scopeConfig)
    {
    }

    /**
     * Get available payment methods
     *
     * @param string $shippingCode
     *
     * @return array<mixed>
     */
    public function getAvailablePaymentMethods(string $shippingCode): array
    {
        $availablePaymentMethods = $this->scopeConfig->getValue(
            sprintf(
                'carriers/%s/%s',
                $shippingCode,
                AvailablePaymentMethods::AVAILABLE_PAYMENT_METHODS
            ),
            ScopeInterface::SCOPE_STORES
        );

        if ($availablePaymentMethods) {
            return explode(',', $availablePaymentMethods);
        }

        return [];
    }
}
