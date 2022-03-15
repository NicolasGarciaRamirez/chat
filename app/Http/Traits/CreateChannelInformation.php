<?php

namespace App\Http\Traits;

use App\Models\Channel\MonthlyGoal;
use App\Models\Payments\PaymentMethodsInformation;
use App\Models\Payments\PaymentsBilingInformation;
use App\Models\User\UserChannelInformation;
use App\Models\User\UserTiersInformation;
use Illuminate\Http\Request;

trait CreateChannelInformation {

    /**
     * @var \Stripe\StripeClient
     */
    private $stripe;

    /**
     * @var string[]
     */
    private $currencies;

    /**
     * @var
     */
    private $price;

    /**
     * @var
     */
    private $product;

    private $user;

    public function __construct()
    {
    //     \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    //     $this->stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $this->currencies = array('USD','GBP','EUR');

    }

    /**
     * Does very basic image validity checking and stores it. Redirects back if somethings wrong.
     * @Notice: This is not an alternative to the model validation for this field.
     *
     * @param Request $request
     * @return $this|false|string
     */
    public function saveChannelInformation($user ,$request)
    {
        $this->user = $user;

        $monthly = new \App\Models\Channel\MonthlyGoal(\Arr::except($request->channel_information['monthly_goal_last'], ['date_end','percentage_completed']));
        $channel = new \App\Models\User\UserChannelInformation(\Arr::except($request->channel_information, ['monthly_goal_last']));
        $this->user->channel_information()->save($channel);
        $channel->monthly_goal()->save($monthly);

        collect($request->channel_information['tiers'])->each(function ($query) use ($channel){
            $this->product = $this->stripe->products->create([
                'name' => $query['name'],
            ]);

            $tier = new UserTiersInformation();
            $tier->name = $query['name'];
            $tier->description = $query['description'];
            $tier->amount = $query['amount'];
            $tier->channel_id = $channel->id;
            $tier->save();

            $this->price = $this->stripe->prices->create([
                'unit_amount' => number_format($query['amount'], '2', '', ''),
                'currency' => $this->currencies[0],
                'recurring' => ['interval' => 'month'],
                'product' => $this->product->id,
                'metadata' => [
                    'tier_id' => $tier['id'],
                    'username' => $this->user->username,
                    'status' => 'active',
                    'currency' => $this->currencies[0]
                ]
            ]);
            $this->price = $this->stripe->prices->create([
                'unit_amount' => number_format($query['amount'], '2', '', ''),
                'currency' => $this->currencies[1],
                'recurring' => ['interval' => 'month'],
                'product' => $this->product->id,
                'metadata' => [
                    'tier_id' => $tier['id'],
                    'username' => $this->user->username,
                    'status' => 'active',
                    'currency' => $this->currencies[1]
                ]
            ]);
            $this->price = $this->stripe->prices->create([
                'unit_amount' => number_format($query['amount'], '2', '', ''),
                'currency' => $this->currencies[2],
                'recurring' => ['interval' => 'month'],
                'product' => $this->product->id,
                'metadata' => [
                    'tier_id' => $tier['id'],
                    'username' => $this->user->username,
                    'status' => 'active',
                    'currency' => $this->currencies[2]
                ]
            ]);

        });
    }

}
