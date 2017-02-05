<div class="item @if($category->childs()->count() > 0) has-items @endif">
    <div class="header">{{ $category->name }}</div>
    <div class="items">
        @each('management.nomenclature.category', $category->childs, 'category')
    </div>
</div>