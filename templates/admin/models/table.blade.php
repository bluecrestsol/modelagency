<table class="table table-striped table-bordered table-hover table-condensed" id="dataTable">
    <thead>
        <th>Photo</th>
        <th>Name</th>
        <th>Public Name</th>
        <th>Status</th>
        <th>Country</th>
        <th>Agency</th>
        <th>Agency Country</th>
        <th>Last Booking</th>
        <th>Last Login</th>
        <th style="width:180px">Action</th>
    </thead>
    <tbody>
        @foreach($data as $d)
        <tr>
            <td>{!! $d->main_photo !!}</td>
            <td>{{ $d->name }}<br>
                <small><strong>{{ strtoupper($d->availability) }}</strong></small>
            </td>
            <td>{{ $d->public_name }}<br>
                <small><strong>{{ $d->exclusive_label }}</strong></small>
            </td>
            <td>{!! ucfirst(config('constants.models.status.'.$d->status)) !!}</td>
            <td>{{ $d->country->name }}</td>
            <td>{{ $d->agency_name }}</td>
            <td>{{ $d->agency ? $d->agency->country->name:'' }}</td>
            <td>{{ $d->last_booking }}</td>
            <td>{{ $d->last_login }}</td>
            <td>
                <a class="btn btn-info btn-xs" href="{{ route('models.show', ['id' => $d->id]) }}"><i class="fa fa-edit"></i> Show</a>
                <a class="btn btn-info btn-xs" href="{{ route('models.book_photos', ['id' => $d->id]) }}"><span class="badge">{{ count($d->book_photos) }}</span> Book</a>
                <a class="btn btn-info btn-xs" href="{{ route('models.snap_photos', ['id' => $d->id]) }}"><span class="badge">{{ count($d->snap_photos) }}</span> Snaps</a>
                <a class="btn btn-info btn-xs" href="{{ route('models.books', $d->id) }}"><span class="badge">{{ (count($d->books)+1) }}</span> Books</a>
                <a class="btn btn-info btn-xs" href="{{ route('models.files.index', ['id' => $d->id]) }}"><span class="badge">{{ $d->files }}</span> Files</a>
                <a class="btn btn-info btn-xs" href="{{ route('models.clips', ['id' => $d->id]) }}"><span class="badge">{{ count($d->models_clips) }}</span> Clips</a>
                @if($d->comp_card !== NULL)
                <a class="btn btn-info btn-xs" target="_blank" href='{{ asset("storage/uploads/photos/comp_cards/{$d->comp_card}") }}'>Comp Card</a>
                @endif 
                <a class="btn btn-info btn-xs" href="{{ route('models.show-promote', $d->uuid) }}">Promote</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@push('js')

@endpush