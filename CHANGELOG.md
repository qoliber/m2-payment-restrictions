# Changelog

All notable changes to the Qoliber Payment Restrictions module will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/).

## [1.0.0] - 2024-08-01

### Added
- Initial release of Payment Restrictions module (QM-72)
- Implemented payment method filtering based on selected shipping method
- Created Config model (Model/Config.php) for managing payment restriction configuration
- Implemented AvailablePaymentMethods source model (Model/Config/Source/AvailablePaymentMethods.php)
- Provides list of all available payment methods for admin configuration
- Created AvailableMethodsFilterPlugin (Plugin/AvailableMethodsFilterPlugin.php)
- Intercepts PaymentMethodManagement::getList() to filter payment methods
- Filters payment options based on shipping carrier code selected in quote
- Returns only allowed payment methods for the chosen shipping method
- Implemented AddPaymentMethodListenerPlugin for payment method event handling
- Created AddFilterField plugin (Plugin/Config/AddFilterField.php) for system configuration
- Added system configuration options for defining payment-to-shipping restrictions
- Admin can configure which payment methods are available for each shipping carrier
- Configuration stored per shipping carrier code
- Module automatically extracts carrier code from quote shipping method
- Supports multiple payment methods per shipping carrier
- Works seamlessly with checkout process
- Set up PSR-4 autoloading for Qoliber\PaymentRestrictions namespace
- Set source repository to git@github.com:qoliber/m2-payment-restrictions.git
- Licensed under MIT open source license

### Use Cases
- Restrict cash on delivery to specific shipping methods
- Limit credit card payments to express shipping only
- Configure payment methods per shipping carrier (UPS, FedEx, USPS, etc.)
- Enforce business rules for payment-shipping combinations
- Improve checkout experience by showing only relevant payment options
