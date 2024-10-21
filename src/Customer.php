<?php
namespace TijmenWierenga\LaravelChargebee;

use ChargeBee\ChargeBee\Environment as ChargeBee_Environment;
use ChargeBee\ChargeBee\Models\Customer as ChargeBee_Customer;
use Illuminate\Database\Eloquent\Model;
use TijmenWierenga\LaravelChargebee\Exceptions\MissingCustomerDetailsException;
use TijmenWierenga\LaravelChargebee\Exceptions\UserMismatchException;

/**
 * Class Subscriber
 * @package TijmenWierenga\LaravelChargebee
 */
class Customer
{
    /**
     * Configuration settings.
     *
     * @var array
     */
    protected $config;

    /**
     * Customer Details.
     *
     * @var array
     */
    protected $customerDetails;

    /**
     * @param Model|null $model
     * @param null $customerDetails
     */
    public function __construct(Model $model = null, array $customerDetails = null, array $config = null)
    {
        // Set up Chargebee environment keys
        ChargeBee_Environment::configure(getenv('CHARGEBEE_SITE'), getenv('CHARGEBEE_KEY'));

        $this->customerDetails = $customerDetails;

        // Set config settings.
        $this->config = ($config) ?: $this->getDefaultConfig();
    }

    /**
     * @return array
     * @throws MissingCustomerDetailsException
     */
    public function create()
    {
        if (! $this->customerDetails) throw new MissingCustomerDetailsException('No details was set to assign to the customer.');

        $result = ChargeBee_Customer::create($this->customerDetails);

        return $result->customer();
    }

    /**
     * @return mixed|null
     */
    private function getDefaultConfig()
    {
        if (getenv('APP_ENV') === 'testing') return null;

        return config('chargebee');
    }
}