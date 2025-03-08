<form method="POST" action="{{route('posts.submit')}}" class="mt-3" enctype="multipart/form-data">
    @csrf
    <div class="card mb-3 hartpiece-rounded-corner">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    @csrf
                    <div class="form-group">
                        <div contenteditable="true" class="form-group hartpiece-rounded-corner contentEditable" name="content" data-placeholder="Share and tell about your artwork?" style="outline:none;padding:10px 15px;">{!!old('content')!!}</div>
                        <textarea id="contentEditable" class="d-none" name="content">{{old('content')}}</textarea>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-3 col-sm-2">
                            <label class="btn btn-sm hartpiece-btn-reverse hartpiece-rounded-corner px-3 mb-0">
                                <input id="content-file" type="file" name="file" class="d-none" accept="image/*" onchange="contentImage(this);">
                                <b>Photo</b>
                            </label>
                        </div>
                        <div class="col-6">
                            <div class="form-check form-check-inline mt-1">
                                <input class="form-check-input" type="radio" name="published"  id="publishedChk" checked value="1">
                                <label class="form-check-label"  for="publishedChk">Publish</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="published" id="draftChk" value="0">
                                <label class="form-check-label" for="draftChk">Draft</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <img id="content-file-preview" src="" alt="" class="img-fluid rounded mx-auto d-block">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-sm btn-block hartpiece-btn-reverse" id="submit-post" disabled><b>Post</b></button>
</form>

@push('scripts')
<script src="{{asset('js/compose.js')}}"></script>
@endpush