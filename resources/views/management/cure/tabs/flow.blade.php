<div class="flow">

    @if(!$cure->isMedicamentsApprovedByPharmacists() && auth()->id() != $cure->department->chief_medical_officer_id)
    <div class="alert alert-danger alert-space-after">
        @lang('management.notification.cure.nomenclature.notAccepted')
    </div>
    @endif

    @if(auth()->id() != $cure->department->chief_medical_officer_id)
    <table class="table table-striped">
        <thead>
        <tr>
            <th width="110">Дата</th>
            <th>Номенклатуры</th>
            <th>Процедуры</th>
        </tr>
        </thead>
        <tbody>
        @foreach($cure->days as $day)
        <tr>
            <td>{{ $day->day->format('d.m.Y') }}</td>
            <td>
                <ul class="list">
                    @foreach($day->nomenclatures as $nomenclature)
                    <li>{{ $nomenclature->name_for_department }}({{ $nomenclature->pivot->amount }})</li>
                    @endforeach
                </ul>
            </td>
            <td>bar</td>
        </tr>
        @endforeach
        </tbody>
    </table>
    @else

    <form class="form form-compact">
        <attach-nomenclatures review="true" view-only="true"></attach-nomenclatures>
    </form>

    <div class="pull-right offset-top">
        <a href="{{ route('cure.review.reject', $cure->id) }}" class="btn btn-fill btn-danger">отклонить</a>
        <a href="{{ route('cure.review.accept', $cure->id) }}" class="btn btn-fill btn-success">подтвердить</a>
    </div>
    @endif
</div>

@push('scripts')
<script>window.review = JSON.parse('{!! json_encode($cure->review) !!}')</script>
@endpush
