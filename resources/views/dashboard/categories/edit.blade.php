@extends('dashboard.layouts.app', ['header' => $category->title['en']])
@section('title', 'Edit ID : ' . $category->id)
@section('content')
    <div class="card">
        <!-- Card header -->
        <div class="card-header">
            <h3 class="mb-0">Browser defaults</h3>
        </div>
        <!-- Card body -->
        <form class="needs-validation" method="POST" enctype="multipart/form-data" action="{{route('category.update', $category->id)}}">
        @csrf
        @method('put')
        <!-- Form -->
            <div class="form-row">
                <div class="card-body">
                    <h6 class="heading-small text-muted mb-4">Personal  information</h6>
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-4">
                                <label class="form-control-label" for="title">Title <span class="text-danger">*</span></label>
                                <input type="text" value="{{old('title', $category->title['en'])}}" class="form-control @if($errors->has('title')) is-invalid @endif" id="" placeholder="Title" name="title">
                                <div class="invalid-feedback">
                                    @if($errors->has('title'))
                                        {{$errors->first('title')}}
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label class="form-control-label" for="description">Description  <span class="text-danger">*</span></label>
                                <input type="text" value="{{old('description', $category->description['en'])}}" class="form-control @if($errors->has('en')) is-invalid @endif" id="" placeholder="Description" name="description">
                                <div class="invalid-feedback">
                                    @if($errors->has('description'))
                                        {{$errors->first('description')}}
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label class="form-control-label" for="base_id">Base ID</label>
                                <input type="text" value="{{old('base_id', $category->base_id )}}" class="form-control @if($errors->has('base_id')) is-invalid @endif" id="" placeholder="Base ID" name="base_id">
                                <div class="invalid-feedback">
                                    @if($errors->has('base_id'))
                                        {{$errors->first('base_id')}}
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <label class="form-control-label" for="style">Style  <span class="text-danger">*</span></label>
                                <input type="text" value="{{old('style', $category->style)}}" class="form-control @if($errors->has('style')) is-invalid @endif" id="" placeholder="Style" name="style">
                                <div class="invalid-feedback">
                                    @if($errors->has('style'))
                                        {{$errors->first('style')}}
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="svg">SVG <span class="text-danger">*</span></label>
                                    <textarea name="svg" class="form-control" id="svg" rows="3" >{{old('svg', $category->svg)}}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="start_date">Start Date</label>
                                    <input value="{{old('start_date', $category->start_date)}}" type="text" name="start_date" id="start_date" placeholder="Start Date" data-input>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="end_date">End Date</label>
                                    <input value="{{old('end_date', $category->end_date)}}" type="text" name="end_date" id="end_date" placeholder="End Date" data-input>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Form -->
            <div class="p-3 form_btn float-right">
                <a class="btn btn-secondary p-2 " href="">Cancel</a>
                <button type="submit" class="btn btn-primary p-2">Save</button>
            </div>
        </form>
        </div>
    </div>

    <script>

        function previewImage() {
            var previewImg = document.querySelector('#image');
            var fileImg    = document.querySelector('#img').files[0];
            var readerImg  = new FileReader();

            readerImg.addEventListener("load", function () {
                previewImg.src = readerImg.result;
            }, false);

            if (fileImg) {
                readerImg.readAsDataURL(fileImg);
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script type="text/javascript">
        $("#start_date, #end_date").flatpickr({
            altInput: true,
            altFormat: "F j, Y H:i",
            enableTime: true,
            dateFormat: "Y-m-d H:i",
        });
    </script>
@stop
