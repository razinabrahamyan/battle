@extends('dashboard.layouts.app', ['header' => 'Permissions')

@section('title','Permissions')

@section('content')
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <form action="{{route('set.permissions')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 mt-lg-4 ml-4">
                                <select id="role" name="role" class="form-control  @if($errors->has('role')) is-invalid @endif" data-toggle="select" title="Simple select"
                                        data-live-search="true" data-live-search-placeholder="Search ...">
                                    <option selected value="">{{__('dashboard.forms.role_select_placeholder')}}</option>
                                    @forelse($roles as $role)
                                        <option value="{{$role->id}}" @if(session('current_role') == $role->id) selected @endif>{{$role->title}}</option>
                                    @empty

                                    @endforelse
                                </select>
                                <div class="invalid-feedback">
                                    @if($errors->has('role'))
                                        {{$errors->first('role')}}
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- Card body -->
                        <div class="card-body">
                            <h3 class="card-title mb-3">Permissions</h3>
                            <div class="row is-invalid">
                                @foreach($permissions as $type => $value )
                                    <div class="col-lg-2 mb-4 ml-4 all_switchers" id="{{$type}}">
                                        <h4 class="text-center">{{$type}}</h4>
                                        <div class="row">
                                            <div class="col-lg-8 text-right">
                                                <span class="text-primary">Check all</span>
                                            </div>
                                            <div class="col-lg-1">
                                                <label class="custom-toggle">
                                                    <input type="checkbox" class="check_all">
                                                    <span class="custom-toggle-slider rounded-circle"></span>
                                                </label>
                                            </div>
                                        </div>
                                        @foreach($value as $data => $item)
                                            <div class="row">
                                                <div class="col-lg-8 text-right">
                                                    {{$item->method}}
                                                </div>
                                                <div class="col-lg-1">
                                                    <label class="custom-toggle">
                                                        <input type="checkbox" data-type="{{$type}}" data-method="{{$item->method}}" name="permissions[{{$type}}][{{$item->method}}]">
                                                        <span class="custom-toggle-slider rounded-circle"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </form>
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

        $("#role").change(function() {
            let id = $(this).children(":checked").attr("value");
            $(".all_switchers :input").each(function () {
                $(this).attr('checked', false)
            });
            getPermissions(id)
        });

        if ("{{session('current_role')}}"){
            let id = "{{session('current_role')}}";
            getPermissions(id)
        }

        function getPermissions(id)
        {
            $.ajax({
                type: 'POST',
                url: '{{route('get.permissions')}}',
                data: {id:id},
                success: function (response) {
                    if (response[1]['admin'] === $('#admin :checkbox').length -1)
                    {
                        $('#admin :first-child').attr('checked', true);
                    }
                    if (response[1]['moderator'] === $('#moderator :checkbox').length -1)
                    {
                        $('#moderator :first-child').attr('checked', true);
                    }
                    if (response[1]['sponsor'] === $('#sponsor :checkbox').length -1)
                    {
                        $('#sponsor :first-child').attr('checked', true);
                    }
                    if (response[1]['verifier'] === $('#verifier :checkbox').length -1)
                    {
                        $('#verifier :first-child').attr('checked', true);
                    }

                    $(".all_switchers :input").each(function () {
                        let self = $(this);
                        let data_type = $(this).attr('data-type');
                        let data_method = $(this).attr('data-method');
                        response[0].map(function (value, index) {
                            if(value.name === data_type && value.method === data_method){
                                self.attr('checked', true)
                            }
                        });
                    })
                },
                error: function (error) {
                    console.log(error)
                }
            });
        }

        $(document).ready(function () {
            $('.check_all').on('change', function () {
                let check = true;
                check = !!$(this).is(':checked');
                let parent = $(this).parent().parent().parent().parent().attr('id');
                $('#' + parent + ' :input').each(function () {
                    $(this).prop('checked', check)
                })
            })
        })

    </script>
@endsection
