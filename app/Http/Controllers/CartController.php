<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Hiển thị giao diện Giỏ hàng
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    // Xử lý thêm sản phẩm vào giỏ (Thích hợp cho AJAX)
    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = max(1, (int) $request->input('quantity', 1));
        
        $product = Product::find($productId);

        if (!$product) {
            return response()->json([
                'status' => 'error',
                'message' => 'Sản phẩm không tồn tại!'
            ], 404);
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'id'       => $product->id,
                'name'     => $product->name,
                'price'    => (float) $product->price,
                'quantity' => $quantity,
                'image'    => $product->image,
            ];
        }

        session()->put('cart', $cart);
        $totalCount = array_sum(array_column($cart, 'quantity'));

        return response()->json([
            'status'    => 'success',
            'message'   => 'Đã thêm "' . $product->name . '" vào giỏ hàng!',
            'cartCount' => $totalCount
        ]);
    }

    // Cập nhật số lượng sản phẩm trong giỏ
    public function updateCart(Request $request)
    {
        $cart = session()->get('cart', []);
        $id = $request->input('id');
        $quantity = max(1, (int) $request->input('quantity', 1));

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $quantity;
            session()->put('cart', $cart);
            return response()->json([
                'status' => 'success',
                'message' => 'Đã cập nhật số lượng!'
            ]);
        }

        return response()->json([
            'status' => 'error', 
            'message' => 'Không tìm thấy sản phẩm trong giỏ!'
        ], 400);
    }

    // Xóa sản phẩm khỏi giỏ
    public function removeFromCart(Request $request)
    {
        $cart = session()->get('cart', []);
        $id = $request->input('id');

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            return response()->json([
                'status' => 'success',
                'message' => 'Đã xóa sản phẩm thành công!'
            ]);
        }

        return response()->json([
            'status' => 'error', 
            'message' => 'Không tìm thấy sản phẩm!'
        ], 400);
    }
}