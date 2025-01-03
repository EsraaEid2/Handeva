<div class="product-cong-left d-flex align-items-center justify-content-center">
    <!-- Custom Search Bar -->
    <form id="customSearchForm" class="custom-search-bar d-flex align-items-center" method="GET"
        action="{{ route('collections') }}">
        <input type="text" name="query" id="customSearchInput" class="form-control custom-search-input"
            placeholder="Search for products..." value="{{ request('query') }}">
        <button type="submit" class="btn custom-search-btn">
            <i class="fa fa-search"></i>
        </button>
    </form>
</div>

<!-- <span class="show-items">Items 1 - 9 of 17</span> -->
<!-- <form id="sortForm" class="sort-form">
    <label for="sort" class="sort-label">Sort By:</label>
    <select name="sort" id="sort" class="sort-select">
        <option value="relevance">Relevance</option>
        <option value="name_asc">Name, A to Z</option>
        <option value="name_desc">Name, Z to A</option>
        <option value="price_asc">Price: Low to High</option>
        <option value="price_desc">Price: High to Low</option>
    </select>
</form> -->