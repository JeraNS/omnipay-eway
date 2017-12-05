<?php
/**
 * eWAY Rapid Purchase Request
 */

namespace Omnipay\Eway\Message;

/**
 * eWAY Rapid Purchase Request
 *
 * Creates a payment URL using eWAY's Transparent Redirect
 *
 * @link https://eway.io/api-v3/#transparent-redirect
 */
class TransparentPurchaseRequest extends RapidPurchaseRequest
{
    public function getData()
    {
        $this->validate('amount', 'returnUrl');

        $data = $this->getBaseData();
        $data['Method'] = 'TokenPayment';
        $data['TransactionType'] = $this->getTransactionType();
        $data['RedirectUrl'] = $this->getReturnUrl();

        $data['Payment'] = array();
        $data['Payment']['TotalAmount'] = $this->getAmountInteger();
        $data['Payment']['InvoiceNumber'] = $this->getTransactionId();
        $data['Payment']['InvoiceDescription'] = $this->getDescription();
        $data['Payment']['CurrencyCode'] = $this->getCurrency();
        $data['Payment']['InvoiceReference'] = $this->getInvoiceReference();

        if ($this->getItems()) {
            $data['Items'] = $this->getItemData();
        }

        return $data;
    }

    protected function getEndpoint()
    {
        return $this->getEndpointBase() . '/CreateAccessCode.json';
    }
}
