@extends('dashboard.layouts.app', ['header' =>'Categories'])
@section('title', 'Categories')
@section('content')
        <!-- Table -->
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                            <span class="alert-text">{{session('success')}}</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="datatable-buttons">
                            <thead class="thead-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Base ID</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Active</th>
                                    <th>Settings</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Base ID</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Active</th>
                                    <th>Settings</th>
                                </tr>
                            </tfoot>
                            <tbody>
                            @forelse($categories as $category)
                                <tr>
                                    <td>{{$category->id}}</td>
                                    <td class="table-user">
                                        {!!$category->svg!!}
                                    </td>
                                    <td>{{$category->base_id}}</td>
                                    <td>{{$category->title['en']}}</td>
                                    <td>{{$category->description['en']}}</td>
                                    <td>
                                        <label class="custom-toggle">
                                            <input type="checkbox" @if($category->status == 1)  checked="checked" @endif>
                                            <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0; left: 0; transform: translate3d(32px, 32px, 0px);">
                                                <a class="dropdown-item drop_show" href="{{route('category.show', $category->id)}}">Show <span><i class="ni ni-tv-2"></i></span> </a>
                                                <a class="dropdown-item drop_edit" href="{{route('category.edit', $category->id)}}">Edit<span><i class="ni ni-settings"></i></span></a>
                                                <form method="Post" action="{{route('category.destroy',$category->id)}}" id="form_delete_category_{{$category->id}}">
                                                    @csrf
                                                    @method('Delete')
                                                    <button type="button" data-key="{{$category->id}}"  class="dropdown-item drop_delete remove_btn_category" >Delete <span><i class="fa fa-user-times"></i></span></button>
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

                removeAlert('remove_btn_category','form_delete_category_')

            });
        </script>
@stop
