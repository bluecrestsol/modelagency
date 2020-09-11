@extends('client.layout')
@push('css')
<link rel="stylesheet" href="{{ asset('css/dropzone.css') }}">
<style>
  .dropzone {
      min-height: 150px;
      border: 3px dashed rgb(173, 212, 251);
      background: white;
      padding: 20px 20px;
  }
</style>
@endpush
@push('js')
<script src="{{ asset('js/dropzone.js') }}"></script>
<script>
  Dropzone.options.idsUpload = {
      acceptedFiles: "image/*",
      paramName: "files"
  };

  Dropzone.options.imagesUpload = {
      acceptedFiles: "image/jpg, image/jpeg",
      paramName: "images"
  };

  Dropzone.options.clipsUpload = {
      acceptedFiles: "video/*",
      paramName: "clips"
  };
</script>
@endpush

@section('content')
 <!-- BEGIN PAGE CONTENT INNER -->
<div class="page-content-inner">
    <div class="row">
        <div class="col-md-12 ">
            <!-- BEGIN SAMPLE FORM PORTLET-->
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption font-red-sunglo">
                        <i class="icon-settings font-red-sunglo"></i>
                        <span class="caption-subject bold uppercase"> Become A Model</span>
                    </div>
                    <div class="actions">
                        
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
                    
                    
                      <form class="dropzone" action="{{ route('become-a-talent.store.upload', $model->uuid) }}" method="post" id="ids-upload" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div>
                            <h4>Upload your Id, Passport or Drivers License</h4>
                        </div>
                      </form>
                      <br>
                      <br>
                      <form class="dropzone" action="{{ route('become-a-talent.store.upload', $model->uuid) }}" method="post" id="images-upload" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div>
                            <h4>Upload your photos</h4>
                        </div>
                      </form>
                      <br>
                      <br>
                      <form class="dropzone" action="{{ route('become-a-talent.store.upload', $model->uuid) }}" method="post" id="clips-upload" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div>
                            <h4>Upload your clips (optional)</h4>
                        </div>
                      </form>
                      <br>
                      <br>
                      <form action="{{ route('become-a-talent.store.upload', $model->uuid) }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                          <label for=""><h4>More about me (optional)</h4></label>
                          <textarea name="about" id="" cols="30" rows="10" class="form-control" style="resize:none;"></textarea>
                        </div>
                        <div class="form-group">
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </form>
                    
                    

                </div>
            </div>
        </div>
    </div>
</div>
<!-- END SAMPLE FORM PORTLET-->
@endsection
