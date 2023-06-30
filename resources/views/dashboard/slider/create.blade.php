@extends('dashboard.layouts.app', ['header' => 'Create slider'])
@section('title','Add category')
@section('content')
    <div class="container-fluid mt--6">
        <div class="card-wrapper">
            <!-- Custom form validation -->
            <div class="card">
                <div class="card-body">
                    @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                            <span class="alert-text"> {{session('success')}}</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <form class="needs-validation" method="POST" action="{{route('slider.store')}}" enctype="multipart/form-data">
                    @csrf
                    <!-- Form -->
                        <div class="form-row">
                            <div class="card-body">
                                <h6 class="heading-small text-muted mb-4">Information</h6>
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label class="form-control-label" for="title">Title <span class="text-danger">*</span></label>
                                            <input type="text" value="{{old('title')}}" class="form-control @if($errors->has('title')) is-invalid @endif" id="title" placeholder="Title" name="title">
                                            <div class="invalid-feedback">
                                                @if($errors->has('title'))
                                                    {{$errors->first('title')}}
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="svg">Description <span class="text-danger">*</span></label>
                                                <textarea name="description" class="form-control" id="description" rows="3" >{{old('description')}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <label class="form-control-label" for="country">Country <span class="text-danger">*</span></label>
                                            <select type="text" value="{{old('country')}}" class="form-control @if($errors->has('country')) is-invalid @endif" id="country" placeholder="Country" name="country">
                                                @foreach($countries as $country)
                                                    <option value="{{$country->id}}">{{$country->country['en']}}</option>
                                                @endforeach

                                            </select>
                                            <div class="invalid-feedback">
                                                @if($errors->has('country'))
                                                    {{$errors->first('country')}}
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <label class="form-control-label" for="style">Image <span class="text-danger">*</span></label>
                                            <div class="">
                                                <input type="file" style="display: none" name="image" id="image">
                                                <button type="button" class="btn btn-warning" id="image_upload_button">Upload Slide Picture</button>
                                                <p class="pt-1 mb-0">Must be JPEG, PNG, or GIF and cannot exceed 3MB</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div id="profile_image_div">
                                                <img id="profile_image" src="{{asset('storage/admin/category_images/image.png')}}" >
                                            </div>
                                            <div class="invalid-feedback" style="display: block">
                                                @if($errors->has('image'))
                                                    {{$errors->first('image')}}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End Form -->
                        <div class="p-3 form_btn float-right">
                            <a class="btn btn-secondary p-2 " href="{{route('category.index')}}">Cancel</a>
                            <button type="submit" class="btn btn-primary p-2">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#image_upload_button').click(function () {
                $('#image').trigger('click');
            });
            function previewFile() {
                let preview = document.getElementById('profile_image');
                let file    = document.querySelector('input[type=file]').files[0];
                let reader  = new FileReader();
                reader.addEventListener("load", function () {
                    preview.src = reader.result;
                }, false);
                if (file) {
                    reader.readAsDataURL(file);
                }
            }

            $('#image').change(function () {
                previewFile();
            });
        })
    </script>
@stop
