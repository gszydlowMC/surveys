@php($id = $config['id'] ?? '')
@if(!empty($config['label'] ?? ''))
    <label class="form-label" @if(!empty($id)) for="{{$id}}" @endif>{{$config['label'] ?? ''}}</label>
@endif
<input class="form-control" type="text" name="{{$config['name'] ?? ''}}"  @if(!empty($id)) id="{{$id}}" @endif value="{{$config['value'] ?? ''}}" placeholder="{{$config['placeholder'] ?? ''}}" @if(isset($config['onkeyup'])) onkeyup="{{$config['onkeyup']}}" @endif/>

