<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartProduct;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserCartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $products = DB::table('cart_products')
            ->select([
                'cart_id',
                'product_id',
                'products.title',
                DB::raw('CAST(SUM(products.price) AS FLOAT) AS total_price'),
                DB::raw('COUNT(products.id) AS quantity')
            ])
            ->join('products', 'products.id', '=', 'cart_products.product_id')
            ->join('carts', 'cart_products.cart_id', '=', 'carts.id')
            ->where('carts.user_id', Auth::id())
            ->groupBy('cart_id', 'product_id', 'products.title')
            ->get();

        $total = 0;
        foreach ($products as $product) {
            $total += $product->total_price;
        }

        return [
            'products' => $products,
            'total' => $total,
        ];
    }

    /**
     * Adds new product to the users cart
     *
     * @param Request $request
     * @return Response
     */
    public function addProduct(Request $request)
    {
        $request->validate(['product_id' => 'required|integer|exists:products,id']);

        $cart = Cart::where('user_id', Auth::id())->firstOrFail();
        $addedProducts = DB::table('cart_products')
            ->where('cart_id', $cart->id)
            ->count();

        if ($addedProducts > 2) {
            abort(422, 'You cannot add more than 3 products.');
        }

        return (new CartProduct([
            'product_id' => $request->get('product_id'),
            'cart_id' => $cart->id,
        ]))->save();
    }

    /**
     * Removes product from the users cart
     *
     * @param int $productId
     * @return Response
     */
    public function deleteProduct($productId)
    {
        $cart = Cart::where('user_id', Auth::id())->firstOrFail();
        $cartProduct = CartProduct::where('cart_id', $cart->id)
            ->where('product_id', $productId)
            ->firstOrFail();

        return CartProduct::destroy($cartProduct->id);
    }
}
