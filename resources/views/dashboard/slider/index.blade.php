@extends('dashboard.layouts.app', ['header' =>'Sliders'])
@section('title', 'Sliders')
@section('content')
    <!-- Table -->
    <div class="row">
        <div class="col">
            <div class="card">
                <div id="success_alert" style="display: none; position: absolute; width: 100%; z-index: 999" class="alert alert-success alert-dismissible fade show" role="alert">
                    <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                    <span id="success_text" class="alert-text"></span>
                </div>
                <!-- Card header -->
                <div class="table-responsive py-4">
                    <table class="table table-flush test-table" id="test1">
                        <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Country</th>
                            <th>Image</th>
                            <th>Settings</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Country</th>
                            <th>Image</th>
                            <th>Settings</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @forelse($sliders as $slider)
                            <tr>
                                <td>
                                    {{$slider->id}}
                                </td>
                                <td class="table-user">
                                    <a href="{{route('slider.show', $slider->id)}}"><b>{{$slider->title}}</b></a>
                                </td>

                                <td>
                                    {{$slider->description}}
                                </td>
                                <td>
                                    {{$slider->country->country['en']}}
                                </td>
                                <td>
                                    <div class="media align-items-center">
                                        <a href="#" class="rounded-circle mr-3">
                                            <img height="100px" alt="Image placeholder" src="{{asset('storage/user/images/slider/' . $slider->image)}}">
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow"
                                             x-placement="bottom-end"
                                             style="position: absolute; will-change: transform; top: 0; left: 0; transform: translate3d(32px, 32px, 0px);">
                                            <a class="dropdown-item drop_show"
                                               href="{{route('slider.show', $slider->id)}}">Show <span><i
                                                        class="ni ni-tv-2"></i></span> </a>
                                            <a class="dropdown-item drop_edit"
                                               href="{{route('slider.edit', $slider->id)}}">Edit<span><i
                                                        class="ni ni-settings"></i></span></a>
                                            <form method="Post" action="{{route('slider.destroy',$slider->id)}}"
                                                  id="form_delete_slider_{{$slider->id}}">
                                                @csrf
                                                @method('Delete')
                                                <button type="button" data-key="{{$slider->id}}"
                                                        class="dropdown-item drop_delete remove_btn_slider">Delete
                                                    <span><i class="fa fa-user-times"></i></span></button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('dashboard.includes.data_table_assets')
    <script>
        $( document ).ready(function() {
            removeAlert('remove_btn_slider', 'form_delete_slider_');
        });
    </script>
@stop
