<div class="row mt-3">
    <div class="col-7">
        <div class="float-start" style="height:50px;">
            <img src="{{(!empty($survey->logo_path ?? '')) ? asset('storage/'.$survey->logo_path) : ''}}"
                 class="d-block w-100 h-100" alt="logo"/>
        </div>
    </div>
    <div class="col-5 position-relative" style="text-align: right;">
        <h3 class="position-absolute pe-3" style="right: 0; bottom:-10px">{{$survey->name}}</h3>
    </div>
</div>
<div class="row mt-3 banner-area">
    <div class="col-12">
        <div class="w-100 box-radius" style="height:250px;">
            <img src="{{(!empty($survey->banner_path ?? '')) ? asset('storage/'.$survey->banner_path) : ''}}"
                 class="d-block w-100 h-100" alt="banner"/>
        </div>

    </div>
</div>

@if(!($start ?? false))
    <div class="row mt-3 progress-area">
        <div class="col-12">
            <div class="w-100 box-radius">
                <div class="progress">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: {{$progress}}%"
                         aria-valuenow="{{$progress}}"
                         aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>

        </div>
    </div>
@endif
