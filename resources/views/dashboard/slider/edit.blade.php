@extends('dashboard.layouts.app', ['header' => $slider->title])
@section('title', 'Edit ID : ' . $slider->id)
@section('content')
    <div class="card">
        <!-- Card header -->
        <div class="card-header">
            <h3 class="mb-0">Browser defaults</h3>
        </div>
        <!-- Card body -->
        <form class="needs-validation" method="POST" enctype="multipart/form-data" action="{{route('slider.update', $slider->id)}}">
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
                                <input type="text" value="{{old('title', $slider->title)}}" class="form-control @if($errors->has('title')) is-invalid @endif" id="" placeholder="Title" name="title">
                                <div class="invalid-feedback">
                                    @if($errors->has('title'))
                                        {{$errors->first('title')}}
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label class="form-control-label" for="description">Description  <span class="text-danger">*</span></label>
                                <input type="text" value="{{old('description', $slider->description)}}" class="form-control @if($errors->has('en')) is-invalid @endif" id="" placeholder="Description" name="description">
                                <div class="invalid-feedback">
                                    @if($errors->has('description'))
                                        {{$errors->first('description')}}
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label class="form-control-label" for="country">Country <span class="text-danger">*</span></label>
                                <select type="text" value="{{old('country')}}" class="form-control @if($errors->has('country')) is-invalid @endif" id="country" placeholder="Country" name="country">
                                    @foreach($countries as $country)
                                        <option @if($country->id == $slider->country_id) selected @endif @if(old('country') == $country->id ) selected @endif  value="{{$country->id}}">{{$country->country['en']}}</option>
                                    @endforeach

                                </select>
                                <div class="invalid-feedback">
                                    @if($errors->has('country'))
                                        {{$errors->first('country')}}
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <h6 class="heading-small text-muted mb-4">image</h6>
                            <div >
                                <img style="height: 200px"  id="image" src="{{asset('storage/user/images/slider/'. $slider->image)}}" class=" fit-contain" >
                            </div>
                            <input type="file" name="image" class="form-control-file" id="img" onchange="previewImage()">
                            <div class="invalid-feedback" style="display: block">
                                @if($errors->has('image'))
                                    {{$errors->first('image')}}
                                @endif
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
@stop
