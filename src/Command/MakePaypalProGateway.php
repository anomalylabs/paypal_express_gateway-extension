<?php namespace Anomaly\PaypalExpressGatewayExtension\Command;

use Anomaly\ConfigurationModule\Configuration\Contract\ConfigurationInterface;
use Anomaly\ConfigurationModule\Configuration\Contract\ConfigurationRepositoryInterface;
use Anomaly\EncryptedFieldType\EncryptedFieldTypePresenter;
use Anomaly\PaymentsModule\Gateway\Contract\GatewayInterface;
use Illuminate\Contracts\Bus\SelfHandling;
use Omnipay\PayPal\ExpressGateway;

/**
 * Class MakePaypalExpressGateway
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\PaypalExpressGatewayExtension\Command
 */
class MakePaypalExpressGateway implements SelfHandling
{

    /**
     * The gateway instance.
     *
     * @var GatewayInterface
     */
    protected $gateway;

    /**
     * Create a new MakePaypalExpressGateway instance.
     *
     * @param GatewayInterface $gateway
     */
    public function __construct(GatewayInterface $gateway)
    {
        $this->gateway = $gateway;
    }

    /**
     * Handle the command.
     *
     * @param ConfigurationRepositoryInterface $configuration
     */
    public function handle(ConfigurationRepositoryInterface $configuration)
    {
        /* @var EncryptedFieldTypePresenter $username */
        /* @var EncryptedFieldTypePresenter $password */
        /* @var EncryptedFieldTypePresenter $signature */
        /* @var ConfigurationInterface $mode */
        $username  = $configuration->presenter(
            'anomaly.extension.paypal_express_gateway::username',
            $this->gateway->getSlug()
        );
        $password  = $configuration->presenter(
            'anomaly.extension.paypal_express_gateway::password',
            $this->gateway->getSlug()
        );
        $signature = $configuration->presenter(
            'anomaly.extension.paypal_express_gateway::signature',
            $this->gateway->getSlug()
        );
        $mode      = $configuration->get(
            'anomaly.extension.paypal_express_gateway::test_mode',
            $this->gateway->getSlug()
        );

        $gateway = new ExpressGateway();

        $gateway->setUsername($username->decrypted());
        $gateway->setPassword($password->decrypted());
        $gateway->setSignature($signature->decrypted());
        $gateway->setTestMode($mode->getValue());

        return $gateway;
    }
}
