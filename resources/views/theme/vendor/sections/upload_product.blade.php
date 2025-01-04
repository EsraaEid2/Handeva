<form action="{{ route('vendor.uploadProduct') }}" method="POST" enctype="multipart/form-data" class="vd-upload-form"
    id="product-upload-form">
    @csrf
    <!-- Progress Bar -->
    <div class="vd-progress">
        <div class="vd-progress-steps">
            <div class="vd-step active" data-step="1">
                <div class="vd-step-icon">1</div>
                <span>Basic Info</span>
            </div>
            <div class="vd-step" data-step="2">
                <div class="vd-step-icon">2</div>
                <span>Details</span>
            </div>
            <div class="vd-step" data-step="3">
                <div class="vd-step-icon">3</div>
                <span>Options</span>
            </div>
            <div class="vd-step" data-step="4">
                <div class="vd-step-icon">4</div>
                <span>Images</span>
            </div>
        </div>
    </div>

    <!-- Step 1: Basic Info -->
    <div class="vd-step-content active" data-step="1">
        <div class="flexed">
            <div class=" vd-form-group">
                <label class="vd-label" for="title">Product Title</label>
                <input type="text" name="title" class="vd-input" required>
            </div>
            <div class="vd-form-group">
                <label class="vd-label" for="category">Category</label>
                <select name="category_id" class="vd-select" required>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="vd-form-group">
            <label class="vd-label" for="description">Description</label>
            <textarea name="description" class="vd-textarea" required></textarea>
        </div>

    </div>

    <!-- Step 2: Details -->
    <div class="vd-step-content" data-step="2">
        <div class="vd-form-group">
            <label class="vd-label" for="price">Price</label>
            <input type="number" step="0.01" name="price" class="vd-input" required>
        </div>
        <div class="vd-form-group">
            <label class="vd-label" for="stock_quantity">Stock Quantity</label>
            <input type="number" name="stock_quantity" class="vd-input" required>
        </div>
        <div class="vd-form-group">
            <label class="vd-label" for="discount">Discount (%)</label>
            <input type="number" step="0.01" name="discount" class="vd-input">
        </div>
    </div>

    <!-- Step 3: Options -->
    <div class="vd-step-content" data-step="3">
        <div class="flexed-container">
            <div class="vd-toggle-container">
                <label class="vd-toggle">
                    <input type="checkbox" name="is_traditional" id="is_traditional">
                    <span class="vd-toggle-slider"></span>
                </label>
                <span>Traditional Product</span>
            </div>
            <div class="vd-toggle-container">
                <label class="vd-toggle">
                    <input type="checkbox" name="is_customizable" id="is_customizable">
                    <span class="vd-toggle-slider"></span>
                </label>
                <span>Customizable Product</span>
            </div>
        </div>


        <div class="vd-form-group" id="customization-section" style="display: none;">
            <label class="vd-label" for="customization_id">Customization Type</label>
            <select name="customization_id" id="customization_id" class="vd-select">
                <option value="">Select a customization type</option>
                @foreach ($customizations as $customization)
                <option value="{{ $customization->id }}">{{ $customization->custom_type }}</option>
                @endforeach
            </select>

        </div>
    </div>

    <!-- Step 4: Images -->
    <div class="vd-step-content" data-step="4">
        <div class="vd-file-upload">
            <i class="fas fa-cloud-upload-alt vd-upload-icon"></i>
            <p>Drag and drop your images here or click to browse</p>
            <p class="vd-upload-note">(Maximum 3 images)</p>
            <input type="file" name="images[]" multiple accept="image/*" required>
        </div>
    </div>

    <!-- Navigation Buttons -->
    <div class="vd-form-nav">
        <button type="button" class="vd-btn-prev" style="display: none;">Previous</button>
        <button type="button" class="vd-btn-next">Next</button>
        <button type="submit" class="vd-submit-btn" style="display: none;">Upload Product</button>
    </div>
</form>