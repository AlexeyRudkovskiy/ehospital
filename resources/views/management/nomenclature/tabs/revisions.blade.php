@foreach($nomenclature->revisions as $revision)
    <div class="diff-card">
        <div class="diff-header">
            <div>
                <a href="{{ route('user.show', $revision->getDiff()->author->id) }}" class="bold">{{ $revision->getDiff()->author->fullName() }}</a>
            </div>
            <div>
                <span>{{ $revision->getDiff()->date }}</span>
            </div>
        </div>
        <div class="diff-content">
            @foreach($revision->getDiff()->diff as $key => $diff)
                <div class="diff">
                    <div class="diff-name">
                        <span>{{ $key }}</span>
                    </div>
                    <?php try { ?>
                    <div class="diff-from">
                        <span>{!! $diff['from'] !!}</span>
                    </div>
                    <div class="diff-to">
                        <span>{{ $diff['to'] }}</span>
                    </div>
                    <?php } catch (\Exception $e) { dd($e, $revision->getDiff()); } ?>
                </div>
            @endforeach
        </div>
    </div>
@endforeach