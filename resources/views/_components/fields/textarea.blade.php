@php($id = $config['id'] ?? '')
@if(!empty($config['label'] ?? ''))
    <label class="form-label" @if(!empty($id)) for="{{$id}}" @endif>{{$config['label'] ?? ''}}</label>
@endif
<textarea class="form-control {{$config['classes'] ?? ''}}" name="{{$config['name'] ?? ''}}" @if(!empty($id)) id="{{$id}}" @endif placeholder="{{$config['placeholder'] ?? ''}}" @if(isset($config['onkeyup'])) onkeyup="{{$config['onkeyup']}}" @endif>{{$config['value'] ?? ''}}</textarea>

