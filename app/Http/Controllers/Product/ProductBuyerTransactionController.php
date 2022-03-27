<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductBuyerTransactionController extends ApiController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product, User $buyer)
    {
        $rules = [
            'quantity' => 'required|integer|min:1'
        ];

        $this->validate($request, $rules);

        if ($buyer->id == $product->seller_id) {
            return $this->errorResponse('El comprador debe ser diferente al vendedor', 409);
        }  
        if (!$buyer->isVerified()) {
            return $this->errorResponse('El comprador debe ser un usuario verificado', 409);
        }
        if (!$product->seller->isVerified()) {
            return $this->errorResponse('El vendedor debe ser un usuario verificado', 409);
        }
        if (!$product->isAvailable()) {
            return $this->errorResponse('El producto no está disponible para la compra', 409);
        }
        if ($product->quantity < $request->quantity) {
            return $this->errorResponse('La cantidad solicitada es mayor a la cantidad disponible', 409);
        } 

        return DB::transaction(function () use ($request, $product, $buyer) {
            $product->quantity -= $request->quantity;
            $product->save();

            $transaction = $product->transactions()->create([
                'quantity' => $request->quantity,
                'buyer_id' => $buyer->id,
                'product_id' => $product->id,
            ]);

            return $this->showOne($transaction, 201);
        });
        
    }

}
