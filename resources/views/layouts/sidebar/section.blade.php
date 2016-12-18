<li @if($item->active) class="active" @endif>
    <a href="javascript:" data-list-header>{{ $item->name }}</a>
    @if(count($item->items) > 0)
    <ul>
    @foreach($item->items as $_item)
        {!! $sidebar->link($_item->path, null, $manyItemsWithSameController, $actions) !!}
    @endforeach
    </ul>
    @endif
</li>