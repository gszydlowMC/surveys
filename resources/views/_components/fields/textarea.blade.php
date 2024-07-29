@php($id = $config['id'] ?? '')
@if(!empty($config['label'] ?? ''))
    <label class="form-label" @if(!empty($id)) for="{{$id}}" @endif>{{$config['label'] ?? ''}}</label>
@endif
<textarea class="form-control" name="{{$config['name'] ?? ''}}" @if(!empty($id)) id="{{$id}}" @endif placeholder="{{$config['placeholder'] ?? ''}}">{{$config['value'] ?? ''}}</textarea>

