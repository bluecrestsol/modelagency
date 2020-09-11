<h1>NAME: <strong>{{ $data['public_name'] }}</strong></h1>
<p><a href="{{ route('models-promotion.response', ['model_uuid' => $data['model_uuid'], 'customer_uuid' => $data['customer_uuid'], 'response' => 'like']) }}">LIKE</a> | <a href="{{ route('models-promotion.response', ['model_uuid' => $data['model_uuid'], 'customer_uuid' => $data['customer_uuid'], 'response' => 'dislike']) }}">DISLIKE</a></p>
<hr>
<h2>Eyes: {{ $data['eyes'] }}</h2>
<h2>Hair: {{ $data['hair'] }}</h2>
<h2>Shoes: {{ $data['shoes'] }}</h2>

@foreach($data['images'] as $key => $value)
<img src="{{ $value }}" alt="" width="200px">
@endforeach