<?php
/**
 * Created by Qoliber
 *
 * @author      qoliber <info@qoliber.com>
 */

declare(strict_types = 1);

use Magento\Framework\Component\ComponentRegistrar;

ComponentRegistrar::register(
    ComponentRegistrar::MODULE,
    'Qoliber_PaymentRestrictions',
    __DIR__
);
