// resources/views/vendor/sections/view_products.blade.php

<table id="products-table" class="table">
    <thead>
        <tr>
            <th>Title</th>
            <th>Category</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <!-- Populate products here -->
    </tbody>
</table>

<script>
$(document).ready(function() {
    $('#products-table').DataTable();
});
</script>