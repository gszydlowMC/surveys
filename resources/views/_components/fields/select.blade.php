@php($id = $config['id'] ?? '')
@if(!empty($config['label'] ?? ''))
    <label class="form-label" @if(!empty($id)) for="{{$id}}" @endif>{{$config['label'] ?? ''}}</label>
@endif
<select name="{{$config['name'] ?? ''}}" class="form-control {{$config['classes'] ?? ''}}"
        @if(!empty($id)) id="{{$id}}" @endif>
    <option value="">Wybierz</option>
    @foreach($config['options'] as $option)
        @php($attribs = '')
        @foreach($config['optionAttributes'] as $attrib)
            @php($attribs .= $attrib.'='.($option->{$attrib} ?? '').' ')
        @endforeach
        <option
            value="{{ $option->value ?? $option->id ?? '' }}" {{ (($option->value ?? $option->id ?? '') == $config['value']) ? 'selected' : '' }} {{$attribs}} >{{ $option->label ?? $option->text ?? $option->name ?? '' }}</option>
    @endforeach
</select>

