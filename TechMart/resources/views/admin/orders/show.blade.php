@extends('layouts.admin')

@section('title', 'Chi tiết đơn hàng #' . $order->order_id)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="mt-4">Chi tiết đơn hàng #{{ $order->order_id }}</h1>
    <div>
        <button class="btn btn-success me-2" onclick="printOrder()">
            <i class="fas fa-print me-2"></i>In đơn hàng
        </button>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Quay lại
        </a>
    </div>
</div>

<div class="row">
    <!-- Order Info -->
    <div class="col-lg-8">
        <!-- Order Status -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-info-circle me-2"></i>Thông tin đơn hàng
                </h5>
                @php
                    $statusClasses = [
                        'pending' => 'bg-warning text-dark',
                        'processing' => 'bg-info',
                        'shipped' => 'bg-primary',
                        'delivered' => 'bg-success',
                        'cancelled' => 'bg-danger'
                    ];
                    $statusTexts = [
                        'pending' => 'Chờ xử lý',
                        'processing' => 'Đang xử lý',
                        'shipped' => 'Đã gửi',
                        'delivered' => 'Đã giao',
                        'cancelled' => 'Đã hủy'
                    ];
                @endphp
                <span class="badge {{ $statusClasses[$order->status] ?? 'bg-secondary' }} fs-6">
                    {{ $statusTexts[$order->status] ?? ucfirst($order->status) }}
                </span>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Mã đơn hàng:</strong> #{{ $order->order_id }}</p>
                        <p><strong>Ngày đặt:</strong> {{ $order->order_date->format('d/m/Y H:i') }}</p>
                        <p><strong>Tổng tiền:</strong> <span class="text-success fw-bold">${{ number_format($order->total_amount, 2) }}</span></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Phương thức thanh toán:</strong> {{ ucfirst($order->payment_method ?? 'Chưa xác định') }}</p>
                        <p><strong>Trạng thái thanh toán:</strong> 
                            <span class="badge bg-{{ $order->payment_status === 'paid' ? 'success' : 'warning' }}">
                                {{ $order->payment_status === 'paid' ? 'Đã thanh toán' : 'Chưa thanh toán' }}
                            </span>
                        </p>
                        <p><strong>Ghi chú:</strong> {{ $order->notes ?? 'Không có ghi chú' }}</p>
                    </div>
                </div>

                @if($order->status !== 'delivered' && $order->status !== 'cancelled')
                    <hr>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-warning" onclick="updateStatus({{ $order->order_id }}, '{{ $order->status }}')">
                            <i class="fas fa-edit me-2"></i>Cập nhật trạng thái
                        </button>
                    </div>
                @endif
            </div>
        </div>

        <!-- Order Items -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-shopping-cart me-2"></i>Sản phẩm đã đặt
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Biến thể</th>
                                <th>Đơn giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->orderItems as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($item->product->image_url)
                                                <img src="{{ asset('storage/' . $item->product->image_url) }}" 
                                                     alt="{{ $item->product->name }}" 
                                                     class="rounded me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                            @else
                                                <div class="bg-light rounded me-3 d-flex align-items-center justify-content-center" 
                                                     style="width: 50px; height: 50px;">
                                                    <i class="fas fa-image text-muted"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <div class="fw-bold">{{ $item->product->name }}</div>
                                                <small class="text-muted">SKU: {{ $item->product->product_id }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if($item->productVariant)
                                            <span class="badge bg-secondary">{{ $item->productVariant->variant_name }}</span>
                                        @else
                                            <span class="text-muted">Mặc định</span>
                                        @endif
                                    </td>
                                    <td>${{ number_format($item->price, 2) }}</td>
                                    <td>
                                        <span class="badge bg-primary">{{ $item->quantity }}</span>
                                    </td>
                                    <td>
                                        <strong>${{ number_format($item->price * $item->quantity, 2) }}</strong>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <th colspan="4" class="text-end">Tổng cộng:</th>
                                <th class="text-success">${{ number_format($order->total_amount, 2) }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Customer Info -->
    <div class="col-lg-4">
        <!-- Customer Details -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-user me-2"></i>Thông tin khách hàng
                </h5>
            </div>
            <div class="card-body">
                <div class="text-center mb-3">
                    <div class="avatar-lg mx-auto mb-2">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" 
                             style="width: 60px; height: 60px; font-size: 1.5rem;">
                            {{ strtoupper(substr($order->user->name, 0, 1)) }}
                        </div>
                    </div>
                    <h6 class="mb-1">{{ $order->user->name }}</h6>
                    @if($order->user->role === 'admin')
                        <span class="badge bg-danger">Quản trị viên</span>
                    @else
                        <span class="badge bg-primary">Khách hàng</span>
                    @endif
                </div>

                <div class="text-start">
                    <p class="mb-2">
                        <i class="fas fa-envelope me-2 text-muted"></i>
                        <a href="mailto:{{ $order->user->email }}">{{ $order->user->email }}</a>
                    </p>
                    
                    @if($order->user->phone)
                        <p class="mb-2">
                            <i class="fas fa-phone me-2 text-muted"></i>
                            <a href="tel:{{ $order->user->phone }}">{{ $order->user->phone }}</a>
                        </p>
                    @endif
                    
                    <p class="mb-2">
                        <i class="fas fa-calendar me-2 text-muted"></i>
                        Tham gia: {{ $order->user->created_at->format('d/m/Y') }}
                    </p>
                    
                    <p class="mb-0">
                        <i class="fas fa-shopping-cart me-2 text-muted"></i>
                        Tổng đơn hàng: {{ $order->user->orders->count() }}
                    </p>
                </div>

                <hr>

                <div class="d-grid">
                    <a href="{{ route('admin.users.show', $order->user) }}" class="btn btn-outline-primary">
                        <i class="fas fa-user me-2"></i>Xem hồ sơ khách hàng
                    </a>
                </div>
            </div>
        </div>

        <!-- Shipping Address -->
        @if($order->shipping_address)
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-map-marker-alt me-2"></i>Địa chỉ giao hàng
                </h5>
            </div>
            <div class="card-body">
                <p class="mb-0">{{ $order->shipping_address }}</p>
            </div>
        </div>
        @endif

        <!-- Order Timeline -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-history me-2"></i>Lịch sử đơn hàng
                </h5>
            </div>
            <div class="card-body">
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-marker bg-success"></div>
                        <div class="timeline-content">
                            <h6 class="timeline-title">Đơn hàng được tạo</h6>
                            <p class="timeline-text">{{ $order->order_date->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                    
                    @if($order->status !== 'pending')
                        <div class="timeline-item">
                            <div class="timeline-marker bg-info"></div>
                            <div class="timeline-content">
                                <h6 class="timeline-title">Đang xử lý</h6>
                                <p class="timeline-text">{{ $order->updated_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    @endif
                    
                    @if(in_array($order->status, ['shipped', 'delivered']))
                        <div class="timeline-item">
                            <div class="timeline-marker bg-primary"></div>
                            <div class="timeline-content">
                                <h6 class="timeline-title">Đã gửi hàng</h6>
                                <p class="timeline-text">{{ $order->updated_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    @endif
                    
                    @if($order->status === 'delivered')
                        <div class="timeline-item">
                            <div class="timeline-marker bg-success"></div>
                            <div class="timeline-content">
                                <h6 class="timeline-title">Đã giao hàng</h6>
                                <p class="timeline-text">{{ $order->updated_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    @endif
                    
                    @if($order->status === 'cancelled')
                        <div class="timeline-item">
                            <div class="timeline-marker bg-danger"></div>
                            <div class="timeline-content">
                                <h6 class="timeline-title">Đơn hàng bị hủy</h6>
                                <p class="timeline-text">{{ $order->updated_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Update Status Modal -->
<div class="modal fade" id="statusModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cập nhật trạng thái đơn hàng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="statusForm" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="new_status" class="form-label">Trạng thái mới</label>
                        <select class="form-select" id="new_status" name="status" required>
                            <option value="pending">Chờ xử lý</option>
                            <option value="processing">Đang xử lý</option>
                            <option value="shipped">Đã gửi</option>
                            <option value="delivered">Đã giao</option>
                            <option value="cancelled">Đã hủy</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="status_note" class="form-label">Ghi chú (tùy chọn)</label>
                        <textarea class="form-control" id="status_note" name="note" rows="3" 
                                  placeholder="Thêm ghi chú về việc thay đổi trạng thái..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<style>
.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 15px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #dee2e6;
}

.timeline-item {
    position: relative;
    margin-bottom: 20px;
}

.timeline-marker {
    position: absolute;
    left: -22px;
    top: 0;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    border: 2px solid #fff;
}

.timeline-content {
    padding-left: 20px;
}

.timeline-title {
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 5px;
}

.timeline-text {
    font-size: 12px;
    color: #6c757d;
    margin-bottom: 0;
}
</style>

<script>
function updateStatus(orderId, currentStatus) {
    document.getElementById('statusForm').action = `/admin/orders/${orderId}/status`;
    document.getElementById('new_status').value = currentStatus;
    new bootstrap.Modal(document.getElementById('statusModal')).show();
}

function printOrder() {
    window.print();
}
</script>
@endpush
@endsection