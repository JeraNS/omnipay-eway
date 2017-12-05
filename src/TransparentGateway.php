<?php
/**
 * eWAY Rapid Transparent Redirect Gateway
 */

namespace Omnipay\Eway;

use Omnipay\Common\AbstractGateway;

/**
 * eWAY Rapid Transparent Redirect Gateway
 *
 * This class forms the gateway class for eWAY Rapid Transparent Redirect requests.
 * The gateway is just called Eway_Rapid as it was the first implemented.
 *
 * The eWAY Rapid gateways use an API Key and Password for authentication.
 *
 * There is also a test sandbox environment, which uses a separate endpoint and
 * API key and password. To access the eWAY Sandbox requires an eWAY Partner account.
 * https://myeway.force.com/success/partner-registration
 *
 *
 * @link https://eway.io/api-v3/#transparent-redirect
 * @link https://eway.io/api-v3/#authentication
 * @link https://go.eway.io/s/article/How-do-I-setup-my-Live-eWAY-API-Key-and-Password
 */
class TransparentGateway extends RapidGateway
{
    public $transparentRedirect = true;

    public function getName()
    {
        return 'eWAY Transparent Redirect';
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Eway\Message\TransparentPurchaseRequest', $parameters);
    }

    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Eway\Message\RapidCompletePurchaseRequest', $parameters);
    }

    public function refund(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Eway\Message\RefundRequest', $parameters);
    }

    /**
     * Store a credit card as a Token
     *
     * You can currently securely store card details with eWAY for future
     * charging using eWAY's Tokens.
     * After storing the card, pass the cardReference instead of the card
     * details to complete a payment.
     *
     * @link https://eway.io/api-v3/#create-token-customer
     * @param array $parameters
     * @return \Omnipay\Eway\Message\TransparentCreateCardRequest
     */
    public function createCard(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Eway\Message\TransparentCreateCardRequest', $parameters);
    }

    /**
     * Update a credit card stored as a Token
     *
     * You can currently securely store card details with eWAY for future
     * charging using eWAY's Tokens.
     * This resource requires the cardReference for the card to be updated.
     *
     * @link https://eway.io/api-v3/#update-token-customer
     * @param array $parameters
     * @return \Omnipay\Eway\Message\RapidDirectUpdateCardRequest
     */
    public function updateCard(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Eway\Message\RapidDirectUpdateCardRequest', $parameters);
    }
}
