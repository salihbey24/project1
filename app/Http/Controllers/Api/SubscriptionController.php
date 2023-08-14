<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserSubscribeResource;
use App\Models\Subscription;
use App\Models\User;
use App\Http\Requests\StoreSubscriptionRequest;
use App\Http\Requests\UpdateSubscriptionRequest;

class SubscriptionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubscriptionRequest $request, Int $id)
    {
        $data = $request->validated();
        $user = User::find($id);
        if(!$user){
            return response([
                'message' => 'user not found'
            ],404);
        }

        $subscription = Subscription::first(); // Varsayılan abonelik

        $user->subscriptions()->attach($subscription->id, $data);

        return response([
            'message' => 'subscription added',
        ],201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubscriptionRequest $request,  Int $id, Int $subscription_id)
    {
        $data = $request->validated();

        $user = User::find($id);
        if(!$user){
            return response([
                'message' => 'user not found'
            ],404);
        }

        $user->subscriptions()->updateExistingPivot($subscription_id, $data);
        return response([
            'message' => 'subscription updated',
        ],201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Int $id)
    {
        $user = User::find($id);
        if(!$user){
            return response([
                'message' => 'user not found'
            ],404);
        }

        $user->subscriptions()->detach();
        return response('',204);
    }
}
