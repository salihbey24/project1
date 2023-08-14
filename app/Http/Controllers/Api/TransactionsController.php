<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransactionRequest;
use App\Models\User;

class TransactionsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionRequest $request, Int $id)
    {
        $data = $request->validated();
        $user = User::find($id);
        if(!$user){
            return response([
                'message' => 'user not found'
            ],404);
        }

        $user->transactions()->create($data);

        return response([
            'message' => 'transaction added',
        ],201);
    }
}
