@extends('admin::layouts.main')

@section('breadcrumb')
<li> <a href="{{route('admin-model-category')}}">Category Management</a></li>
<li class="active">Create</li>
@stop

@section('content')
<div class="user-update">
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-edit font-green-haze" aria-hidden="true"></i>
                <span class="caption-subject font-green-haze bold uppercase">Creating Category</span>
            </div>
        </div>
        <div class="portlet-body form">
            <form class="form-horizontal form-row-seperated" action="{{route('admin-model-category-create')}}" method="POST" enctype="multipart/form-data" id="Create-Category-From">
                @csrf
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3 ">
                            <div class="form-group">
                                <label>Category Name <span class="required">*</span></label>
                                <input type="text" name="category_name" class="form-control" placeholder="Enter Category Name">
                                <div class="help-block"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3 ">
                            <div class="form-group">
                                <label>Spanish Category Name <span class="required">*</span></label>
                                <input type="text" name="spanish_category_name" class="form-control" placeholder="Enter Spanish Category Name">
                                <div class="help-block"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-5 col-md-6">
                                <button type="submit" class="btn green">Create</button>
                                <a href="{{route('admin-model-category')}}" class="btn default">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script>

</script>
@stop