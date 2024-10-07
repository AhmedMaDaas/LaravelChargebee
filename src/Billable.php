<?php
namespace TijmenWierenga\LaravelChargebee;


/**
 * Class Billable
 * @package TijmenWierenga\LaravelChargebee
 */
trait Billable
{
    /**
     * @param null $plan
     * @return Subscriber
     */
    public function subscription($plan = null, $config = null, $prices = null)
    {
        return new Subscriber($this, $plan, $config, $prices);
    }

    /**
     * @return mixed
     */
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}