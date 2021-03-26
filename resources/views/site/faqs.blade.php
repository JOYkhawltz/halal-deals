@extends('layouts.main')

@section('content')
<section class="main-body-section">
    <div class="container">
        <div class="inner-wrap">
            <h2>FAQs</h2>
            <div class="inner-cont-area">
                <div class="row">
                    <div class="col-12">
                        <div class="accordion common-accordion" id="accordionExample">
                            @if(count($model)>0)
                            @foreach($model as $i=>$row)
                            <div class="card">
                                <div class="card-header" id="heading{{$i}}">
                                    <h2 class="mb-0">
                                        <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$i}}"><i class="fa fa-plus"></i> {{$row->question}}</button>									
                                    </h2>
                                </div>
                                <div id="collapse{{$i}}" class="collapse {{($i==0)?'show':''}}" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p>{!!$row->answer!!}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @else
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h2 class="mb-0">
                                        <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"><i class="fa fa-plus"></i> FAQ</button>									
                                    </h2>
                                </div>
                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p>No FAQs found.</p>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@stop

@section('js')
<script>
    $(document).ready(function () {
        // Add minus icon for collapse element which is open by default
        $(".collapse.show").each(function () {
            $(this).prev(".card-header").find(".fa").addClass("fa-minus").removeClass("fa-plus");
        });

        // Toggle plus minus icon on show hide of collapse element
        $(".collapse").on('show.bs.collapse', function () {
            $(this).prev(".card-header").find(".fa").removeClass("fa-plus").addClass("fa-minus");
        }).on('hide.bs.collapse', function () {
            $(this).prev(".card-header").find(".fa").removeClass("fa-minus").addClass("fa-plus");
        });
    });
</script>
@stop    