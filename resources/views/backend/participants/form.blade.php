@php
    $registration = $registration ?? collect([]);
    $event = $event ?? collect([]);
    $user = $user ?? collect([]);
    $guests = $guests ?? collect([]);
    $house = collect([]);
    $kidAbove = collect([]);
    $kidBelow = collect([]);
    $maid = collect([]);
    $couple = collect([]);
    $driver = collect([]);
    $other = collect([]);
if($registration->has('guests')){
    foreach ($registration->guests as $guest) {
        if ($guest->type === \App\Models\Registration::TYPE_GUEST_KID_ABOVE) {
            $kidAbove->push($guest);
        } elseif ($guest->type === \App\Models\Registration::TYPE_GUEST_KID_BELOW){
            $kidBelow->push($guest);
        }
        else if($guest->type === \App\Models\Registration::TYPE_GUEST_MAID) {
            $maid->push($guest);
        } else if($guest->type === \App\Models\Registration::TYPE_GUEST_COUPLE) {
            $couple->push($guest);
        } else if($guest->type === \App\Models\Registration::TYPE_GUEST_DRIVER) {
            $driver->push($guest);
        } else if($guest->type === \App\Models\Registration::TYPE_GUEST_OTHER) {
            $other->push($guest);
        }
    }
}
@endphp
<?php
if ($registration && $registration->has('payment') && $registration->payment->status == \App\Models\Payment::STATUS_PAID) {
    $readonly = true;
} else {
    $readonly = false;
}
// then, where you need an input to be readonly do:
?>
<div class="form-row">
    <div class="form-group col-md-6">
        <label>Name</label>
        <input type="text" class="form-control" name="name"
               value="{{ old('name') ?? data_get($registration, 'name') }}" @if($readonly) readonly @endif>
    </div>
    <div class="form-group col-md-6">
        <label>Email</label>
        <input type="text" class="form-control" name="email"
               value="{{ old('email') ?? data_get($registration, 'email')  }}" @if($readonly) readonly @endif>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label>Phone Number</label>
        <input type="text" class="form-control" name="phone"
               value="{{ old('phone') ?? data_get($registration, 'phone')  }}" @if($readonly) readonly @endif>
    </div>
    {{--    //organization ta event table a--}}
    <div class="form-group col-md-6">
        <label>Organization</label>
        <input type="text" class="form-control" name="organization"
               value="{{ old('organization') ?? data_get($event, 'organization')  }}" @if($readonly) readonly @endif>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label>Address</label>
        <input type="text" class="form-control" name="address"
               value="{{ old('address') ?? data_get($registration, 'address')  }}" @if($readonly) readonly @endif>
    </div>
    {{--    //organization ta event table a--}}
    <div class="form-group col-md-6">
        <label>Batch</label>
        <input type="text" class="form-control" name="batch"
               value="{{ old('batch') ?? data_get($registration, 'batch')  }}" @if($readonly) readonly @endif>
    </div>
</div>
<div class="form-row">

    <div class="form-group col-md-6">
        <label>Marital Status</label>
        <select id="marital_status" name="marital_status" class="form-control select1"
                @if($readonly) disabled="disabled" @endif>
            <option
                value="{{ \App\Models\Registration::MARITAL_STATUS_SINGLE }}" {{ data_get($registration, 'marital_status') == \App\Models\Registration::MARITAL_STATUS_SINGLE ? 'selected' : ''}}>{{ \App\Models\Registration::MARITAL_STATUS_SINGLE}}</option>

            <option type="button" id="btn_married"
                    value="{{ \App\Models\Registration::MARITAL_STATUS_MARRIED }}" {{ data_get($registration, 'marital_status') == \App\Models\Registration::MARITAL_STATUS_MARRIED ? 'selected' : ''}}>{{ \App\Models\Registration::MARITAL_STATUS_MARRIED}}</option>
        </select>
    </div>
    <div class="form-group col-md-6">
        <label>Cadet Number</label>
        <input type="text" class="form-control" name="cadet_number"
               value="{{ old('cadet_number') ?? data_get($registration, 'cadet_number')  }}"
               @if($readonly) readonly @endif>
    </div>

</div>
<div id="add_kid">
    <div class="form-row" id="remove">
        <div class="form-group col-md-6">
            <label>Kid Above 6</label>
            <div class="input-group ">
                <input id="kidAbove" type="text" class="form-control" name="kidAbove"
                       value="{{ old('') ?? $kidAbove->first()->quantity ?? 0  }}"
                       @if($readonly) readonly @endif>
                <div class="input-group-append">
                    <div class="input-group-text ">
                        <i id="edit_kidAbove" type="button" class="fas fa-edit "></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label>Kid Below 6</label>
            <div class="input-group ">
                <input id="kidBelow" type="text" class="form-control" name="kidBelow"
                       value="{{ old('') ?? $kidBelow->first()->quantity ?? 0  }}"
                       @if($readonly) readonly @endif>
                <div class="input-group-append">
                    <div class="input-group-text ">
                        <i id="edit_kidBelow" type="button" class="fas fa-edit "></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label>Driver</label>
        <div class="input-group ">
            <input id="driver" type="text" class="form-control" name="driver"
                   value="{{ old('') ?? $driver->first()->quantity ?? 0  }}"
                   @if($readonly) readonly @endif>
            <div class="input-group-append">
                <div class="input-group-text ">
                    <i id="edit_driver" type="button" class="fas fa-edit "></i>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group col-md-6">
        <label>Maid</label>
        <div class="input-group ">
            <input id="maid" type="text" class="form-control" name="maid"
                   value="{{ old('') ?? $maid->first()->quantity ?? 0   }}"
                   @if($readonly) readonly @endif>
            <div class="input-group-append">
                <div class="input-group-text ">
                    <i id="edit_maid" type="button" class="fas fa-edit "></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label>Guest</label>
        <div class="input-group ">
            <input id="guest" type="text" class="form-control" name="other"
                   value="{{ old('') ?? $other->first()->quantity ?? 0  }}"
                   @if($readonly) readonly @endif>
            <div class="input-group-append">
                <div class="input-group-text ">
                    <i id="edit_guest" type="button" class="fas fa-edit"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group col-md-6">
        <label>Payment Status</label>
        <select id="payment_status" name="payment_status" class="form-control select1"
                @if($readonly) disabled="disabled" @endif>
            <option
                value="{{ \App\Models\Payment::STATUS_PROCESSING }}" {{ $registration && $registration->has('payment') && $registration->payment->status == \App\Models\Payment::STATUS_PROCESSING ? 'selected' : ''}}>{{ \App\Models\Payment::STATUS_PROCESSING}}</option>
            <option
                value="{{ \App\Models\Payment::STATUS_PAID }}" {{ $registration && $registration->has('payment') && $registration->payment->status == \App\Models\Payment::STATUS_PAID ? 'selected' : ''}}>{{ \App\Models\Payment::STATUS_PAID}}</option>
            <option
                value="{{ \App\Models\Payment::STATUS_PENDING }}" {{ $registration && $registration->has('payment') && $registration->payment->status == \App\Models\Payment::STATUS_PENDING ? 'selected' : ''}}>{{ \App\Models\Payment::STATUS_PENDING}}</option>
            <option
                value="{{ \App\Models\Payment::STATUS_FAILED }}" {{ $registration && $registration->has('payment') && $registration->payment->status == \App\Models\Payment::STATUS_FAILED ? 'selected' : ''}}>{{ \App\Models\Payment::STATUS_FAILED}}</option>
            <option
                value="{{ \App\Models\Payment::STATUS_MANUAL }}" {{ $registration && $registration->has('payment') && $registration->payment->status == \App\Models\Payment::STATUS_MANUAL ? 'selected' : ''}}>{{ \App\Models\Payment::STATUS_MANUAL}}</option>
        </select>
    </div>
    {{--    <div class="form-group col-md-6">--}}
    {{--        <label>Membership ID</label>--}}
    {{--        <input type="text" readonly="readonly" class="form-control" name="id" value="{{ old('id') ?? data_get($user, 'id')  }}">--}}
    {{--    </div>--}}

</div>
<div class="form-row">

    <div class="form-group col-md-6">
        <label>Amount</label>
        <input type="text" class="form-control" name="total"
               value="{{ $registration && $registration->has('payment') ? $registration->payment->amount : 0 }}"
               @if($readonly) readonly @endif>
    </div>
    <div class="form-group col-md-6">
        <label>House</label>
        <select id="house" name="house" class="form-control select1"
                @if($readonly) disabled="disabled" @endif>
            <option
                value="SELECT YOUR HOUSE NAME . . . !" {{data_get($registration, 'house') ==  " SELECT YOUR HOUSE NAME . . . !" ? 'selected' : ''}}>
                SELECT YOUR HOUSE NAME . . . !
            </option>
            <option
                value="RABINDRA HOUSE/ BABAR HOUSE" {{data_get($registration, 'house') ==  "RABINDRA HOUSE/ BABAR HOUSE" ? 'selected' : ''}}>
                RABINDRA HOUSE/ BABAR HOUSE
            </option>
            <option
                value="SHAHIDULLAH HOUSE/ AKBAR HOUSE"{{data_get($registration, 'house') ==  "SHAHIDULLAH HOUSE/ AKBAR HOUSE" ? 'selected' : ''}}>
                SHAHIDULLAH HOUSE/ AKBAR HOUSE
            </option>
            <option
                value="FAZLUL HOQUE HOUSE/ AYUB HOUSE" {{data_get($registration, 'house') ==  "FAZLUL HOQUE HOUSE/ AYUB HOUSE" ? 'selected' : ''}}>
                FAZLUL HOQUE HOUSE/ AYUB HOUSE
            </option>
            <option
                value="NAZRUL HOUSE/ SHAHJAHAN HOUSE" {{data_get($registration, 'house') ==  "NAZRUL HOUSE/ SHAHJAHAN HOUSE" ? 'selected' : ''}}>
                NAZRUL HOUSE/ SHAHJAHAN HOUSE
            </option>
        </select>
    </div>
</div>
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {

            if ($("#payment_status").val() == "Paid") {

                $("#edit_driver").show();
            } else {
                $("#edit_driver").hide();
            }
            if ($("#payment_status").val() == "Paid") {

                $("#edit_maid").show();
            } else {
                $("#edit_maid").hide();
            }
            if ($("#payment_status").val() == "Paid") {

                $("#edit_guest").show();
            } else {
                $("#edit_guest").hide();
            }
            if ($("#payment_status").val() == "Paid") {

                $("#edit_kidBelow").show();
            } else {
                $("#edit_kidBelow").hide();
            }
            if ($("#payment_status").val() == "Paid") {

                $("#edit_kidAbove").show();
            } else {
                $("#edit_kidAbove").hide();
            }

            if ($("#marital_status").val() == "married") {
                $("#add_kid").show();
            } else {
                $("#add_kid").hide();
            }


            $('#edit_driver').on('click', function () {
                $("#driver").removeAttr("readonly");
                $("#payment_status").removeAttr("disabled");
            })
            $('#edit_maid').on('click', function () {
                $("#maid").removeAttr("readonly");
                $("#payment_status").removeAttr("disabled");
            })
            $('#edit_guest').on('click', function () {
                $("#guest").removeAttr("readonly");
                $("#payment_status").removeAttr("disabled");
            })
            $('#edit_kidBelow').on('click', function () {
                $("#kidBelow").removeAttr("readonly");
                $("#payment_status").removeAttr("disabled");
            })
            $('#edit_kidAbove').on('click', function () {
                $("#kidAbove").removeAttr("readonly");
                $("#payment_status").removeAttr("disabled");
            })
        });
        $(document).ready(function () {
            $("#marital_status").change(function () {
                if ($(this).val() == "married") {
                    $("#add_kid").show();
                } else {
                    $("#add_kid").hide();
                }
            });
            //  $("#add_kid").hide();
        });
        $(document).ready(function () {
            $('#add_btn').on('click', function () {
                let html = '';
                html += '<div class="form-row" id="remove">';
                html += '<div class="form-group col-md-6">';
                html += '<label>Kid(Below6)</label>';
                html += '<input type="text" class="form-control" name="quantity[]" value="{{ old('') ?? data_get( '', 'quantity')  }}"  @if($readonly) readonly @endif>';
                html += '  </div>';
                html += '<div class="form-group col-md-6">';
                html += '<label>Kid(Above6)</label>';
                html += '<div class="input-group ">';
                html += '<input type="text" class="form-control" name="quantity" value="{{ old('') ?? data_get('', '')  }}"  @if($readonly) readonly @endif>';
                html += '<div class="input-group-append">';
                html += '<div class="input-group-text btn-danger">';
                html += '<i type="button" id="remove_btn" class="fas fa-minus"></i>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
                $('#add_kid').append(html)
            })
        })
        $(document).on('click', '#remove_btn', function () {
            $(this).closest('#remove').remove();
        });
        $(document).on('click', '#btn_married', function () {
            $(this)
        })
    </script>
@endpush

@push('stack_js')
    @include('backend.partials.form-submission')
@endpush
