<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng của bạn</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <h2 class="mb-4 fw-bold">Giỏ hàng</h2>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(count($cart) > 0)
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-0">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Giá</th>
                                <th style="width: 150px;">Số lượng</th>
                                <th>Thành tiền</th>
                                <th class="text-end">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $totalPrice = 0; @endphp
                            @foreach($cart as $id => $item)
                                @php 
                                    $subtotal = $item['price'] * $item['quantity'];
                                    $totalPrice += $subtotal;
                                @endphp
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if(!empty($item['image']))
                                                <img src="{{ asset('storage/' . $item['image']) }}" width="50" height="50" class="rounded me-3 object-fit-cover">
                                            @else
                                                <div class="bg-secondary text-white rounded d-flex align-items-center justify-content-center me-3" style="width:50px; height:50px;">No Image</div>
                                            @endif
                                            <span class="fw-bold">{{ $item['name'] }}</span>
                                        </div>
                                    </td>
                                    <td>{{ number_format($item['price'], 0, ',', '.') }} đ</td>
                                    <td>
                                        <form action="{{ route('cart.update') }}" method="POST" class="d-flex">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control form-control-sm me-2">
                                            <button type="submit" class="btn btn-sm btn-outline-secondary">Sửa</button>
                                        </form>
                                    </td>
                                    <td class="text-danger fw-bold">{{ number_format($subtotal, 0, ',', '.') }} đ</td>
                                    <td class="text-end">
                                        <form action="{{ route('cart.remove') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('home') }}" class="btn btn-outline-primary">&larr; Tiếp tục mua hàng</a>
                <div class="text-end">
                    <h4 class="fw-bold mb-3">Tổng tiền: <span class="text-danger">{{ number_format($totalPrice, 0, ',', '.') }} đ</span></h4>
                    <button class="btn btn-success btn-lg">Tiến hành thanh toán</button>
                </div>
            </div>
        @else
            <div class="text-center py-5 card border-0 shadow-sm">
                <h4 class="text-muted mb-3">Giỏ hàng của bạn đang trống!</h4>
                <div>
                    <a href="{{ route('home') }}" class="btn btn-primary">Quay lại mua sắm</a>
                </div>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>