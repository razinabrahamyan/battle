@extends('dashboard.layouts.app')
@section('title', 'Users')
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
                        <table class="table table-flush" id="datatable-buttons">
                            <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Active</th>
                                <th>Verified</th>
                                <th>Country</th>
                                <th>State</th>
                                <th>City</th>
                                <th>Edit</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Active</th>
                                <th>Verified</th>
                                <th>Country</th>
                                <th>State</th>
                                <th>City</th>
                                <th>Edit</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td class="table-user">
                                        <b>{{$user->full_name['first_name'].' '.$user->full_name['last_name']}}</b>
                                    </td>

                                    <td>{{$user->email}}</td>
                                    <td>
                                        <label class="custom-toggle">
                                            <input data-id="{{$user->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $user->deleted_at ? '' : 'checked' }}>
                                            <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes" ></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="custom-toggle">
                                            <input type="checkbox" @if($user->verified == 1)  checked="checked"@endif disabled>
                                            <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                        </label>
                                    </td>

                                    <td>{{$user->country->country['en']}}</td>
                                    <td>{{$user->state->state['en']}}</td>
                                    <td>{{$user->city->city['en']}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light " href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(32px, 32px, 0px);">
                                                <a class="dropdown-item drop_show" href="{{route('users.show', $user->id)}}">Show <span><i class="ni ni-tv-2"></i></span> </a>
                                                <a class="dropdown-item drop_edit edit_btn_administrator" href="{{route('users.edit',$user->id)}}">Edit  <span><i class="ni ni-settings"></i></span></a>
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
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(function() {
                $('.toggle-class').change(function() {
                    var status = $(this).prop('checked') == true ? 1 : 0;
                    var id = $(this).data('id');

                    $.ajax({
                        type: "GET",
                        dataType : "json",
                        url: '{{route('change.user.status')}}',
                        data: {'status': status, 'id': id},
                        success: function(data){
                            $('#success_text').text(data.success)
                            $('#success_alert').show()
                            setTimeout(function () {
                                $('#success_alert').hide()
                            }, 1500)
                        }
                    });
                })
            })
        </script>
    @include('dashboard.includes.data_table_assets')
@stop
