<?php
/**
 * Created by Qoliber
 *
 * @category    Qoliber
 * @package     Qoliber_PaymentRestrictions
 * @author      qoliber <info@qoliber.com>
 */

declare(strict_types = 1);

namespace Qoliber\PaymentRestrictions\Plugin;

use Magento\Quote\Api\CartRepositoryInterface;
use Magento\Quote\Api\PaymentMethodManagementInterface;
use Qoliber\PaymentRestrictions\Model\Config;

class AvailableMethodsFilterPlugin
{
    /**
     * @param \Qoliber\PaymentRestrictions\Model\Config $config
     * @param \Magento\Quote\Api\CartRepositoryInterface $quoteRepository
     */
    public function __construct(
        protected Config                  $config,
        protected CartRepositoryInterface $quoteRepository
    ) {
    }

    /**
     * After get list
     *
     * @param \Magento\Quote\Api\PaymentMethodManagementInterface $subject
     * @param mixed $result
     * @param mixed $cartId
     *
     * @return mixed
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function afterGetList(
        PaymentMethodManagementInterface $subject,
        $result,
        $cartId
    ) {
        /** @var \Magento\Quote\Model\Quote $quote */
        $quote = $this->quoteRepository->get($cartId);

        $shippingMethod = $quote->getShippingAddress()->getShippingMethod();
        if (!$shippingMethod) {
            return $result;
        }

        $carrierCode = explode('_', $shippingMethod)[0];

        $availablePaymentMethods =
            $this->config->getAvailablePaymentMethods($carrierCode);

        if (empty($availablePaymentMethods)) {
            return $result;
        }

        /** @var \Magento\Payment\Model\MethodInterface $paymentMethod */
        foreach ($result as $id => $paymentMethod) {
            if (!in_array(
                $paymentMethod->getCode(),
                $availablePaymentMethods
            )) {
                unset($result[$id]);
            }
        }

        return $result;
    }
}
