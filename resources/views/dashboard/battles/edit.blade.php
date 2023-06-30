@extends('dashboard.layouts.app', ['header' => 'Edit'])
@section('title', 'Edit ID : ' . $battle->id)
@section('content')
    <div class="card">
        <!-- Card header -->
        <div class="card-header">
            <h3 class="mb-0">Browser defaults</h3>
        </div>
        <!-- Card body -->
        <form class="needs-validation" method="POST" enctype="multipart/form-data" action="{{route('battles.update', $battle->id)}}">
        @csrf
        @method('put')
        <!-- Form -->
            <div class="form-row">
                <div class="card-body">
                    <h6 class="heading-small text-muted mb-4">Battle information</h6>
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-4">
                                <label class="form-control-label" for="title">Title<span class="text-danger">*</span></label>
                                <input type="text" value="{{old('title', $battle->title)}}" class="form-control @if($errors->has('title')) is-invalid @endif" id="" placeholder="Title" name="title">
                                <div class="invalid-feedback">
                                    @if($errors->has('title'))
                                        {{$errors->first('title')}}
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label class="form-control-label" for="description">Description<span class="text-danger">*</span></label>
                                <input type="text" value="{{old('description', $battle->description)}}" class="form-control @if($errors->has('description')) is-invalid @endif" id="" placeholder="Description" name="description">
                                <div class="invalid-feedback">
                                    @if($errors->has('description'))
                                        {{$errors->first('description')}}
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label class="form-control-label" for="title">Gap<span class="text-danger">*</span></label>
                                <input type="text" value="{{old('gap',$battle->gap )}}" class="form-control @if($errors->has('gap')) is-invalid @endif" id="" placeholder="Gap" name="gap">
                                <div class="invalid-feedback">
                                    @if($errors->has('gap'))
                                        {{$errors->first('gap')}}
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label class="form-control-label" for="rounds">Rounds<span class="text-danger">*</span></label>
                                <input type="text" value="{{old('rounds', $battle->rounds)}}" class="form-control @if($errors->has('rounds')) is-invalid @endif" id="" placeholder="Gap" name="rounds">
                                <div class="invalid-feedback">
                                    @if($errors->has('rounds'))
                                        {{$errors->first('rounds')}}
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="category">Category</label>
                                    <select name="category_id" class="form-control" id="category">
                                        @foreach($categories as $category)
                                            <option @if($battle->category->id == $category->id) selected @endif value="{{$category->id}}">{{$category->title['en']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <div><p class="verify_text pr-3">Verified</p></div>
                                    <label class="custom-toggle ">
                                        <input type="checkbox" @if($battle->verified == 1)  checked="checked" @endif name="verified">
                                        <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                    </label>
                                </div>
                            </div>

{{--                            <div class="col-lg-4">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label class="custom-toggle">--}}
{{--                                        <input type="checkbox" checked="checked">--}}
{{--                                        <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                        <div class="row">
{{--                           --}}
                        </div>
                    </div>
                </div>
            </div>
            <!--End Form -->
            <div class="p-3 form_btn float-right">
                <a class="btn btn-secondary p-2 " href="{{URL::previous()}}">Cancel</a>
                <button type="submit" class="btn btn-primary p-2">Save</button>
            </div>
        </form>
        </div>
    </div>
@stop
