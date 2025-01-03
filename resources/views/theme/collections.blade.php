@extends('theme.master')
@section('title','Collections')
@section('content')

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
    const productsList = document.getElementById('products-list');

    function updateFilters() {
        const activeCategory = document.querySelector('.filter-link.active');
        const categoryId = activeCategory ? activeCategory.dataset.id : '';

        let url = '/products?' + new URLSearchParams({
            sort: sortSelect.value,
            category_id: categoryId,
            min_price: document.getElementById('minPrice')?.value || '',
            max_price: document.getElementById('maxPrice')?.value || '',
            per_page: 9
        }).toString();

        fetch(url)
            .then(response => response.json())
            .then(data => {
                const productsWrapper = document.createElement('div');
                productsWrapper.className = 'products-wrapper products-grid';

                productsList.innerHTML = ''; // Clear previous products

                data.products.data.forEach(product => {
                    const productElement = document.createElement('div');
                    productElement.className = 'single-product-item';
                    productElement.innerHTML = `
                        <img src="${product.primary_image.url}" alt="${product.title}">
                        <h3>${product.title}</h3>
                        <p>Price: $${product.price}</p>
                        <p>Rating: ${Math.round(product.avg_rating * 10) / 10} / 5</p>
                        <a href="/product/${product.id}" class="btn btn-primary">View Details</a>
                    `;
                    productsWrapper.appendChild(productElement);
                });

                productsList.appendChild(productsWrapper);

                // Add pagination
                const pagination = document.createElement('nav');
                pagination.className = 'page-pagination';
                pagination.innerHTML = data.links;
                productsList.appendChild(pagination);
            })
            .catch(error => console.log(error));
    }

    // When sorting changes, update the filters
    sortSelect.addEventListener('change', updateFilters);

    // Handle category filter link clicks
    sidebarLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            sidebarLinks.forEach(link => link.classList.remove('active'));
            this.classList.add('active');
            updateFilters();
        });
    });
});
</script>
@endsection