# PhoneAuthentication | Magento 2 Module

**PhoneAuthentication** module make user login/sign up only via phone number.
### Setup:
Create "Customer" folder in app/code path, then upload module in created folder.
### Important:
Before remove/uninstall module, please run follow command in you DB:

``UPDATE `eav_attribute` SET `is_required` = '1' WHERE `attribute_code` IN ('firstname', 'lastname');
``
