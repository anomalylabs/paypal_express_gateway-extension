<?php namespace Anomaly\PaypalProGatewayExtension;

use Anomaly\PaymentsModule\Gateway\Contract\GatewayInterface;
use Anomaly\PaymentsModule\Gateway\GatewayExtension;
use Anomaly\PaypalProGatewayExtension\Command\MakePaypalProGateway;
use Omnipay\Common\AbstractGateway;

/**
 * Class PaypalProGatewayExtension
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\PaypalProGatewayExtension
 */
class PaypalProGatewayExtension extends GatewayExtension
{

    /**
     * This extension provides the PayPal
     * payment gateway for the Payments module.
     *
     * @var null|string
     */
    protected $provides = 'anomaly.module.payments::gateway.paypal_pro';

    /**
     * Return an Omnipay gateway.
     *
     * @param GatewayInterface $gateway
     * @return AbstractGateway
     * @throws \Exception
     */
    public function make(GatewayInterface $gateway)
    {
        return $this->dispatch(new MakePaypalProGateway($gateway));
    }
}
