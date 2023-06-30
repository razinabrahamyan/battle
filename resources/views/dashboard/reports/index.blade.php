<style>
    .dataTables_paginate {
        display: none;
    }
</style>
@extends('dashboard.layouts.app', ['header' =>'Reports'])
@section('title', 'Reports')
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
                    <div style="z-index:1; width: 250px; position: absolute; left: 22%; display: flex"  class="mt-1">
                        <label style="width: 55%;" for="filter">Filter by: </label>
                        <select id="filter" name="datatable-buttons_length" aria-controls="datatable-buttons"
                                class="custom-select custom-select-sm form-control form-control-sm">
                            <option selected value="">Option</option>
                            <option   value="upcoming">Upcoming</option>
                            <option  selected  value="latest">Latest</option>
                        </select>

                    </div>
                    <table class="table table-flush test-table" id="test1">
                        <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Reporter</th>
                            <th>Reason</th>
                            <th>Report on</th>
                            <th>Additional</th>
                            <th>Date</th>
                            <th>Settings</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Reporter</th>
                            <th>Reason</th>
                            <th>Report on</th>
                            <th>Additional</th>
                            <th>Date</th>
                            <th>Settings</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @forelse($reports as $report)
                            <tr>
                                <td><a href="{{route('reports.show', $report->id)}}"><b>{{$report->id}}</b></a></td>
                                <td class="table-user">
                                    <a href="#"><b>{{$report->reporter->nickname}}</b></a>
                                </td>

                                <td>{{$report->reason->reason}}</td>
                                {{--                                    <td>{{$battle->creatorPlayer->first()->nickname}}</td>--}}
                                <td class="table-user">
                                    @if($report->reportable_type === 'App\User')
                                        <a href="{{route('users.show', $report->reportable->id)}}"><b>{{$report->reportable->nickname}}</b></a>
                                    @else
                                        <a href="{{route('battles.show', $report->reportable->id)}}"><b>{{$report->reportable->title}}</b></a>
                                    @endif

                                </td>
                                <td>

                                    {{Str::limit($report->data['additional'],40,' ...')}}
                                </td>
                                <td>
                                    {{\Carbon\Carbon::parse($report->created_at)->format('d-M-Y  H:i')}}
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
                                               href="{{route('reports.show',$report->id)}}">Show <span><i
                                                        class="ni ni-tv-2"></i></span> </a>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                        </tbody>
                    </table>
                    <div class="card-body mt-0 pt-0">
                        <div class="row justify-content-end">

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('dashboard.includes.data_table_assets')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function () {
            let storage = localStorage.getItem('battles_table_show_count');
            if (storage) {
                $(".dataTables_length option[value=" + storage + "]").prop('selected', true).trigger('change');
            }

            $('.dataTables_length select').on('change', function () {
                localStorage.setItem('battles_table_show_count', $(this).val());
                entries($(this).val());
                console.log($(this).val())
            });

            removeAlert('remove_btn_battle', 'form_delete_battle_');

            function entries(number) {
                $.ajax({
                    type: 'POST',
                    url: '{{route('set.entries')}}',
                    data: {entries: number},
                    success: function (response) {
                        window.location.reload();
                    },
                    error: function (error) {
                        console.log(error)
                    }
                });
            }
        });

        $("#filter").on('change', function () {
            let filter = this.value;
            $.ajax({
                type: 'POST',
                url: '{{route('filter')}}',
                data: {filter: filter},
                success: function (response) {
                    window.location.reload();
                },
                error: function (error) {
                    console.log(error)
                }
            });

        });

        $('#test1').dataTable( {
            "order": []
        } );



    </script>
@stop
