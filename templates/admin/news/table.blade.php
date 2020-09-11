<table class="table table-striped table-bordered table-hover table-condensed" id="dataTable">
    <thead>
        <th>Title</th>
        <th>Published At</th>
        <th style="width:180px">Action</th>
    </thead>
    <tbody>
    	@foreach($data as $d)
    	<tr>
    		<td>{{ $d->title }}</td>
    		<td>{{ $d->published_at }}</td>
    		<td>
                <a href="{{ route('news.show', ['id' => $d->id]) }}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Show</a>
                <a class="btn btn-info btn-xs" href="{{ route('news.images', ['id' => $d->id]) }}"><span class="badge">{{ $d->news_photos->count() }}</span> Images</a>
                <a class="btn btn-info btn-xs" href="{{ route('news.clips', ['id' => $d->id]) }}"><span class="badge">{{ $d->news_clips->count() }}</span> Clips</a>
            </td>
    	</tr>
    	@endforeach
    </tbody>
</table>

