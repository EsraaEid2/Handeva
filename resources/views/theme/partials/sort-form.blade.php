<div class="product-cong-left d-flex align-items-center">
    <!-- Search Bar -->
    <form id="searchForm" class="search-bar d-flex align-items-center" method="GET" action="/search">
        <input type="text" name="query" id="searchInput" class="form-control search-input"
            placeholder="Search for products..." value="{{ request('query') }}">
        <button type="submit" class="btn search-btn">
            <i class="fa fa-search"></i>
        </button>
    </form>

    <span class="show-items">Items 1 - 9 of 17</span>
</div>

<form id="sortForm" class="sort-form">
    <label for="sort" class="sort-label">Sort By:</label>
    <select name="sort" id="sort" class="sort-select">
        <option value="relevance">Relevance</option>
        <option value="name_asc">Name, A to Z</option>
        <option value="name_desc">Name, Z to A</option>
        <option value="price_asc">Price: Low to High</option>
        <option value="price_desc">Price: High to Low</option>
    </select>
</form>