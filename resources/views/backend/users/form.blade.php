@php
    $user = $user ?? null;
    $selectedRole = $selectedEvent->pivot->role ?? null;
    $userRole = $user && count($user->roles) ? $user->roles[0] : null;
    $roles = $roles ?? collect([]);
    $events = $events ?? collect([]);
@endphp
<div class="form-row">
    <div class="form-group col-md-6">
        <label>First Name</label>
        <input type="text" class="form-control" name="first_name"
               value="{{ old('first_name') ?? data_get($user, 'first_name') }}">
    </div>
    <div class="form-group col-md-6">
        <label>Last Name</label>
        <input type="text" class="form-control" name="last_name"
               value="{{ old('last_name') ?? data_get($user, 'last_name') }}">
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label>Email</label>
        <input type="text" class="form-control" name="email" value="{{ old('email') ?? data_get($user, 'email')  }}">
    </div>
    <div class="form-group col-md-6">
        <label>Phone Number</label>
        <input type="text" class="form-control" name="phone" value="{{ old('phone') ?? data_get($user, 'phone')  }}">
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label>Password</label>
        <input type="password" class="form-control" name="password">
    </div>
    <div class="form-group col-md-6">
        <label>Roles</label>
        <select id="role" name="role" class="form-control select2">
            <option value="" {{ null == $selectedRole ? 'selected' : '' }}>{{ "Select Role" }}</option>
            @foreach($roles as $role => $name)
                @if($role == \App\Enums\Role::EVENT_ADMIN)
                    <option value="{{ $role }}" {{ $role == $selectedRole ? 'selected' : '' }}>{{ $name }}</option>
                @else
                    <option value="{{ $role }}" {{ $role == $userRole  ? 'selected' : '' }}>{{ $name }}</option>
                @endif
            @endforeach
        </select>
    </div>
</div>

<div class="form-row">
    @if(!blank($user))
        <div class="form-group col-md-6">
            <label>Status</label>
            <select name="status" class="form-control">
                @foreach($statuses as $key => $item)
                    <option
                        value="{{$key}}" {{ ((old('status') == $key) || (data_get($user, 'status') == $key))  ? 'selected':''}}>{{ $item }}</option>
                @endforeach
            </select>
        </div>
    @endif
</div>
<div class="form-row" id="events">
    <div class="form-group col-md-6">
        <label>Events</label>
        <select id="event_names" name="events[]" class="form-control select1">
            <option value="">Select Event Name</option>
            @foreach($events as $event)
                <option
                    value="{{ $event->id }}"
                    {{ (old('event_id') == $event->id || (
                        $user &&
                        count($user->roles) &&
                        $user->roles[0] == \App\Enums\Role::EVENT_ADMIN &&
                        $selectedEvent &&
                        ($selectedEvent->id == $event->id)
                        )
                    ) ? 'selected':''}}
                >{{ $event->name }}
                </option>
            @endforeach
        </select>
    </div>
</div>


@push('stack_js')
    @include('backend.partials.form-submission')
@endpush
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            console.log('hi')
            if ($("#role").val() === '4') {
                console.log('dccvdvc')
                console.log($('#role').val());
                $("#events").show();
            } else {
                $("#events").hide();
            }

            $("#role").change(function () {
                console.log($(this).val());
                if ($(this).val() === '4') {
                    $("#events").show();
                } else {
                    $("#events").hide();
                }

            });
        });
    </script>
@endpush
