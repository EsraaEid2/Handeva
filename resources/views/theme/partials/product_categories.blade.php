<!--== Products by Category Area Start ==-->
<div id="product-categories-area">
    <div class="handeva-container">
        <div class="row">
            <!-- Large Category Section -->
            <div class="col-lg-6">
                <div class="large-size-cate">
                    @php
                    $traditionalCategory = $categories->firstWhere('id', 9);
                    @endphp
                    @if ($traditionalCategory)
                    <div class="single-cat-item">
                        <figure class="category-thumb">
                            <a href="/collections/{{ strtolower($traditionalCategory->name) }}">
                                <img src="{{ asset('uploads/category/' . $traditionalCategory->image) }}"
                                    alt="{{ $traditionalCategory->name }}" class="img-fluid category-image" />
                            </a>
                            <figcaption class="category-name">
                                <a
                                    href="/collections/{{ strtolower($traditionalCategory->name) }}">{{ $traditionalCategory->name }}</a>
                            </figcaption>
                        </figure>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Small Categories Section -->
            <div class="col-lg-6">
                <div class="small-size-cate">
                    <div class="row">
                        @foreach ($categories->where('id', '!=', 9) as $category)
                        <div class="col-sm-6">
                            <div class="single-cat-item">
                                <figure class="category-thumb">
                                    <a href="/collections/{{ strtolower($category->name) }}">
                                        <img src="{{ asset('uploads/category/' . $category->image) }}"
                                            alt="{{ $category->name }}" class="img-fluid category-image" />
                                    </a>
                                    <figcaption class="category-name">
                                        <a
                                            href="/collections/{{ strtolower($category->name) }}">{{ $category->name }}</a>
                                    </figcaption>
                                </figure>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--== Products by Category Area End ==-->