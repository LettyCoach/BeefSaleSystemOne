@foreach($oxen as $ox)
<option value="{{ $ox->id }}">{{ $ox->registerNumber }}</option>
@endforeach