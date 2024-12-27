@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
        $(document).ready(function() {
            alert();
            // // Define the URL for the API endpoint
            // const apiUrl = '/api/products';  // Assuming your API route is '/api/products'

            // // Function to fetch products and render them in the page
            // function loadProducts(page = 1) {
            //     $.ajax({
            //         url: apiUrl + '?page=' + page, // Send the page number as a query parameter
            //         method: 'GET',
            //         success: function(response) {
            //             if (response.success) {
            //                 const products = response.data.data; // Paginated product data
            //                 const pagination = response.data.links; // Pagination links

            //                 // Clear existing content
            //                 $('#product-list').empty();
            //                 $('#pagination').empty();

            //                 // Loop through the products and append them to the product list
            //                 products.forEach(function(product) {
            //                     $('#product-list').append(`
            //                         <div class="product">
            //                             <h3>${product.name}</h3>
            //                             <p>${product.description}</p>
            //                             <p>Price: $${product.price}</p>
            //                             <img src="${product.image}" alt="${product.name}" width="100">
            //                         </div>
            //                     `);
            //                 });

            //                 // Render pagination links
            //                 pagination.forEach(function(link) {
            //                     if (link.url) {
            //                         $('#pagination').append(`
            //                             <a href="#" onclick="loadProducts(${link.page})">${link.label}</a>
            //                         `);
            //                     }
            //                 });
            //             }
            //         }
            //     });
            // }

            // // Initial load of products
            // loadProducts();

            // // Handle pagination links
            // window.loadProducts = function(page) {
            //     loadProducts(page);
            // };
        });
    </script>
