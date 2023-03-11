@foreach($oxen as $ox)
<option value="{{ $ox->id }}">{{ $ox->name }}</option>
@endforeach