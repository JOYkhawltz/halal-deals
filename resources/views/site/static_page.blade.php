@extends('layouts.main')

@section('content')
<section class="main-body-section">
    <div class="container">
        <div class="inner-wrap">
            <h2>{{ $model->page_name }}</h2>
            <div class="inner-cont-area">
                {!! $model->content !!}
            </div>
        </div>
    </div>
</section>
@stop