<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Giỏ hàng của bạn</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: Arial, sans-serif; }
        body { background-color: #f4f4f9; padding: 30px; }
        .container { max-width: 900px; margin: 0 auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        h2 { margin-bottom: 20px; color: #2c3e50; }
        a { color: #3498db; text-decoration: none; display: inline-block; margin-bottom: 15px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: center; }
        th { background-color: #f8f9fa; color: #333; }
        input[type="number"] { width: 60px; padding: 5px; text-align: center; }
        .btn-danger { background: #e74c3c; color: white; border: none; padding: 6px 12px; cursor: pointer; border-radius: 4px; }
        .btn-danger:hover { background: #c0392b; }
        .total-box { text-align: right; margin-top: 20px; font-size: 1.2em; font-weight: bold; color: #2c3e50; }
    </style>
</head>
<body>

<div class="container">
    <a href="{{ route('home') }}">← Tiếp tục mua sắm</a>
    <h2>Giỏ hàng của bạn</h2>

    <table>
        <thead>
            <tr>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @forelse($cart as $id => $item)
                @php 
                    $subtotal = $item['price'] * $item['quantity'];
                    $total += $subtotal; 
                @endphp
                <tr id="row-{{ $id }}">
                    <td>{{ $item['name'] }}</td>
                    <td>{{ number_format($item['price']) }} VNĐ</td>
                    <td>
                        <input type="number" value="{{ $item['quantity'] }}" min="1" onchange="updateCart({{ $id }}, this.value)">
                    </td>
                    <td>{{ number_format($subtotal) }} VNĐ</td>
                    <td>
                        <button class="btn-danger" onclick="removeItem({{ $id }})">Xóa</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Giỏ hàng đang trống.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="total-box">
        Tổng tiền thanh toán: {{ number_format($total) }} VNĐ
    </div>
</div>

<script>
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

function updateCart(id, quantity) {
    if (quantity < 1) return;
    fetch('/cart/update', {
        method: 'POST',
        headers: { 
            'Content-Type': 'application/json', 
            'X-CSRF-TOKEN': csrfToken 
        },
        body: JSON.stringify({ id: id, quantity: quantity })
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success') {
            location.reload();
        }
    })
    .catch(err => console.error(err));
}

function removeItem(id) {
    if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?')) {
        fetch('/cart/remove', {
            method: 'POST',
            headers: { 
                'Content-Type': 'application/json', 
                'X-CSRF-TOKEN': csrfToken 
            },
            body: JSON.stringify({ id: id })
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                location.reload();
            }
        })
        .catch(err => console.error(err));
    }
}
</script>

</body>
</html>