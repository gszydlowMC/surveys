<div class="row">
    <form method="post" action="{{route('admin.subscriber_import.store')}}" class="form-ajax-send" autocomplete="off">
        @csrf
        <input type="hidden" name="saveSubsribers" value="1"/>
        <div class="col-12">
            <ul class="nav nav-tabs" id="xlsPreview" role="tablist">
                @php($k=0)
                @foreach($sheets as $sheetName => $sheet)
                    <li class="nav-item" role="presentation" id="Sheet{{$k}}Nav">
                        <button class="nav-link @if($k==0) active @endif" id="Sheet{{$k}}-tab" data-bs-toggle="tab"
                                data-bs-target="#Sheet{{$k}}" type="button" role="tab" aria-controls="Sheet{{$k}}"
                                aria-selected="true">
                            {{$sheetName}}
                        </button>
                    </li>
                    @php($k++)
                @endforeach
            </ul>
            @php($indexes = [])
            <div class="tab-content" id="myTabContent">
                @php($k=0)
                @foreach($sheets as $sheetName => $sheet)
                    <div class="tab-pane fade @if($k==0) show active @endif" id="Sheet{{$k}}" role="tabpanel"
                         aria-labelledby="Sheet{{$k}}-tab">
                        <h5 class="mt-3">{{$sheetName}}</h5>
                        <div class="table-responsive text-nowrap" style="height:350px;">
                            <table class="table table-bordered data-table">
                                <thead class="sticky-top">
                                <tr>
                                    @foreach($sheet[0] as $columnKey =>$columnValue)
                                        @php($indexes[$sheetName][$columnKey] = \App\Enums\SubscribeImportMapColumnEnum::getList(trim($columnValue)) ?? trim($columnValue))
                                        <th>{{$columnValue}}</th>
                                    @endforeach
                                    <th>{{__('Usuń')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sheet as $rowKey => $row)
                                    @if($rowKey == 0)
                                        @continue
                                    @endif
                                    <tr>
                                        @foreach($row as $columnKey => $columnValue)
                                            <td>
                                                <input class="form-control form-control-sm" type="text" name="subscriber[{{$rowKey}}][{{$indexes[$sheetName][$columnKey]}}]" value="{{$columnValue}}" style="width:150px;"/>
                                            </td>
                                        @endforeach
                                        <td class="p-2">
                                            <a href="#" onclick="$(this).parents('tr').remove();">
                                                <i class="bx bxs-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @php($k++)
                @endforeach
            </div>
        </div>
        @if(!($isBlock ?? false))
            <div class="row">
                <div class="col-12">
                    <div class="float-end w-20" style="text-align:right;">
                        <button class="btn btn-primary" type="submit"><i class="bx bxs-save pe-2"></i>Dopisz uczestników</button>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-danger" role="alert">
                XLS jest niepoprawny. Zobacz sekcje: na czerwono widać błędy.
            </div>
        @endif
    </form>
</div>
