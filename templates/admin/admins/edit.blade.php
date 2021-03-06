@extends('admin.layout')
@section('title', ucfirst(Request::segment(2)))
@section('content')

<div class="row mb-3">
    <div class="col-6">
        <h1>Edit Admin</h1>
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
        @elseif (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    @endif
    
    <form action="{{ route('admins.update', ['id' => $data->id]) }}" method="post" id="form" class="form-horizontal" enctype="multipart/form-data">
        {{ method_field('PUT') }}
        @include('admin.admins.fields')
    </form>
</div>
@endsection
