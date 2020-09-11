<table class="table-display table table-striped" id="dataTable">
    <thead>
        <!-- Book Name | Images | Clips | Actions -->
        <th>Book Name</th>
        <th>Images</th>
        <th>Clips</th>
        <th style="width:180px">Actions</th>
    </thead>
    <tbody>
        <tr>
            <td>Full</td>
            <td>{{ $data->book_photos->count() }}</td>
            <td>{{ $data->models_clips->count() }}</td>
            <td>
                <a href="{{ route('books.full', $data->uuid) }}" class="btn btn-info">Items</a>
            </td>
        </tr>

    	@foreach($data->books as $d)
    	<tr>
    		<td>{{ $d->name }}</td>
    		<td>{{ $d->images->count() }}</td>
    		<td>{{ $d->clips->count() }}</td>
    		<td>
                <a href="{{ route('books.show', $d->uuid) }}" class="btn btn-info">Items</a>
                <a href="javascript:;" onclick="edit(this)" data-name="{{ $d->name }}" data-url="{{ route('books.update', $d->id) }}" class="btn btn-primary">Edit</a>
            </td>
    	</tr>
    	@endforeach

        
    </tbody>
</table>

@push('js')
<script>
    function edit(self) {
        var url = $(self).data('url');
        var name = $(self).data('name');
        bootbox.prompt({
            title: "Edit Book",
            value: name,
            callback: function (result) {
                if (result) {
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {'name':result, '_method': 'PUT'},
                        success: function (e) {
                            window.location.reload();
                        },
                        error: function (e) {
                            bootbox.alert('Oops! Something went wrong');
                        }
                    })
                }
            }
        });
    }

</script>
@endpush