@php($id = $config['id'] ?? uniqid(($config['name'] ?? '').'_'))
<label class="form-label" id="{{$id}}">{{$config['label'] ?? ''}}</label>
<select name="{{$config['name'] ?? ''}}" class="form-control select2-simple" id="{{$id}}">
    <option value="">Wybierz</option>
    @foreach($config['options'] as $option)
        <option value="{{ $option->value ?? $option->id ?? '' }}" {{ (($option->value ?? $option->id ?? '') == $config['value']) ? 'selected' : '' }}>{{ $option->label ?? $option->text ?? $option->name ?? '' }}</option>
    @endforeach
</select>

