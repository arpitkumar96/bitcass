<div class="modal-content animated flipInY">
    <div class="modal-header">
        <button type="button" class="close" onclick="closeModal()"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Withdrawal Request</h4>
        <div class="text-left">
            <b>Request Id: </b>{{$withdrawal_request->withdrawal_request_id}} <br>
            <b>User Id: </b>{{$withdrawal_request->user->user_id}} <br>
            <b>User Phone: </b>{{$withdrawal_request->user->phone_number}} <br>
            <b>Bank Name: </b>{{$withdrawal_request->user->bankDetail->bank_name}} <br>
            <b>A/C number: </b>{{$withdrawal_request->user->bankDetail->account_number}} <br>
            <b>IFSC Code: </b>{{$withdrawal_request->user->bankDetail->ifsc_code}} <br>
            <b>Phone: </b>{{$withdrawal_request->user->bankDetail->phone_number}} <br>
            <b>Email: </b>{{$withdrawal_request->user->bankDetail->email}} <br>
            <b>Amount: </b>₹ {{$withdrawal_request->amount}} <br>
            <b>Change Status: </b>@if($status == 'success')
                                        <span class="badge badge-primary">Confirm</span>
                                    @elseif($status == 'cancel')
                                        <span class="badge badge-danger">Cancel</span>
                                    @endif
        </div>
    </div>
    <form class="form-example" action="{{route('admin.withdrawal.request.status',$withdrawal_request->id)}}" id="withdrawal_request_form" method="POST">
        @csrf
        <input type="hidden" name="status" value="{{$status}}">
        <div class="modal-body">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Remark</label>
                    <textarea name="remark" id="modal_remark" class="form-control"></textarea>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger dim"  onclick="closeModal()">Close</button>
            <button type="button" class="btn btn-w-m btn-primary dim" onclick="submitForm()"><i class="fa fa-floppy-o"></i> Save</button>
        </div>
    </form>
</div>
