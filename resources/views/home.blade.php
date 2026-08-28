<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ShopLoaVip - Cửa Hàng Loa Bluetooth Chính Hãng</title>
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #f8f9fa; color: #333; }
        
        /* Main Header - Tone Đỏ Đậm */
        .main-header { background: #e31010; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 10px rgba(0,0,0,0.15); }
        .logo a { color: #fff; font-size: 1.6em; font-weight: 800; text-decoration: none; text-transform: uppercase; letter-spacing: 1px; display: flex; align-items: center; gap: 10px; }
        
        .menu-items { display: flex; align-items: center; gap: 18px; }
        .menu-items a, .menu-items button.btn-logout { color: #fff; text-decoration: none; font-weight: 600; font-size: 0.95em; transition: 0.2s; display: flex; align-items: center; gap: 6px; background: none; border: none; cursor: pointer; }
        .menu-items a:hover, .menu-items button.btn-logout:hover { color: #ffeb3b; }
        
        .cart-badge { background: #fff; color: #e31010; padding: 2px 7px; border-radius: 12px; font-size: 0.8em; font-weight: bold; }
        .admin-nav { background: #ffeb3b; color: #000 !important; padding: 5px 10px; border-radius: 4px; font-weight: bold; }
        .admin-nav:hover { background: #fff !important; }

        /* Container Layout */
        .container { max-width: 1200px; margin: 30px auto; padding: 0 15px; }
        .section-title { font-size: 1.4em; font-weight: bold; text-transform: uppercase; margin-bottom: 20px; border-left: 5px solid #e31010; padding-left: 10px; color: #222; display: flex; align-items: center; gap: 10px; }
        
        /* Product Grid */
        .product-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 20px; }
        .product-card { background: #fff; border: 1px solid #eee; border-radius: 8px; overflow: hidden; transition: all 0.3s ease; display: flex; flex-direction: column; justify-content: space-between; position: relative; }
        .product-card:hover { transform: translateY(-5px); box-shadow: 0 8px 20px rgba(0,0,0,0.1); border-color: #e31010; }
        
        .product-img-link { display: block; text-align: center; background: #fff; padding: 15px; }
        .product-img { width: 100%; height: 180px; object-fit: contain; }
        .product-info { padding: 15px; text-align: center; }
        .product-title { font-size: 1em; font-weight: 700; margin-bottom: 8px; height: 40px; overflow: hidden; }
        .product-title a { text-decoration: none; color: #222; transition: 0.2s; }
        .product-title a:hover { color: #e31010; }
        .product-cat { font-size: 0.8em; color: #888; margin-bottom: 10px; }
        .product-price { color: #e31010; font-size: 1.15em; font-weight: 800; margin-bottom: 15px; }
        
        .btn-add { background: #e31010; color: #fff; border: none; padding: 10px; width: 100%; border-radius: 4px; font-weight: bold; cursor: pointer; transition: 0.2s; display: flex; align-items: center; justify-content: center; gap: 8px; }
        .btn-add:hover { background: #b80a0a; }
        .btn-add:disabled { background: #ccc; cursor: not-allowed; }
    </style>
</head>
<body>

<div class="main-header">
    <div class="logo">
        <a href="{{ route('home') }}"><i class="fa-solid fa-volume-high"></i> ShopLoaVip</a>
    </div>
    
    <div class="menu-items">
        <a href="{{ route('home') }}"><i class="fa-solid fa-house"></i> Trang chủ</a>

        <a href="{{ route('admin.products.index') }}" class="admin-nav">
            <i class="fa-solid fa-sliders"></i> Quản lý Sản phẩm
        </a>
        <a href="{{ route('categories.index') }}" class="admin-nav">
            <i class="fa-solid fa-list"></i> Quản lý Danh mục
        </a>

        <a href="{{ route('cart.index') }}">
            <i class="fa-solid fa-cart-shopping"></i> Giỏ hàng 
            <span class="cart-badge" id="cart-count">{{ array_sum(array_column(session('cart', []), 'quantity')) }}</span>
        </a>

        @auth
            <a href="#"><i class="fa-solid fa-user"></i> {{ Auth::user()->name }}</a>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn-logout"><i class="fa-solid fa-right-from-bracket"></i> Đăng xuất</button>
            </form>
        @else
            <a href="{{ route('login') }}"><i class="fa-solid fa-user"></i> Đăng nhập</a>
            <a href="{{ route('register') }}"><i class="fa-solid fa-user-plus"></i> Đăng ký</a>
        @endauth
    </div>
</div>

<div class="container">
    <div class="section-title"><i class="fa-solid fa-bolt"></i> Loa Bluetooth Nổi Bật</div>

    <div class="product-grid">
        @forelse($products as $product)
            <div class="product-card">
                <a href="{{ route('products.show', $product->id) }}" class="product-img-link">
                    @php
                        if ($product->image) {
                            $imgSrc = str_starts_with($product->image, 'http') ? $product->image : asset('storage/' . $product->image);
                        } else {
                            $imgSrc = 'https://placehold.co/200x200?text=ShopLoaVip';
                        }
                    @endphp
                    <img src="{{ $imgSrc }}" class="product-img" alt="{{ $product->name }}" onerror="this.onerror=null;this.src='https://placehold.co/200x200?text=ShopLoaVip';">
                </a>
                
                <div class="product-info">
                    <div class="product-title">
                        <a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a>
                    </div>
                    <div class="product-cat"><i class="fa-solid fa-tag"></i> {{ $product->category->name ?? 'Mặc định' }}</div>
                    <div class="product-price">{{ number_format($product->price) }} đ</div>
                    
                    <button class="btn-add btn-add-cart" data-id="{{ $product->id }}">
                        <i class="fa-solid fa-cart-plus"></i> Thêm vào giỏ
                    </button>
                </div>
            </div>
        @empty
            <p>Chưa có sản phẩm nào.</p>
        @endforelse
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    document.querySelectorAll('.btn-add-cart').forEach(button => {
        button.addEventListener('click', function () {
            const productId = this.getAttribute('data-id');
            const btn = this;
            btn.disabled = true;

            fetch("{{ route('cart.add') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ product_id: productId, quantity: 1 })
            })
            .then(res => {
                if (!res.ok) {
                    throw new Error('Lỗi từ server hoặc sản phẩm không tồn tại!');
                }
                return res.json();
            })
            .then(data => {
                if (data.status === 'success') {
                    document.getElementById('cart-count').innerText = data.cartCount;
                    alert(data.message);
                } else {
                    alert(data.message || 'Thêm thất bại!');
                }
            })
            .catch(error => {
                console.error('Lỗi:', error);
                alert('Có lỗi xảy ra, vui lòng thử lại!');
            })
            .finally(() => {
                btn.disabled = false;
            });
        });
    });
});
</script>
</body>
</html>