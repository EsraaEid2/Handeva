<div class="product-cong-left d-flex align-items-center">
    <ul class="product-view d-flex align-items-center">
        <li class="current column-gird"><i class="fa fa-bars fa-rotate-90"></i></li>
        <li class="box-gird"><i class="fa fa-th"></i></li>
        <li class="list"><i class="fa fa-list-ul"></i></li>
    </ul>
    <span class="show-items">Items 1 - 9 of 17</span>
</div>
<form method="GET" id="sortForm">
    <label for="sort">Sort By:</label>
    <select name="sort" id="sort" onchange="this.form.submit();">
        <option value="relevance">Relevance</option>
        <option value="name_asc">Name, A to Z</option>
        <option value="name_desc">Name, Z to A</option>
        <option value="price_asc">Price: Low to High</option>
        <option value="price_desc">Price: High to Low</option>
    </select>
</form>