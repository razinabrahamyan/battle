<!--Reject Battle Modal -->
<div class="modal fade battle_modal" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="rejectModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="exampleModalLabel">Reject Reason</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <select name="reason" id="reject_reason" class="form-control">
                    @foreach($reject_reasons as $reason)
                        <option value="{{$reason->id}}">{{$reason->reason}}</option>
                    @endforeach
                </select>
                <div class="form-group mt-2">
                    <label for="reject_textarea">Additional</label>
                    <textarea class=" form-control" name="reject_additional" id="reject_textarea" cols="10" rows="5"></textarea>
                </div>

            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="reject_button" class="btn btn-primary answer_battle_request" data-dismiss="modal" data-attempt="first" data-answer="reject">Send answer</button>
            </div>
        </div>
    </div>
</div>

<!--Finally Reject Battle Modal -->
<div class="modal fade battle_modal" id="rejectModalFinal" tabindex="-1" role="dialog" aria-labelledby="rejectModalFinal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="exampleModalLabel">Mention</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>If you reject this changes this battle will be automatically deleted. Are you sure you want to continue?</p>

            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button"  class="btn btn-primary answer_battle_request" data-dismiss="modal" data-answer="reject" data-attempt="final">Confirm</button>
            </div>
        </div>
    </div>
</div>
<!--Change Battle Modal -->
<div class="modal fade battle_modal" id="changeModal" tabindex="-1" role="dialog" aria-labelledby="changeModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="exampleModalLabel">Change Date/Time</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-between align-items-center p-2">
                    <div class="date w-auto" id="start_date"  data-target-input="nearest">
                        <input required name="start_date" id="start_date_input" type="text" class="@if($errors->has('start_date')) is-invalid @endif() datetimepicker-input"
                               placeholder="dd/mm/yy" value="{{$battle->start_date}}" data-target="#start_date" readonly>
                        @if($errors->has('start_date'))
                            <div class="invalid-feedback">
                                {{ $errors->first('start_date') }}
                            </div>
                        @endif
                    </div>
                    <div class="font-weight-bold"> Start Date</div>
                </div>

                <div class="d-flex justify-content-between align-items-center p-2">
                    <div class="date w-auto" id="time"  data-target-input="nearest">
                        <input required name="time" id="time_input" type="text" class="@if($errors->has('time')) is-invalid @endif() datetimepicker-input"
                               placeholder="dd/mm/yy" value="{{\Carbon\Carbon::create($battle->start_date)->format('H:i')}}" data-target="#time" readonly>
                        @if($errors->has('time'))
                            <div class="invalid-feedback">
                                {{ $errors->first('time') }}
                            </div>
                        @endif
                    </div>
                    <div class="font-weight-bold"> Time</div>
                </div>


            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="change_button" class="btn btn-primary answer_battle_request" data-dismiss="modal" data-attempt="first" data-answer="change">Send answer</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade battle_modal" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="reportModal" aria-hidden="true">
    <div class="modal-dialog" role="document">

        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="exampleModalLabel">Report </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="report_on">Report on</label>
                    <select name="reason" id="report_on" class="form-control">
                        <option value="battle">Battle</option>
                        <option value="{{$battle->request->creator->id}}">{{$battle->request->creator->nickname}}</option>
                        @if($battle->request->answer === 'accepted')<option value="{{$battle->request->joiner->id}}">{{$battle->request->joiner->nickname}}</option>  @endif
                    </select>
                </div>

                <div class="form-group">
                    <label for="report_about">Report about</label>
                    <select name="reason" id="report_about" class="form-control">
                        @foreach($report_reasons as $reason)
                            <option  value="{{$reason->id}}">{{$reason->reason}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mt-2">
                    <label for="reject_textarea">Additional</label>
                    <textarea class=" form-control" name="report_additional" id="report_additional" cols="10" rows="5"></textarea>
                </div>

            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="reject_button" class="btn btn-primary report_about_problem" data-dismiss="modal">Send report</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="inviteModal" tabindex="-1" role="dialog" aria-labelledby="inviteModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title " id="exampleModalLabel">Invite</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-12">
                    <ul class="nav nav-tabs border-0">
                        <li class="active col-6 px-0 auth_modal_li pb-1"><a class="auth_modal_clickable" data-toggle="tab" href="#invite_user">User</a></li>
                        <li class="col-6 px-0 text-right  auth_modal_li pb-1">
                            <a id="register_button" class="auth_modal_clickable" data-toggle="tab"  href="#invite_by_email">By Email</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="invite_user" class="tab-pane active">
                            <form  class="form pt-3">
                                @csrf
                                <div class="form-group mb-2">
                                    <div class="position-relative">
                                        <label class="mb-1">Username</label>
                                        <input class="form-control invite_user_input" autocomplete="off" id="invite_user_input">
                                        <input type="hidden" id="invite_user_value">
                                        <div id="choose_invited_user" class="front_main_background animate__animated ">
                                        </div>
                                    </div>


                                </div>

                                <div class="form-group mb-2" id="invited_user_place">

                                </div>

                                <button id="invite_nickname_button" type="button" class="btn btn-default mt-4" data-dismiss="modal" >Invite</button>
                            </form>
                        </div>

                        <div id="invite_by_email" class="tab-pane">
                            <form class="form pt-3">
                                <div class="form-group mb-2">
                                    <label for="reg_email" class="mb-1">Email</label>
                                    <input  type="email" class="form-control" id="invite_email">
                                </div>
                                <button  data-dismiss="modal" type="button" class="btn btn-default mt-4" id="invite_email_button">Invite</button>
                            </form>

                        </div>

                    </div>
                </div>

            </div>
            <div class="modal-footer border-0">
            </div>
        </div>
    </div>
</div>

