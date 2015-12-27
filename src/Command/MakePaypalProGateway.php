<?php namespace Anomaly\PaypalProGatewayExtension\Command;

use Anomaly\ConfigurationModule\Configuration\Contract\ConfigurationInterface;
use Anomaly\ConfigurationModule\Configuration\Contract\ConfigurationRepositoryInterface;
use Anomaly\EncryptedFieldType\EncryptedFieldTypePresenter;
use Anomaly\PaymentsModule\Gateway\Contract\GatewayInterface;
use Illuminate\Contracts\Bus\SelfHandling;
use Omnipay\PayPal\ProGateway;

/**
 * Class MakePaypalProGateway
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\PaypalProGatewayExtension\Command
 */
class MakePaypalProGateway implements SelfHandling
{

    /**
     * The gateway instance.
     *
     * @var GatewayInterface
     */
    protected $gateway;

    /**
     * Create a new MakePaypalProGateway instance.
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
            'anomaly.extension.paypal_pro_gateway::username',
            $this->gateway->getSlug()
        );
        $password  = $configuration->presenter(
            'anomaly.extension.paypal_pro_gateway::password',
            $this->gateway->getSlug()
        );
        $signature = $configuration->presenter(
            'anomaly.extension.paypal_pro_gateway::signature',
            $this->gateway->getSlug()
        );
        $mode      = $configuration->get(
            'anomaly.extension.paypal_pro_gateway::test_mode',
            $this->gateway->getSlug()
        );

        $gateway = new ProGateway();

        $gateway->setUsername($username->decrypted());
        $gateway->setPassword($password->decrypted());
        $gateway->setSignature($signature->decrypted());
        $gateway->setTestMode($mode->getValue());

        return $gateway;
    }
}
