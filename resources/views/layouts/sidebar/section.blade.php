<div>
    <a href="javascript:" class="section-header">{{ $name }}</a>
    <div class="items section-items">
        @foreach($items as $item)
        {!! $sidebar->link($item['path']) !!}
        @endforeach
    </div>
</div>