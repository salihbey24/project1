<?php

namespace App\Console\Commands;

use App\Models\SubscriptionUser;
use App\Models\Transaction;
use Illuminate\Console\Command;

class RenewSubscriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:renew-subscriptions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Renew Subscriptions';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $subscriptions = SubscriptionUser::where('expired_at','<', now())->get();

        foreach ($subscriptions as $subscription) {
            $subscription->update(['expired_at' => now()->addMonth()],['renewed_at' => now()]);
            Transaction::create(['user_id' => $subscription->user_id , 'subscription_id' => $subscription->subscription_id, 'price' => $subscription->subscription->price]);
        }
    }
}
