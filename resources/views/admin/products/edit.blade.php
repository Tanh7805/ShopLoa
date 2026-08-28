<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4" style="max-width: 700px;">
    <h3 class="fw-bold mb-4">Cập nhật sản phẩm #{{ $product->id }}</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label fw-bold">Tên sản phẩm (*)</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Danh mục (*)</label>
            <select name="category_id" class="form-select" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Giá bán (VNĐ) (*)</label>
            <input type="number" name="price" class="form-control" value="{{ old('price', $product->price) }}" min="0" step="1000" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Hình ảnh sản phẩm</label>
            @if($product->image)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $product->image) }}" width="100" class="img-thumbnail">
                </div>
            @endif
            <input type="file" name="image" class="form-control" accept="image/*">
            <small class="text-muted">Bỏ trống nếu giữ nguyên ảnh cũ.</small>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Mô tả sản phẩm</label>
            <textarea name="description" class="form-control" rows="4">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Hủy</a>
            <button type="submit" class="btn btn-warning">Cập nhật</button>
        </div>
    </form>
</div>
</body>
</html>