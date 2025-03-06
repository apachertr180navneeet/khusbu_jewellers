@extends('executive.layouts.app') @section('style') @endsection @section('content')
<div class="container-fluid flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-6 text-start">
            <h5 class="py-2 mb-2">
                <span class="text-primary fw-light">Order</span>
            </h5>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{route('executive.order.add')}}" class="btn btn-primary">
                Add
            </a>
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
                                        <td>{{ $order->delivery_type }}</td>
                                        <td>{{ $order->status }}</td>
                                        <td>
                                            {{--  <a href="{{ route('executive.order.edit', $order->id)}}" class="btn btn-sm btn-primary">Edit</a>
                                            <a href="{{ route('executive.order.delete', $order->id)}}" class="btn btn-sm btn-danger">Delete</a>  --}}
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
    
</script>
@endsection
