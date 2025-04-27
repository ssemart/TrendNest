<div>
    <div class="mb-3">
        <label for="category_id" class="fw-bold mb-2">Select a category for your Product</label>
        <select class="form-control mb-2" wire:model.live="selectedCategory" name="category_id">
            <option value="">Select A Category</option>
            @foreach($categories as $category)
            <option value="{{$category->id}}">{{$category->category_name}}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="subcategory_id" class="fw-bold mb-2">Select a Sub Category for your Product</label>
        <select class="form-control mb-2" wire:model.live="selectedSubcategory" name="subcategory_id" @if(!$selectedCategory) disabled @endif>
            <option value="">Select A Sub Category</option>
            @foreach($subcategories as $subcategory)
            <option value="{{$subcategory->id}}">{{$subcategory->subcategory_name}}</option>
            @endforeach
        </select>
    </div>

    @script
    <script>
        $wire.on('subcategories-updated', () => {
            Alpine.nextTick(() => {
                // Ensure the subcategory dropdown is properly updated
                $wire.$refresh();
            });
        });
    </script>
    @endscript
</div>
