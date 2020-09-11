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
                        <h1> Edit Job Clips</h1>
                    </div>
                </div>
                <div class="portlet-body form">
    
                    <div class="alert alert-danger error-container" style="display: none;">
                        <ul></ul>
                    </div>

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
                    <div class="row">
                        <div class="col-xs-12">
                            <form role="form" method="POST" id="imagesUploadForm" action="{{ route('jobs.clips.store', $data->id) }}" enctype="multipart/form-data">
                            {!! csrf_field() !!}
                              <input type="file" name="clips[]" multiple required onchange="return upload();" />
                              <!-- <span class="font-red-mint" style="font-size: 13px">* Upload only jpg images with 600px on long size</span> -->
                            </form>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xs-12">
                            <ul id="sortable">
                                @foreach($clips as $i)
                                <li id="{{ 'order_'.$i->id }}" data-filename="{{ $i->filename }}" class="ui-state-default">
                                    <button type="button" class="close btn-delete-image" data-url="{{ route('jobs.clips.destroy', $i->id) }}" style="z-index: 10;">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Close</span>
                                     </button>
                                    <video width="100%" controls class="handle">
                                      <source src="{{ asset('storage/uploads/clips/jobs/'.$i->filename) }}">
                                    Your browser does not support the video tag.
                                    </video>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END SAMPLE FORM PORTLET-->
@endsection

@push('css')
<style>
   #sortable { 
        list-style-type: none; 
        display: block;
        width: 100%;
    }
   #sortable li {
        display: inline-block;
        position: relative;
        width: 200px;
        /*height: 250px;*/
        cursor: pointer;
    }
  
   /*#sortable li img {
        width: 100%;
   }*/

   #sortable li:hover {
        opacity: .95;
   }

   #sortable li button {
        position: absolute;
        right: 6px;
        top: 10px;
   }
    .ui-state-highlight {
        background: #eee;
        border: 2px dashed #ccc;
    }
</style>
@endpush

@push('js')
<script type="text/javascript">

    function upload() {
        var form = $('#imagesUploadForm');

        var formData = new FormData(form[0]);

        var url = form.attr("action");
        formData.append("label", "WEBUPLOAD");
       
        bootbox.dialog({
            message: '<p><i class="fa fa-spin fa-spinner"></i> Uploading...</p>'
        });

        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            processData: false,  // tell jQuery not to process the data
            contentType: false,   // tell jQuery not to set contentTypes

            success: function(r) {
                location.reload();
            },

            error: function(r) {
                
                var errors = r.responseJSON;
                var html = '';
                $.each(errors, function(index, value){
                    html += '<li>' + value + '</li>';
                });
                bootbox.hideAll();
                $('.error-container').fadeIn().find('ul').html(html);
            }
        }); 

        return false;
    }

    $(document).ready(function(){
        $("#sortable" ).disableSelection();
        $("#sortable").sortable({
            placeholder: 'ui-state-highlight',
            handle: '.handle',
            stop: function() {
                var order = $(this).sortable('serialize');

                var url = "{{ route('jobs.clips.update') }}";
                //sort
                
                $.post(url, order).done(function(r){
                    console.log("sorted");
                }).fail(function(){
                    alert("Something went wrong");
                });
            }
        });

        // $('#sortable li img').on('click', function() {
        //     var src = $(this).attr('src');
        //     bootbox.dialog({
        //         message: '<img src="'+src+'" class="img-responsive" style="width:100%">'
        //     });
        // });

        $('.btn-delete-image').on('click', function(e) {
            e.preventDefault();
            var self = $(this);
            var url = $(this).data('url');
            bootbox.confirm("Delete this clip?", function(result){
                if(result) {

                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: {_method:'DELETE', job_id:"{{ $data->id }}"},

                        success: function(r) {
                            self.closest('li').remove();
                        },

                        error: function(r) {
                            alert("something went wrong");
                        }
                    });
                    
                }
            });
        });
    });
</script>
@endpush
