<?php
/**
 * Created by Qoliber
 *
 * @category    Qoliber
 * @package     Qoliber_PaymentRestrictions
 * @author      qoliber <info@qoliber.com>
 */

declare(strict_types = 1);

namespace Qoliber\PaymentRestrictions\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Magento\Payment\Helper\Data;

class AvailablePaymentMethods implements OptionSourceInterface
{
    /** @var string */
    public const AVAILABLE_PAYMENT_METHODS = 'available_payment_methods';

    /**
     * @param Data $paymentHelper
     */
    public function __construct(protected Data $paymentHelper)
    {
    }

    /**
     * To option array
     *
     * @return array<mixed>
     */
    public function toOptionArray(): array
    {
        return $this->paymentHelper->getPaymentMethodList(true, true, true);
    }
}
