@php
    $event = $event ?? collect([]);
@endphp
<div class="form-row">
    <div class="form-group col-md-6">
        <label>Event Name</label>
        <input type="text" class="form-control" name="name"
               value="{{ old('name') ?? data_get($event, 'name') }}">
    </div>
    <div class="form-group col-md-6">
        <label>Event Venue</label>
        <input type="text" class="form-control" name="venue"
               value="{{ old('venue') ?? data_get($event, 'venue') }}">
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label>Email</label>
        <input type="text" class="form-control" name="email" value="{{ old('email') ?? data_get($event, 'email')  }}">
    </div>
    <div class="form-group col-md-6">
        <label>Phone Number</label>
        <input type="text" class="form-control" name="phone" value="{{ old('phone') ?? data_get($event, 'phone')  }}">
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label>Event Start Date</label>
        <input type="datetime-local" class="form-control" name="event_start_date"
               value="{{ old('event_start_date') ?? data_get($event, 'event_start_date')  }}">
    </div>
    <div class="form-group col-md-6">
        <label>Event End Date</label>
        <input type="datetime-local" class="form-control" name="event_end_date"
               value="{{ old('event_end_date') ?? data_get($event, 'event_end_date')  }}">
    </div>

</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label>Reg. Open Date/Time</label>
        <input type="datetime-local" class="form-control" name="reg_start_date"
               value="{{ old('reg_start_date') ?? data_get($event, 'reg_start_date')  }}">
    </div>
    <div class="form-group col-md-6">
        <label>Reg. Close Date/Time</label>
        <input type="datetime-local" class="form-control" name="reg_end_date"
               value="{{ old('reg_end_date') ?? data_get($event, 'reg_end_date')  }}">
    </div>

</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label>Map URL</label>
        <input type="text" class="form-control" name="map_url"
               value="{{ old('map_url') ?? data_get($event, 'map_url') ?? null }}">
    </div>
    <div class="form-group col-md-6">
        <label>Event Contact</label>
        <input type="text" class="form-control" name="contact"
               value="{{ old('contact') ?? data_get($event, 'contact')  }}">
    </div>

</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label>Image Upload</label>
        <input type="file" class="form-control" name="image[]" accept="image/*" multiple>
    </div>

    @if($event->count())
        @foreach($event->media as $image)
            <img src="{{ $image->getFullUrl() }}" height="10%" width="10%">
        @endforeach
    @endif
    <div class="form-group col-md-6">
        <div class="form-group">
            <label>Event Type</label>
            <select name="event_type" class="form-control">
                <option>Select Type</option>
                <option value="public"
                @if (old('event_type') === "public" || data_get($event, 'event_type') === 'public')
                    {{ 'selected' }}
                    @endif>Public (All)
                </option>
                <option value="private"
                @if (old('event_type') === "private" || data_get($event, 'event_type') === 'private')
                    {{ 'selected' }}
                    @endif>Private (Invite only)
                </option>
                <option value="member"
                @if (old('event_type') === "member" || data_get($event, 'event_type') === 'member')
                    {{ 'selected' }}
                    @endif>Member Only
                </option>
            </select>
        </div>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <div class="form-group">
            <label>Subscription Fee Type</label>
            <select class="form-control" name="subscription_fee_type">
                <option value="free"
                @if (old('subscription_fee_type') == "free" || data_get($event, 'subscription_fee_type') == 'free')
                    {{ 'selected' }}
                    @endif>Free
                </option>
                <option value="flat_price"
                @if (old('subscription_fee_type') == "flat_price" || data_get($event, 'subscription_fee_type') == 'flat_price')
                    {{ 'selected' }}
                    @endif>Flat Price
                </option>
                <option value="package"
                @if (old('subscription_fee_type') == "package" || data_get($event, 'subscription_fee_type') == 'package')
                    {{ 'selected' }}
                    @endif>Package
                </option>
            </select>
        </div>
    </div>
    <div class="form-group col-md-6">
        <label>Subscription Fee</label>
        <input type="number" class="form-control" name="subscription_fee"
               value="{{ old('subscription_fee') ?? data_get($event, 'subscription_fee') ?? null }}">
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label>Social/Facebook Link</label>
        <input type="text" class="form-control" name="social_url"
               value="{{ old('social_url') ?? data_get($event, 'social_url') ?? null }}">
    </div>
    <div class="form-group col-md-6">
        <label>Allow Max Participant</label>
        <input type="number" class="form-control" name="max_participant"
               value="{{ old('max_participant') ?? data_get($event, 'max_participant') ?? null }}">
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label>Event Organization</label>
        <input type="text" class="form-control" name="organization"
               value="{{ old('organization') ?? data_get($event, 'organization')  }}">
    </div>
    <div class="form-group col-md-3 d-flex ">
        <label class="custom-switch mt-2 ">
            <input type="checkbox" name="is_published"
                   class="custom-switch-input" {{ data_get($event, 'is_published') ? 'checked' : '' }}>
            <span class="custom-switch-indicator"></span>
            <span class="custom-switch-description">Publish</span>
        </label>
    </div>
    <div class="form-group col-md-3 d-flex ">
        <label class="custom-switch mt-2 ">
            <input type="checkbox" name="is_registration_allowed"
                   class="custom-switch-input" {{ data_get($event, 'is_registration_allowed') ? 'checked' : '' }}>
            <span class="custom-switch-indicator"></span>
            <span class="custom-switch-description">Allow Registration</span>
        </label>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label>FAQ Link URL (Google Docs Link)</label>
        <input type="text" class="form-control" name="faq_url"
               value="{{ old('faq_url') ?? data_get($event, 'faq_url') ?? null }}">
    </div>
    <div class="form-group col-md-6">
        <label class="col-form-label text-left col-12 col-md-3 col-lg-3">Description</label>
        <div class="col-sm-12 col-md-12 ">
            <textarea class="summernote-simple w-100" name="description"
            >{{ old('description') ?? data_get($event, 'description') ?? null }}</textarea>
        </div>
    </div>
</div>

@push('stack_js')
    @include('backend.partials.form-submission')
@endpush
