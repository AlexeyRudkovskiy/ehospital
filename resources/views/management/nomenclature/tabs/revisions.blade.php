<div class="cards">

    @foreach($nomenclature->revisions as $revision)
        <div class="card">
            <div class="card-header">
                <p class="title title-normal-font-size">
                    <a href="{{ route('user.show', $revision->getDiff()->author->id) }}" class="bold">{{ $revision->getDiff()->author->fullName() }}</a>
                </p>
                <p class="subtitle">
                    <span>{{ $revision->getDiff()->date }}</span>
                </p>
            </div>
            <div class="card-content no-paddings has-bottom-offset">
                @foreach($revision->getDiff()->diff as $key => $diff)
                    <div class="diff">
                        <div class="diff-header">
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
</div>