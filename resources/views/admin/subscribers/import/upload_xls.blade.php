<div class="col-11">
    <form name="AttachmentForm" action="{{route('admin.subscriber_import.store')}}" method="post" autocomplete="off"
          enctype="enctype='multipart/form-data" class="row my-2">
        <input type="hidden" name="xls" value="1" />
        @csrf
        <div class="col-4 mx-2">
            <div class="mb-3">
                <label for="formFile" class="form-label">Dodaj XLS</label>
                <input class="form-control" name="files[]" type="file" id="formFile" accept=".xlsx, .xls">
            </div>
        </div>
        <div class="col-2 mx-2">
            <div class="mt-4">
                <a class="ref" ref="UploadObject.sendAjax" role="button">
                    <button class="btn btn-primary btn-sm mt-2" type="button">
                                <span>
                                    <i class="bx bx-file me-sm-1"></i> Wyślij plik
                                </span>
                    </button>
                </a>
            </div>
        </div>
    </form>
</div>
