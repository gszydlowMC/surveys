@php($id = $config['id'] ?? '')
@if(!empty($config['label'] ?? ''))
    <label class="form-check-label" @if(!empty($id)) for="{{$id}}" @endif>{{$config['label'] ?? ''}}</label>
@endif
<input class="form-check-input" type="radio" name="{{$config['name'] ?? ''}}"  @if(!empty($id)) id="{{$id}}" @endif value="{{$config['value'] ?? ''}}" />

