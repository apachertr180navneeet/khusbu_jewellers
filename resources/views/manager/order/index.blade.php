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
                                            <a href="{{ route('manager.order.view', $order->id)}}" class="btn btn-sm btn-info">View</a>
                                            {{--  <a href="javascript:void(0);" class="btn btn-sm btn-danger delete-order" data-id="{{ $order->id }}">Delete</a>  --}}
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
    $(document).on('click', '.delete-order', function(e) {
        e.preventDefault();
    
        let orderId = $(this).data('id');
    
        if (confirm("Are you sure you want to delete this order?")) {
            $.ajax({
                url: "{{ url('/manager/order/delete') }}/" + orderId, // Correct URL format
                type: "DELETE",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.success) {
                        alert("Order deleted successfully!");
                        location.reload();
                    } else {
                        alert("Error deleting order.");
                    }
                },
                error: function(xhr) {
                    alert("Something went wrong!");
                    console.log(xhr.responseText);
                }
            });
        }
    });     
</script>
@endsection
