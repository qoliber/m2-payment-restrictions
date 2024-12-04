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

class AddPaymentMethodListenerPlugin
{
    /**
     * After get listeners
     *
     * @param mixed $subject
     * @param mixed $result
     *
     * @return array<mixed>
     */
    public function afterGetListeners($subject, $result): array
    {
        $result['shipping_method_selected'] = 'refresh';
        return $result;
    }
}
