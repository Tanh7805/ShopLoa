<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - ShopLoaVip</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <a href="{{ route('home') }}" class="btn btn-outline-secondary mb-4">← Quay lại trang chủ</a>

        <div class="card shadow-sm mb-5">
            <div class="row g-0">
                <div class="col-md-5 p-4 text-center border-end">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded max-h-400">
                    @else
                        <div class="bg-secondary text-white py-5 rounded">Không có hình ảnh</div>
                    @endif
                </div>
                <div class="col-md-7">
                    <div class="card-body p-4">
                        <span class="badge bg-primary mb-2">{{ $product->category->name ?? 'Chưa phân loại' }}</span>
                        <h2 class="card-title fw-bold mb-3">{{ $product->name }}</h2>
                        <h3 class="text-danger fw-bold mb-4">{{ number_format($product->price, 0, ',', '.') }} đ</h3>
                        
                        <h5 class="fw-bold">Mô tả sản phẩm:</h5>
                        <p class="card-text text-muted mb-4">{{ $product->description ?? 'Chưa có mô tả chi tiết cho sản phẩm này.' }}</p>
                        
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success btn-lg w-100 fw-bold">Thêm vào giỏ hàng</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if($relatedProducts->count() > 0)
            <h4 class="fw-bold mb-3">Sản phẩm liên quan</h4>
            <div class="row">
                @foreach($relatedProducts as $related)
                    <div class="col-md-3 mb-3">
                        <div class="card h-100 shadow-sm">
                            @if($related->image)
                                <img src="{{ asset('storage/' . $related->image) }}" class="card-img-top" alt="{{ $related->name }}" style="height: 180px; object-fit: cover;">
                            @endif
                            <div class="card-body d-flex flex-column">
                                <h6 class="card-title fw-bold">{{ $related->name }}</h6>
                                <p class="card-text text-danger fw-bold mt-auto">{{ number_format($related->price, 0, ',', '.') }} đ</p>
                                <a href="{{ route('products.show', $related->id) }}" class="btn btn-sm btn-outline-primary w-100">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>