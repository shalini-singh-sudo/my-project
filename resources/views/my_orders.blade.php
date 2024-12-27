@extends('layouts.app')

@section('content')
<div class="container">
<h1>My Orders</h1>
    <div class="row">

        <div class="col-md-12">
        @if($orders->isEmpty())
            <p>You have no orders yet.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Order Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        @foreach($order->orderDetails as $orderDetail)
                            @if(isset($orderDetail->product))
                                <tr>
                                    <td>{{ $orderDetail->product->name }}</td>
                                    <td>{{ $orderDetail->product->price }}</td>
                                    <td>{{ $orderDetail->created_at->format('Y-m-d H:i') }}</td>
                                </tr>
                            @endif
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        @endif
        </div>
    </div>
</div>

@endsection