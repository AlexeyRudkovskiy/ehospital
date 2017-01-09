<div class="comments">
    @foreach($cure->comments as $comment)
        <div class="card">
            <p>{{ $comment->text }}</p>
            <div class="row row-fixed">
                <div class="col-9">
                    <a href="{{ route('user.show', $comment->user->id) }}">{{ $comment->user->fullName() }}</a>
                </div>
                <div class="col-3">
                    {!! $comment->created_at !!}
                </div>
            </div>
        </div>
    @endforeach
</div>
