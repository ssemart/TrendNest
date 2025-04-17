<div>
<label for="Category_id" class="fw-bold mb-2">Select a category for your Product</label>
    <select class="form-control mb-2" name="Category_id" wire:model.live="selectedCategory">
        <option value="">Select A Category</option>
        @foreach($categories as $category)
        <option value="{{$category->id}}">{{$category->category_name}}</option>
        @endforeach
    </select>

    <label for="subcategory_id " class="fw-bold mb-2">Select a Sub Category for your Product</label>
    <select class="form-control mb-2"name="subcategory_id" wire:model.live="selectedSubcategory">
        <option value="">Select A Sub Category</option>
        @foreach($subcategories as $subcategory)
        <option value="{{$subcategory->id}}">{{$subcategory->subcategory_name}}</option>
        @endforeach
    </select>

</div>
