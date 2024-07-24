@php($id = $config['id'] ?? uniqid(($config['name'] ?? '').'_'))
<label class="form-label" id="{{$id}}">{{$config['label'] ?? ''}}</label>
<input class="form-control" type="text" name="{{$config['name'] ?? ''}}"  id="{{$id}}" value="{{$config['value'] ?? ''}}" placeholder="{{$config['placeholder'] ?? ''}}"/>

