@extends('layout.master')

@section('content')
<div class="card">
    <div class="card-body">
        <h6 class="card-title">Edit Contact</h6>
        <form action="{{ route('admin.contacts.update', $contact->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="username">USer Name:</label>
                        <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror"
                            value="{{ old('username', $contact->username) }}" required>
                        @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="first_name">First Name:</label>
                        <input type="text" name="first_name" id="first_name" class="form-control @error('first_name') is-invalid @enderror"
                            value="{{ old('first_name', $contact->first_name) }}" required>
                        @error('first_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="last_name">Last Name:</label>
                        <input type="text" name="last_name" id="last_name" class="form-control @error('last_name') is-invalid @enderror"
                            value="{{ old('last_name', $contact->last_name) }}" required>
                        @error('last_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="designation">Designation:</label>
                        <input type="text" name="designation" id="designation" class="form-control @error('designation') is-invalid @enderror"
                            value="{{ old('designation', $contact->designation) }}" required>
                        @error('designation')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="phone_work">Work Phone:</label>
                        <input type="text" name="phone_work" id="phone_work"
                            class="form-control @error('phone_work') is-invalid @enderror" value="{{ old('phone_work', $contact->phone_work) }}"
                            required>
                        @error('phone_work')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="phone_personal">Personal Phone:</label>
                        <input type="text" name="phone_personal" id="phone_personal"
                            class="form-control @error('phone_personal') is-invalid @enderror" value="{{ old('phone_personal', $contact->phone_personal) }}"
                            required>
                        @error('phone_personal')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email_work">Work Email:</label>
                        <input type="email" name="email_work" id="email_work"
                            class="form-control @error('email_work') is-invalid @enderror" value="{{ old('email_work', $contact->email_work) }}"
                            required>
                        @error('email_work')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="website">Website:</label>
                        <input type="url" name="website" id="website" class="form-control @error('website') is-invalid @enderror"
                            value="{{ old('website', $contact->website) }}">
                        @error('website')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <textarea name="address" id="address" class="form-control @error('Address') is-invalid @enderror"
                            rows="3">{{ old('address', $contact->Address) }}</textarea>
                        @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="background_color">Background Color:</label>
                        <input type="color" name="background_color" id="background_color" class="form-control"
                               value="{{ old('background_color', $contact->background_color) }}">
                    </div>
                    </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="phone_work">Map</label>
                        <input type="text" name="map" id="map"
                            class="form-control @error('map') is-invalid @enderror" value="{{ old('map', $contact->map) }}"
                            required>
                        @error('map')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="theme">Theme</label>
                            <select name="theme" id="theme" class="form-control @error('theme') is-invalid @enderror">
                                <option value="">Select a theme</option>
                                <option value="theme1" {{ old('theme', $contact->theme) == 'theme1' ? 'selected' : '' }}>Theme 1</option>
                                <option value="theme2" {{ old('theme', $contact->theme) == 'theme2' ? 'selected' : '' }}>Theme 2</option>
                                <!-- Add more options as needed -->
                            </select>
                            @error('theme')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                <div class="col-md-6">
                     <div class="form-group">
                        <label for="profile_photo">Profile Photo:</label>
                        <input type="file" name="profile_photo" id="profile_photo" class="form-control-file @error('profile_photo') is-invalid @enderror">
                        @error('profile_photo')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                
                        <!-- Display the current profile photo -->
                       
                    </div>
                    </div>
                <div class="col-md-6">
                    <div class="form-group mt-5 mb-5">
                        <label for="profile_photo">Cover Photo:</label>
                        <input type="file" name="cover_photo" id="cover_photo" class="form-control-file @error('cover_photo') is-invalid @enderror">
                        @error('cover_photo')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="social_media">Social Media:</label>
                        <div id="social-media-inputs">
                            @foreach($contact->socialMedia as $index => $socialMedia)
                                <div class="social-media-entry" style="display: flex; align-items: center;" >
                                    <input type="hidden" name="social_media[{{ $index }}][id]" value="{{ $socialMedia->id }}">
                                     <select name="social_media[{{ $index }}][platform]" class="form-control">
                                        <option value="">Select Platform</option>
                                        <option value="Behance" {{ old('social_media.' . $index . '.platform', $socialMedia->platform) == 'Behance' ? 'selected' : '' }}>Behance</option>
                                        <option value="Facebook" {{ old('social_media.' . $index . '.platform', $socialMedia->platform) == 'Facebook' ? 'selected' : '' }}>Facebook</option>
                                        <option value="Twitter" {{ old('social_media.' . $index . '.platform', $socialMedia->platform) == 'Twitter' ? 'selected' : '' }}>Twitter</option>
                                        <option value="Instagram" {{ old('social_media.' . $index . '.platform', $socialMedia->platform) == 'Instagram' ? 'selected' : '' }}>Instagram</option>
                                        <option value="LinkedIn" {{ old('social_media.' . $index . '.platform', $socialMedia->platform) == 'LinkedIn' ? 'selected' : '' }}>LinkedIn</option>
                                        <option value="Messenger" {{ old('social_media.' . $index . '.platform', $socialMedia->platform) == 'Messenger' ? 'selected' : '' }}>Messenger</option>
                                        <option value="Pinterest" {{ old('social_media.' . $index . '.platform', $socialMedia->platform) == 'Pinterest' ? 'selected' : '' }}>Pinterest</option>
                                        <option value="Snapchat" {{ old('social_media.' . $index . '.platform', $socialMedia->platform) == 'Snapchat' ? 'selected' : '' }}>Snapchat</option>
                                        <option value="Spotify" {{ old('social_media.' . $index . '.platform', $socialMedia->platform) == 'Spotify' ? 'selected' : '' }}>Spotify</option>
                                        <option value="Telegram" {{ old('social_media.' . $index . '.platform', $socialMedia->platform) == 'Telegram' ? 'selected' : '' }}>Telegram</option>
                                        <option value="TikTok" {{ old('social_media.' . $index . '.platform', $socialMedia->platform) == 'TikTok' ? 'selected' : '' }}>TikTok</option>
                                        <option value="Vimeo" {{ old('social_media.' . $index . '.platform', $socialMedia->platform) == 'Vimeo' ? 'selected' : '' }}>Vimeo</option>
                                        <option value="WhatsApp" {{ old('social_media.' . $index . '.platform', $socialMedia->platform) == 'WhatsApp' ? 'selected' : '' }}>WhatsApp</option>
                                        <option value="YouTube" {{ old('social_media.' . $index . '.platform', $socialMedia->platform) == 'YouTube' ? 'selected' : '' }}>YouTube</option>
                                        <option value="Zoom" {{ old('social_media.' . $index . '.platform', $socialMedia->platform) == 'Zoom' ? 'selected' : '' }}>Zoom</option>
                                        <option value="PlayStore" {{ old('social_media.' . $index . '.platform', $socialMedia->platform) == 'PlayStore' ? 'selected' : '' }}>PlayStore</option>
                                        <option value="AppStore" {{ old('social_media.' . $index . '.platform', $socialMedia->platform) == 'AppStore' ? 'selected' : '' }}>AppStore</option>
                                        <!-- Add more options for other platforms here -->
                                    </select>
                                    @error('social_media.' . $index . '.platform')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    
                                    <input type="text" name="social_media[{{ $index }}][link]" class="form-control @error('social_media.' . $index . '.link') is-invalid @enderror" placeholder="Link" value="{{ old('social_media.' . $index . '.link', $socialMedia->link) }}">
                                    @error('social_media.' . $index . '.link')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <!--<input type="file" name="social_media[{{ $index }}][icon]" class="form-control @error('social_media.' . $index . '.icon') is-invalid @enderror" placeholder="Icon" value="{{ old('social_media.' . $index . '.icon', $socialMedia->icon) }}">-->
                                    <!--@error('social_media.' . $index . '.icon')-->
                                    <!--    <div class="invalid-feedback">{{ $message }}</div>-->
                                    <!--@enderror-->
                                    <button type="button" class="btn btn-sm btn-danger remove-social-media">Remove</button>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" id="add-social-media" class="btn btn-sm btn-primary mt-2">Add Social Media</button>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="contactDetails">Contacts:</label>
                        <div id="contact-inputs">
                            @foreach($contact->contactDetails as $index => $contactDetail)
                                <div class="contact-entry" style="display: flex; align-items: center;">
                                    <input type="hidden" name="contactDetails[{{ $index }}][id]" value="{{ $contactDetail->id }}">
                                    <input type="text" name="contactDetails[{{ $index }}][title]" class="form-control" placeholder="Title" value="{{ old('contactDetails.' . $index . '.title', $contactDetail->title) }}">
                                    <input type="text" name="contactDetails[{{ $index }}][details]" class="form-control" placeholder="Details" value="{{ old('contactDetails.' . $index . '.details', $contactDetail->details) }}">
                                    <button type="button" class="btn btn-sm btn-danger remove-contact">Remove</button>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" id="add-contact" class="btn btn-sm btn-primary mt-2">Add Contact</button>
                    </div>
                </div>


                <div class="col-12">
                    <button type="submit" class="btn btn-primary mt-3">Update Contact</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('plugin-scripts')
<script>
    $(document).ready(function() {
        var socialMediaCounter = {{ count($contact->socialMedia ?? []) }};

        $('#add-social-media').click(function() {
            var platforms = [
                "Behance", "Facebook", "Twitter", "Instagram", "LinkedIn", "Messenger",
                "Pinterest", "Snapchat", "Spotify", "Telegram", "TikTok", "Vimeo",
                "WhatsApp", "YouTube", "Zoom",'PlayStore','AppStore', "Other"
            ]; // Add your platform options here

            var platformOptions = platforms.map(function(platform) {
                return `<option value="${platform}">${platform}</option>`;
            }).join('');

            var newEntry = `
                <div class="social-media-entry" style="display: flex; align-items: center;">
                    <select name="social_media[${socialMediaCounter}][platform]" class="form-control">
                        <option value="">Select Platform</option>
                        ${platformOptions}
                    </select>
                   
                    <input type="text" name="social_media[${socialMediaCounter}][link]" class="form-control" placeholder="Link">
                    <button type="button" class="btn btn-sm btn-danger remove-social-media">Remove</button>
                </div>
            `;

            $('#social-media-inputs').append(newEntry);
            socialMediaCounter++;
        });


        $(document).on('click', '.remove-social-media', function() {
            $(this).closest('.social-media-entry').remove();
        });




        var contactCounter = {{ count($contact->contactDetails ?? []) }};

        $('#add-contact').click(function() {
            var newEntry = `
                <div class="contact-entry" style="display: flex; align-items: center;">
                    <input type="text" name="contactDetails[${contactCounter}][title]" class="form-control" placeholder="Title">
                    <input type="text" name="contactDetails[${contactCounter}][details]" class="form-control" placeholder="Details">
                    <button type="button" class="btn btn-sm btn-danger remove-contact">Remove</button>
                </div>
            `;

            $('#contact-inputs').append(newEntry);
            contactCounter++;
        });

        $(document).on('click', '.remove-contact', function() {
            $(this).closest('.contact-entry').remove();
        });


    });
</script>
@endpush
