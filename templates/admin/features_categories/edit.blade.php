@extends('admin.layout')
@section('title', ucfirst(Request::segment(2)))
@section('content')
 <!-- BEGIN PAGE CONTENT INNER -->
<div class="page-content-inner">
    <div class="row">
        <div class="col-md-12 ">
            <!-- BEGIN SAMPLE FORM PORTLET-->
            <div class="portlet light ">
                <div class="row mb-3">
                    <div class="caption font-red-sunglo">
                        <span class="caption-subject bold uppercase"> Edit Feature Category</span>
                    </div>
                </div>
                <div class="portlet-body form">

                    @if(Session::has('error'))
                        <div class="alert alert-danger">
                            {{ Session::get('error') }}
                        </div>
                    @endif

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    
                    <form action="{{ route('features.update', ['id' => $data->id]) }}" method="post" id="form" class="form-horizontal" enctype="multipart/form-data">
                        {{ method_field('PUT') }}
                        @include('admin.features_categories.fields')
                        
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- END SAMPLE FORM PORTLET-->
@endsection
