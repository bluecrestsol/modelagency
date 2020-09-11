<table class="table table-striped table-bordered table-hover table-condensed" id="dataTable">
    <thead>
        <th width="150px">Photo</th>
        <th>Title</th>
        <th>Model(s)</th>
        <th>Published At</th>
        <th style="width:180px">Action</th>
    </thead>
    <tbody>
    	@foreach($data as $d)
    	<tr>
    		<td><img src="{{ $d->thumb_link }}" class="img-fluid"></img></td>
    		<td>{{ $d->title }}</td>
    		<td>
                {{ $d->model1 ? "{$d->model1->full_name} ({$d->model1->public_name})" : '' }}
                {{ $d->model2 ? ", {$d->model2->full_name} ({$d->model2->public_name})" : '' }}
                {{ $d->model3 ? ", {$d->model3->full_name} ({$d->model3->public_name})" : '' }}
            </td>
    		<td>{{ $d->published_at }}</td>
    		<td>
                <a href="{{ route('jobs.show', ['id' => $d->id]) }}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Show</a>
                <a class="btn btn-info btn-xs" href="{{ route('jobs.images', ['id' => $d->id]) }}"><span class="badge">{{ $d->jobs_photos->count() }}</span> Images</a>
                <a class="btn btn-info btn-xs" href="{{ route('jobs.clips', ['id' => $d->id]) }}"><span class="badge">{{ $d->jobs_clips->count() }}</span> Clips</a>
            </td>
    	</tr>
    	@endforeach
    </tbody>
</table>

