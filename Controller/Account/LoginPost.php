<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Customer\PhoneAuthentication\Controller\Account;

use Magento\Customer\Api\AccountManagementInterface;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Response\Http as ResponseHttp;
use  Magento\Framework\Data\Form\FormKey\Validator;
use Magento\Framework\Message\ManagerInterface;

class LoginPost
{
    /**
     * @var Session
     */
    protected $session;

    /** @var Validator */
    protected $formKeyValidator;

    /** @var CustomerRepositoryInterface */
    protected $customerRepositoryInterface;

    /** @var ManagerInterface **/
    protected $messageManager;

    /** @var Http **/
    protected $responseHttp;

    protected $currentCustomer;

    /** @var AccountManagementInterface */
    protected $customerAccountManagement;

    public function __construct(
        Session $customerSession,
        Validator $formKeyValidator,
        CustomerRepositoryInterface $customerRepositoryInterface,
        ManagerInterface $messageManager,
        ResponseHttp $responseHttp,
        AccountManagementInterface $customerAccountManagement
    ) {
        $this->session = $customerSession;
        $this->formKeyValidator = $formKeyValidator;
        $this->customerRepositoryInterface = $customerRepositoryInterface;
        $this->messageManager = $messageManager;
        $this->responseHttp = $responseHttp;
        $this->customerAccountManagement = $customerAccountManagement;
    }

    public function aroundExecute(\Magento\Customer\Controller\Account\LoginPost $loginPost, \Closure $proceed)
    {
        die('as');
    }

    /**
     * @param $email
     * @return \Magento\Customer\Api\Data\CustomerInterface
     */
    public function getCustomer($email)
    {
        $this->currentCustomer = $this->customerRepositoryInterface->get($email);
        return $this->currentCustomer;
    }
    /**
     * Check if customer is a vendor and account is approved
     * @return bool
     */
    public function isAVendorAndAccountNotApproved($customer)
    {
        $isVendor = $customer->getCustomAttribute('is_vendor')->getValue();
        $isApprovedAccount = $customer->getCustomAttribute('approve_account')->getValue();
        if ($isVendor && !$isApprovedAccount) {
            return true;
        }
        return false;
    }
}
