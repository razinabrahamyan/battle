@extends('dashboard.layouts.app', ['header' => 'Battle Settings'])
@section('title', 'Battle Settings')
@section('content')
        <div class="card mb-4">
            <!-- Card header -->
            <div class="card-header">
                <h3 class="mb-0">Form group in grid</h3>
            </div>
            <!-- Card body -->
            <div class="card-body">
                <!-- Form groups used in grid -->
                <form method="post" action="{{route('battle.settings.update')}}">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <label class="form-control-label" for="example3cols1Input">Min counts of Rounds</label>
                                <input type="number" value="{{$settings->attributes['rounds_min']}}" min="1" name="rounds_min" class="form-control" id="example3cols1Input" placeholder="Min counts Rounds">
                                <div class="invalid-feedback" style="display: block">
                                    @if($errors->has('rounds_min'))
                                        {{$errors->first('rounds_min')}}
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <label class="form-control-label" for="example3cols2Input">Max counts of Rounds</label>
                                <input type="number" value="{{$settings->attributes['rounds_max']}}" max="99" name="rounds_max" class="form-control" id="example3cols2Input" placeholder="Max counts Rounds">
                                <div class="invalid-feedback" style="display: block">
                                    @if($errors->has('rounds_max'))
                                        {{$errors->first('rounds_max')}}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-3 form_btn float-right">
                        <a class="btn btn-secondary p-2 " href="{{route('dashboard')}}">Cancel</a>
                        <button type="submit" class="btn btn-primary p-2">Save</button>
                    </div>
                </form>
            </div>
        </div>
@endsection



