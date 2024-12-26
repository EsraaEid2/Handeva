<!-- resources/views/theme/partials/sidebar.blade.php -->
<div id="sidebar-area-wrap">
    <!-- Categories -->
    <div class="single-sidebar-wrap">
        <h2 class="sidebar-title">Categories</h2>
        <ul class="sidebar-list">
            @foreach($categories as $category)
            <li>
                <a href="{{ route('collections', array_merge(request()->all(), ['category_id' => $category->id])) }}">
                    {{ $category->name }}
                </a>
            </li>
            @endforeach
        </ul>
    </div>

    <!-- Product Types -->
    <div class="single-sidebar-wrap">
        <h2 class="sidebar-title">Product Type</h2>
        <ul class="sidebar-list">
            <li><a href="{{ route('collections', array_merge(request()->all(), ['type' => 'custom'])) }}">Custom
                    Products</a></li>
            <li><a
                    href="{{ route('collections', array_merge(request()->all(), ['type' => 'traditional'])) }}">Traditional</a>
            </li>
            <li><a href="{{ route('collections', array_merge(request()->all(), ['type' => 'sale'])) }}">On Sale</a></li>
        </ul>
    </div>

    <!-- Price Range -->
    <div class="single-sidebar-wrap">
        <h2 class="sidebar-title">Price Range</h2>
        <ul class="sidebar-list">
            @foreach($priceRanges as $range)
            <li>
                <a
                    href="{{ route('collections', array_merge(request()->all(), ['min_price' => $range['min'], 'max_price' => $range['max']])) }}">
                    ${{ number_format($range['min'], 2) }} - ${{ number_format($range['max'], 2) }}
                </a>
            </li>
            @endforeach
        </ul>
    </div>

    <!-- Reset Button -->
    <div class="single-sidebar-wrap text-center mt-3">
        <a href="{{ route('collections') }}" class="btn btn-secondary">Reset Filters</a>
    </div>
</div>