
@extends('dashboard')

@section('content')
<div class="container my-5">
    <h4 class="text-center mb-3">{{ $product->name }}</h4>

    <div class="product-details">
        <p><strong>Price:</strong> {{ $product->price }} VND</p>
        <p><strong>Description:</strong> {{ $product->description }}</p>
        <p><strong>Quantity:</strong> {{ $product->quantity }}</p>
        <p><strong>Created At:</strong> {{ $product->created_at }}</p>
        <p><strong>Updated At:</strong> {{ $product->updated_at }}</p>
    </div>

    <a href="{{ url()->previous() }}" class="btn btn-primary mt-3">Quay lại</a>
</div>
@endsection
