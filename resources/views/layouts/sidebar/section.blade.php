<div class="section">
    <a href="javascript:" class="section-header">{{ $item->name }}</a>
    <div class="items section-items">
        @foreach($item->items as $_item)
        {!! $sidebar->link($_item->path) !!}
        @endforeach
    </div>
</div>