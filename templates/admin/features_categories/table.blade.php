<table class="table table-striped table-bordered table-hover table-condensed" id="reorder-datatable">
    <thead>
        <th>Seq</th>
        <th>Name</th>
        <th style="width:250px">Action</th>
    </thead>
    <tbody>
    	@foreach($data as $d)
    	<tr>
            <td>{{ $d->seq }}</td>
    		<td>{{ $d->name }}</td>
    		<td>
                <a href="{{ route('features.show', ['id' => $d->id]) }}" class="btn btn-primary">
                    <i class="fa fa-edit"></i> Show
                </a>
                <a href="{{ route('features.list', ['caregory_id' => $d->id]) }}" class="btn btn-primary">
                    <i class="fa fa-edit"></i> Features <span class="badge">{{ $d->features->count() }}</span>
                </a>
            </td>
    	</tr>
    	@endforeach
    </tbody>
</table>

@push('js')
<script>
    $(document).ready(function() {
        var table = $('#reorder-datatable').DataTable({
            "oLanguage": {
                    "oPaginate": {
                        "sPrevious": "<",
                        "sNext": ">"
                    }
                },

            "rowReorder" : true
        });
     
        table.on( 'row-reorder', function ( e, diff, edit ) {
            
            var result = [];
            var url = "{{ route('features.row-reorder') }}";

            for ( var i=0, ien=diff.length ; i<ien ; i++ ) {
                var rowData = table.row( diff[i].node ).data();
     
                // result += rowData[1]+' updated to be in position '+
                //     diff[i].newData+' (was '+diff[i].oldData+')<br>';

                var obj = {
                    'old' : diff[i].oldData,
                    'new' : diff[i].newData
                };

                result.push(obj);
            }

            var data = {
                result: result
            }
            
                
            $.ajax({
                type    : 'POST',
                url     : url,
                data    : data,
                success : function(response) {
                    console.log(response);
                }
            });
     
        });
    });

</script>
@endpush

