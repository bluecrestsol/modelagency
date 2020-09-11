@extends('admin.layout')
@section('content')

<div class="row mb-3">
        <div class="col-6">
            <h1>Talents</h1>
        </div>
        <div class="col-6">
            <a href="{{ route('talents.create') }}" class="btn btn-success float-right">Add New</a>
        </div>
    </div>
    
    <div class="row mb-3">
        <div class="col-12">
        <form class="form-horizontal" id="form-search" action="{{ route('talents.index') }}">
            <div class="form-body row">
                <!-- Name | Sex | Ethnicity | Age From | Age To | Status -->
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Name</label>
                        <input class="form-control" type="text" name="filter_name_talents" id="filter_name_talents" value="{{ Session::get('filter_name_talents') }}">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label>Sex</label>
                        <select class="form-control" name="filter_sex_talents" id="filter_sex_talents">
                            <option value="">Any</option>
                            @foreach(config('constants.models.sex') as $key => $value)
                                <option value="{!! $key !!}" {{ (Session::get('filter_sex_talents') == $key) ? 'selected':'' }}>{!! $value !!}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label>Ethnicity</label>
                        <select class="form-control" name="filter_ethnicity_talents" id="filter_ethnicity_talents">
                            <option value="">Any</option>
                            @foreach(\App\Models\Ethnicity::orderBy('name')->get() as $i)
                                <option value="{!! $i->id !!}" {{ (Session::get('filter_ethnicity_talents') == $i->id) ? 'selected':'' }}>{!! $i->name !!}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label>Age From</label>
                        <input class="form-control" type="number" min="1" max="99" name="filter_age_from_talents" id="filter_age_from_talents" value="{{ Session::get('filter_age_from_talents') }}">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label>Age To</label>
                        <input class="form-control" type="number" min="1" max="99" name="filter_age_to_talents" id="filter_age_to_talents" value="{{ Session::get('filter_age_to_talents') }}">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="filter_status_talents" id="filter_status_talents">
                            <option value="">Any</option>
                            @foreach(config('constants.models.status') as $key => $value)
                                <option value="{!! $key !!}" {!! ( Session::has('filter_status_talents') && Session::get('filter_status_talents') == $key) ? 'selected':'' !!}>{!! $value !!}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <!-- Height From | Height To | Body | Hair | Eyes -->
                
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Height From</label>
                        <input class="form-control" type="number" name="filter_height_from_talents" id="filter_height_from_talents" value="{{ Session::get('filter_height_from_talents') }}">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label>Height To</label>
                        <input class="form-control" type="number" name="filter_height_to_talents" id="filter_height_to_talents" value="{{ Session::get('filter_height_to_talents') }}">
                    </div>
                </div>
                
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Body</label>
                        <select class="form-control" name="filter_body_talents" id="filter_body_talents">
                            <option value="">Any</option>
                            @foreach(\App\Models\Body::orderBy('name')->get() as $i)
                                <option value="{!! $i->id !!}" {{ (Session::get('filter_body_talents') == $i->id) ? 'selected':'' }}>{!! $i->name !!}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label>Hair</label>
                        <select class="form-control" name="filter_hair_talents" id="filter_hair_talents">
                            <option value="">Any</option>
                            @foreach(\App\Models\Hair::orderBy('name')->get() as $i)
                                <option value="{!! $i->id !!}" {{ (Session::get('filter_hair_talents') == $i->id) ? 'selected':'' }}>{!! $i->name !!}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label>Eyes</label>
                        <select class="form-control" name="filter_eyes_talents" id="filter_eyes_talents">
                            <option value="">Any</option>
                            @foreach(\App\Models\Eyes::orderBy('name')->get() as $i)
                                <option value="{!! $i->id !!}" {{ (Session::get('filter_eyes_talents') == $i->id) ? 'selected':'' }}>{!! $i->name !!}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary float-right" id="filter_btn_models">Filter</button>
                        <button type="reset" class="btn btn-danger float-right" onclick="window.location.href = '{{ route('talents.filter.clear') }}'">Reset</button>
                    </div>
                </div>                
            </div>
            
        </form>
        </div>
    </div>

    <div class="row">
        @if(Session::has('message'))
            <div class="alert alert-success">
                {{ Session::get('message') }}
            </div>
        @else
            @if(Session::has('error'))
                <div class="alert alert-danger">
                    {{ Session::get('error') }}
                </div>
            @endif
        @endif
        
        @include('admin.talents.table')
    </div>
@endsection

