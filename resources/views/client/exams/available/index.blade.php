@extends('client/layouts/contentLayoutMaster')

@section('title', 'Доступные экзамены')

@section('content')
    <div class="row">

        @forelse($exams as $exam)
            <div class="col-lg-4">
                @include('client.exams.available.card')
            </div>
        @empty
            <h4 class="text-muted">У вас отсутствует доступных экзаменов!</h4>
        @endforelse

    </div>
    <div class="clearfix">
        <div class="float-right">
            {!! $exams->links('pagination::bootstrap-4') !!}
        </div>
    </div>

@endsection

