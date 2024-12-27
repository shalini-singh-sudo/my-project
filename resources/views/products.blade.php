
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Products</h1>
    <div class="col-md-12">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Search by name">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <input type="hidden" id="user_id" value="{{Auth::user()->id}}">
                        <button id="search-products" type="button" class="btn btn-primary btn-sm">Search</button>
                        <button id="clear-products" type="button" class="btn btn-warning btn-sm">Clear</button>
                    </div>
                </div>
                <div class="row" id="product-list"></div>

    </div>
</div>

<script>
    const baseUrl = "{{ url('/') }}";
    $(document).ready(function() {

        function fetchProducts(params = {}) {
            
            $.ajax({
                url: '/api/products',
                method: 'GET',
                headers: {
                    'ApiKey': '099eb0cd-02cf-4e2a-8aca-3e6c6aff0399' // Add your API key here
                },
                        data: params,
                success: function(response) {
                    if (response.success) {
                        let products = response.data;

                        $('#product-list').empty();

                        products.forEach(function(product) {
                            let imageUrl = baseUrl + '/image/' + product.image;
                            $('#product-list').append(`
                                <div class="col-md-4 mb-4">
                                    <div class="card">
                                        <img src="${imageUrl}" class="card-img-top" alt="${product.name}">
                                        <div class="card-body">
                                            <h5 class="card-title">${product.name}</h5>
                                            <p class="card-text">${product.description}</p>
                                            <p class="card-text">Price: $${product.price}</p>
                                            <button class="btn btn-success buy-btn" data-product-id="${product.id}" data-product-price="${product.price}">
                                            Buy Now
                                        </button>
                                        </div>
                                    </div>
                                </div>
                            `);
                        }); 
                    }
                }
            });
        }

        fetchProducts();
        
        $('#search-products').on('click', function(e) {
            e.preventDefault();

            const params = {
                name: $('#name').val(),
            };

            fetchProducts(params);
        });

        $('#clear-products').on('click', function(e) {
            e.preventDefault();
            $('#name').val("");
            fetchProducts();
        });

        $(document).on('click', '.buy-btn', function() {

            const productId = $(this).data('product-id');
            const productPrice = $(this).data('product-price');
            const userId = $("#user_id").val();
            $.ajax({
                url: '/buy-now',
                method: 'POST',
                data: {
                    product_id: productId,
                    product_price: productPrice,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        alert('Order placed successfully!');
                    } else {
                        alert('Failed to place order.');
                    }
                }
            });
        });

    });
</script>
@endsection