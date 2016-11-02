<div class="section @if($item->active) active @endif">
    <a href="javascript:" class="section-header">{{ $item->name }}</a>
    <div class="items section-items">
        @foreach($item->items as $_item)
        {!! $sidebar->link($_item->path, null, $manyItemsWithSameController, $actions) !!}
        @endforeach
    </div>
</div>