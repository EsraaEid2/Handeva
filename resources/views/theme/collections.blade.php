@extends('theme.master')
@section('title','Collections')
@section('content')

@include('theme.partials.hero',['title' => 'Collections'])

<!--== Page Content Wrapper Start ==-->
<div id="page-content-wrapper" class="p-9">
    <div class="container">
        <div class="row">
            <!-- Sidebar Area Start -->
            <div class="col-lg-3 mt-5 mt-lg-0 order-last order-lg-first">
                @include('theme.partials.sidebar')
            </div>
            <!-- Sidebar Area End -->

            <!-- Products Area Start -->
            <div class="col-lg-9">
                <div class="shop-page-content-wrap">
                    <!-- Product Sort Options -->
                    <div class="products-settings-option d-flex justify-content-between">
                        @include('theme.partials.sort-form')
                    </div>
                    <!-- Products Grid -->
                    @include('theme.partials.product-grid')
                    <!-- Pagination -->
                    <nav class="page-pagination">
                        {{ $products->appends(request()->input())->links() }}
                    </nav>
                </div>
            </div>
            <!-- Products Area End -->
        </div>
    </div>
</div>
<!--== Page Content Wrapper End ==-->

<script>
document.addEventListener('DOMContentLoaded', () => {
    const sortSelect = document.getElementById('sort');
    const sidebarLinks = document.querySelectorAll('.filter-link');

    // Function to handle filter updates
    function updateFilters() {
        let url = '/products?';

        // Add sort parameter
        const sortValue = sortSelect.value;
        if (sortValue) {
            url += `sort=${sortValue}&`;
        }

        // Add selected category
        const categoryId = document.querySelector('.filter-link.active')?.getAttribute('data-id');
        if (categoryId) {
            url += `category_id=${categoryId}&`;
        }

        // Add price range (if applicable)
        const minPrice = document.getElementById('minPrice')?.value;
        const maxPrice = document.getElementById('maxPrice')?.value;
        if (minPrice && maxPrice) {
            url += `min_price=${minPrice}&max_price=${maxPrice}&`;
        }

        // Fetch new products
        fetch(url)
            .then(response => response.json())
            .then(data => {
                const productsList = document.getElementById('products-list');
                productsList.innerHTML = ''; // Clear previous products
                data.products.forEach(product => {
                    const productElement = document.createElement('div');
                    productElement.classList.add('product-item');
                    productElement.innerHTML = `
                        <h3>${product.title}</h3>
                        <p>${product.price}</p>
                    `;
                    productsList.appendChild(productElement);
                });
            })
            .catch(error => console.log(error));
    }

    // Listen for changes on sort select
    sortSelect.addEventListener('change', updateFilters);

    // Listen for category filter clicks
    sidebarLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();

            // Toggle active state
            sidebarLinks.forEach(link => link.classList.remove('active'));
            this.classList.add('active');

            updateFilters();
        });
    });
});
</script>
@endsection