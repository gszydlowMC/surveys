<div class="table-responsive text-nowrap sortable-compontent position-relative"
         style="height:{{$config['height'] ?? '500px'}};"
>
    <table class="table table-bordered data-table" data-url="" id="{{$config['id'] ?? uniqid('table_')}}">
        <thead class="position-sticky bg-white z-3" style="top:0;">
        <tr>
            @if(isset($config['checkbox']))
                <th><input type="checkbox" class="select-all form-check-input"/></th>
            @endif
                <th class="text-left">Lp</th>
            @foreach($config['columns'] as $column)
                <th class="text-left">
                    @if($column['sort'] ?? false)
                        @sortablelink($column['alias'], $column['text'])
                    @else
                        {{$column['text']}}
                    @endif
                </th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        @forelse($config['data'] ?? [] as $lp => $row)
            <tr id="{{$row->id ?? ''}}"
                class="@if(isset($row->status, $config['red_status']) && $row->status === $config['red_status']) table-danger @endif">
                @if(isset($config['checkbox']))
                    <td class="text-left">
                        <input type="checkbox" class="form-check-input check-row"
                               name="{{$config['checkbox']}}[]" value="{{$row->id ?? ''}}"/>
                    </td>
                @endif
                <td class="text-left">
                    {{$lp+1}}
                </td>
                @forelse($config['columns'] as $column)
                    @if(isset($column['view']))
                        <td class="text-left">@include($column['view'], ['item' => $row])</td>
                    @else
                        <td class="text-left">{!! $row->{$column['alias'] ?? ''} ?? '' !!}</td>
                    @endif
                @empty
                    <td></td>
                @endforelse
            </tr>
        @empty
            <tr>
                <td colspan="{{count((array) $config['data'])}}">{{__('Brak danych')}}</td>
            </tr>
        @endforelse
        </tbody>
        @if(!empty($config['tfoot']))
            <tfoot>
                <tr>
                    <td colspan="{{count((array) $config['data'])}}">
                        @include($config['tfoot'])
                    </td>
                </tr>
            </tfoot>
        @endif
    </table>
    @if(($config['paginate'] ?? true) && method_exists($config['data'], 'withQueryString'))
        {!! $config['data']->withQueryString()->links('pagination::bootstrap-5') !!}
    @endif
</div>
