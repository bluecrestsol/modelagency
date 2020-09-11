<table class="table table-striped table-bordered table-hover table-condensed" id="dataTable">
    <thead>
        <th>Photo</th>
        <th>Name</th>
        <th>Location</th>
        <th>Country</th>
        <th>Last Booking</th>
        <th>Last Login</th>
        <th style="width:180px">Action</th>
    </thead>
    <tbody>
        @foreach($data as $d)
        <tr>
            <td>{!! $d->main_photo !!}</td>
            <td>{{ $d->name }}</td>
            <td>{{ $d->location }}</td>
            <td>{{ $d->country->name }}</td>
            <td>{{ $d->last_booking }}</td>
            <td>{{ $d->last_login }}</td>
            <td>
                <a class="btn btn-info btn-xs" href="{{ route('talents.show', ['id' => $d->id]) }}"><i class="fa fa-edit"></i> Show</a>
                <a class="btn btn-info btn-xs" href="{{ route('talents.books', ['id' => $d->id]) }}"><span class="badge">{{ count($d->books) }}</span> Book</a>
                <a class="btn btn-info btn-xs" href="{{ route('talents.snaps', ['id' => $d->id]) }}"><span class="badge">{{ count($d->snaps) }}</span> Snaps</a>
                <a class="btn btn-info btn-xs" href="{{ route('talents.files.index', ['id' => $d->id]) }}"><span class="badge">{{ $d->files }}</span> Files</a>
                <a class="btn btn-info btn-xs" href="{{ route('models.clips', ['id' => $d->id]) }}"><span class="badge">{{ count($d->models_clips) }}</span> Clips</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@push('js')

@endpush