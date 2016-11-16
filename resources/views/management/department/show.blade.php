@extends('layouts.app', [
    'no_content_paddings' => true,
    'tabs_as_sidebar' => true,
    'classes' => ['department-page'],
    'content_scrollable' => false
])

@section('content')

    <nav class="tabs" data-default=".tab-content-info">
        <a href="javascript:" data-target=".tab-content-info">Информация об отделении</a>
        <a href="javascript:" data-target=".tab-content-doctors">Доктора</a>
        <a href="javascript:" data-target=".tab-content-patients">Пациенты</a>
    </nav>

    <div class="tabs-contents">
        <div class="tab-content tab-content-info">
            Hello world
        </div>
        <div class="tab-content tab-content-doctors">
            Doctors
        </div>
        <div class="tab-content tab-content-patients">
            Patients
        </div>
    </div>

@endsection