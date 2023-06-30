@extends('dashboard.layouts.app', ['header' => 'Add Battle'])
@section('title','Add Battle ' )
@section('content')
    <div class="row">
        <div class="col">
            <div class="card-wrapper">
                <!-- Custom form validation -->
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        <h3 class="mb-0"></h3>
                    </div>
                    <!-- Card body -->
                    <div class="card-body">
                        <form class="needs-validation" method="POST" action="{{route('store.battle')}}" enctype="multipart/form-data">
                        @csrf
                        <!-- Form -->
                            <div class="form-row">
                                <div class="card-body">
                                    <h6 class="heading-small text-muted mb-4">Battle information</h6>
                                    <div class="pl-lg-4">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <label class="form-control-label" for="title">Title <span class="text-danger">*</span></label>
                                                <input type="text" value="{{old('title')}}" class="form-control @if($errors->has('title')) is-invalid @endif" id="first_name" placeholder="Title" name="title">
                                                <div class="invalid-feedback">
                                                    @if($errors->has('title'))
                                                        {{$errors->first('title')}}
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <label class="form-control-label" for="description">Description  <span class="text-danger">*</span></label>
                                                <input type="text" value="{{old('description')}}" class="form-control @if($errors->has('description')) is-invalid @endif" id="description" placeholder="Description" name="description">
                                                <div class="invalid-feedback">
                                                    @if($errors->has('description'))
                                                        {{$errors->first('description')}}
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <label class="form-control-label" for="last_name">Gap</label>
                                                <input type="text" value="{{old('gap')}}" class="form-control @if($errors->has('gap')) is-invalid @endif" id="gap" placeholder="Gap" name="gap">
                                                <div class="invalid-feedback">
                                                    @if($errors->has('gap'))
                                                        {{$errors->first('gap')}}
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <label class="form-control-label" for="last_name">Rounds</label>
                                                <input type="text" value="{{old('rounds')}}" class="form-control @if($errors->has('rounds')) is-invalid @endif" id="rounds" placeholder="Rounds" name="rounds">
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
                                                            <option value="{{$category->id}}">{{$category->title['en']}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="start_date">Start Date</label>
                                                    <input value="{{ Carbon\Carbon::now(+4)}}" type="text" name="start_date" id="start_date" placeholder="Start Date" data-input>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="end_date">End Date</label>
                                                    <input type="text" name="end_date" id="end_date" placeholder="End Date" data-input>
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
            </div>
        </div>
    </div>
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
