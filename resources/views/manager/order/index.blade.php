@extends('manager.layouts.app') @section('style') @endsection @section('content')
<div class="container-fluid flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-6 text-start">
            <h5 class="py-2 mb-2">
                <span class="text-primary fw-light">Order</span>
            </h5>
        </div>
        <div class="col-md-6 text-end">
            {{--  <a href="{{route('manager.order.add')}}" class="btn btn-primary">
                Add
            </a>  --}}
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-bordered" id="branchTable">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Order Id</th>
                                    <th>Customer Name</th>
                                    <th>Number</th>
                                    <th>WhatsApp Number</th>
                                    <th>Amount</th>
                                    <th>Delivery Type</th>
                                    <th>Manager Approved</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($OrderList as $order)
                                    <tr>
                                        <td>{{ $order->date }}</td>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->customer->full_name }}</td>
                                        <td>{{ $order->customer->phone }}</td>
                                        <td>{{ $order->customer->whatsapp_number }}</td>
                                        <td>{{ $order->amount }}</td>
                                        <td>
                                            @if ($order->delivery_type == 'premium')
                                                    <span class="badge bg-success">{{ $order->delivery_type }}</span>
                                            @else
                                                    <span class="badge bg-danger">{{ $order->delivery_type }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($order->status == 'approved')
                                                    <span class="badge bg-success">{{ $order->status }}</span>
                                            @elseif($order->status == 'pending')
                                                    <span class="badge bg-warning">{{ $order->status }}</span>
                                            @else
                                                    <span class="badge bg-danger">{{ $order->status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($order->order_status == 'product_founder')
                                                    <span class="badge bg-success">{{ $order->order_status }}</span>
                                            @elseif($order->status == 'pending')
                                                    <span class="badge bg-warning">{{ $order->order_status }}</span>
                                            @else
                                                    <span class="badge bg-danger">{{ $order->order_status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('manager.order.view', $order->id)}}" class="btn btn-sm btn-info">View</a>
                                            @if($order->status == 'pending')
                                                <a href="javascript:void(0);" class="btn btn-sm btn-danger reject-status" data-id="{{ $order->id }}">Reject</a>
                                                <a href="javascript:void(0);" class="btn btn-sm btn-success approved-status" data-id="{{ $order->id }}">Approved</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection 
@section('script')
<script>
    $(document).ready(function () {
        // Handle Reject Status
        $(".reject-status").click(function () {
            let orderId = $(this).data("id");
            updateOrderStatus(orderId, "reject" , "reject");
        });
    
        // Handle Approve Status
        $(".approved-status").click(function () {
            let orderId = $(this).data("id");
            updateOrderStatus(orderId, "approved" , "product_founder");
        });
    
        function updateOrderStatus(orderId, status, order_status) {
            $.ajax({
                url: "{{ url('/manager/order/update-order-status') }}",
                type: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"), // CSRF token for security
                    order_id: orderId,
                    status: status,
                    order_status: order_status
                },
                success: function (response) {
                    if (response.success) {
                        alert("Order status updated to " + status);
                        location.reload(); // Reload page to reflect changes
                    } else {
                        alert("Failed to update order status!");
                    }
                },
                error: function () {
                    alert("Something went wrong!");
                }
            });
        }
    });    
</script>
@endsection
