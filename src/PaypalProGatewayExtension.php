<?php namespace Anomaly\PaypalExpressGatewayExtension;

use Anomaly\PaymentsModule\Gateway\Contract\GatewayInterface;
use Anomaly\PaymentsModule\Gateway\GatewayExtension;
use Anomaly\PaypalExpressGatewayExtension\Command\MakePaypalExpressGateway;
use Omnipay\Common\AbstractGateway;

/**
 * Class PaypalExpressGatewayExtension
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\PaypalExpressGatewayExtension
 */
class PaypalExpressGatewayExtension extends GatewayExtension
{

    /**
     * This extension provides the PayPal
     * payment gateway for the Payments module.
     *
     * @var null|string
     */
    protected $provides = 'anomaly.module.payments::gateway.paypal_express';

    /**
     * Return an Omnipay gateway.
     *
     * @param GatewayInterface $gateway
     * @return AbstractGateway
     * @throws \Exception
     */
    public function make(GatewayInterface $gateway)
    {
        return $this->dispatch(new MakePaypalExpressGateway($gateway));
    }
}
