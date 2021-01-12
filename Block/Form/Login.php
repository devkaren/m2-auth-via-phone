<?php
namespace Customer\PhoneAuthentication\Block\Form;

class Login extends \Magento\Customer\Block\Form\Login
{

    /**
     * Get form action URL for POST booking request
     *
     * @return string
     */
    public function getFormActionUrl()
    {
        return $this->_customerUrl->getLoginPostUrl();
    }
}
