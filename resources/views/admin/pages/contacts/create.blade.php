@extends('layout.master')

@section('content')
<div class="card">
    <div class="card-body">
        <h6 class="card-title">Create Contact</h6>
       <form action="{{ route('admin.contacts.store') }}" method="POST" enctype="multipart/form-data">

            @csrf
            <div class="row g-3">
                <div class="col-md-4">

                    <div class="form-group">
                        <label for="username">User Name:</label>
                        <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror"
                            value="{{ old('username') }}" required>
                        @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                     </div>
                      <div class="col-md-4">
                    <div class="form-group">
                        <label for="first_name">First Name:</label>
                        <input type="text" name="first_name" id="first_name" class="form-control @error('first_name') is-invalid @enderror"
                            value="{{ old('first_name') }}" required>
                        @error('first_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    </div>
                      <div class="col-md-4">
                    
                    <div class="form-group">
                        <label for="last_name">Last Name:</label>
                        <input type="text" name="last_name" id="last_name" class="form-control @error('last_name') is-invalid @enderror"
                            value="{{ old('last_name') }}" required>
                        @error('last_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    </div>
                      <div class="col-md-4">
                    
                    <div class="form-group">
                        <label for="designation">Designation:</label>
                        <input type="text" name="designation" id="designation" class="form-control @error('designation') is-invalid @enderror"
                            value="{{ old('designation') }}" required>
                        @error('designation')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    </div>
                      <div class="col-md-4">
                    
                    <div class="form-group">
                        <label for="phone_work">Work Phone:</label>
                        <input type="text" name="phone_work" id="phone_work"
                            class="form-control @error('phone_work') is-invalid @enderror" value="{{ old('phone_work') }}"
                            required>
                        @error('phone_work')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    </div>
                      <div class="col-md-4">
                    
                    <div class="form-group">
                        <label for="background_color">Background Color:</label>
                        <input type="color" name="background_color" id="background_color" class="form-control">
                    </div>
                    
                    
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="phone_personal">Personal Phone:</label>
                        <input type="text" name="phone_personal" id="phone_personal"
                            class="form-control @error('phone_personal') is-invalid @enderror" value="{{ old('phone_personal') }}"
                            required>
                        @error('phone_personal')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    </div>
                      <div class="col-md-4">
                    <div class="form-group">
                        <label for="email_work">Work Email:</label>
                        <input type="email" name="email_work" id="email_work"
                            class="form-control @error('email_work') is-invalid @enderror" value="{{ old('email_work') }}"
                            required>
                        @error('email_work')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    </div>
                      <div class="col-md-4">
                    <div class="form-group">
                        <label for="website">Website:</label>
                        <input type="url" name="website" id="website" class="form-control @error('website') is-invalid @enderror"
                            value="{{ old('website') }}">
                        @error('website')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    </div>
                    
                    
                      <div class="col-md-6">
                    <div class="form-group">
                        <label for="Address">Address:</label>
                        <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror"
                                  rows="5">{{ old('address') }}</textarea>
                        @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                  </div>
                     <div class="col-6">
                        <div class="form-group mb-2">
                            <label for="map">Map</label>
                            <input type="text" name="map" id="map" class="form-control @error('map') is-invalid @enderror"
                                value="{{ old('map') }}" required>
                            @error('map')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email_work">Password</label>
                            <input type="password" name="password" id="password"
                                class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}"
                                required>
                            @error('email_work')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                         
                        <div class="form-group">
                            <label for="theme">Theme</label>
                            <select name="theme" id="theme" class="form-control @error('theme') is-invalid @enderror">
                                <option value="">Select a theme</option>
                                <option value="theme1" {{ old('theme') == 'theme1' ? 'selected' : '' }}>Theme 1</option>
                                <option value="theme2" {{ old('theme') == 'theme2' ? 'selected' : '' }}>Theme 2</option>
                                <!-- Add more options as needed -->
                            </select>
                            @error('theme')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                   
                    </div>
                    
 <div class="col-md-6">
     <div class="form-group ">
                        <label class="d-block" for="profile_photo">Profile Photo:</label>
                        <input type="file" name="profile_photo" id="profile_photo" class="form-control-file @error('profile_photo') is-invalid @enderror">
                        @error('profile_photo')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
     </div>
               <div class="col-md-6">
                    
                    
                    
                    <div class="form-group">
                        <label class="d-block" for="profile_photo">Cover Photo:</label>
                        <input type="file" name="cover_photo" id="cover_photo" class="form-control-file @error('cover_photo') is-invalid @enderror">
                        @error('cover_photo')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                        </div>
                   
               <div class="col-md-6">
                  <div class="form-group ">
                    <label class="d-block" for="social_media">Social Media:</label>
                    <div id="social-media-inputs">
                      
                    </div>
                    <button type="button" id="add-social-media" class="btn btn-sm btn-primary mt-2">Add Social Media</button>
                   
                </div>
 </div>
               <div class="col-md-6">


                <div class="form-group ">
                    <label class="d-block" for="contact-details">Contact Details:</label>
                    <div id="contact-details-inputs">
                      
                    </div>
                    <button type="button" id="add-contact" class="btn btn-sm btn-primary mt-2">Add Contacts</button>
                </div>
</div>
                


                


                <div class="col-md-12">
                    <button type="submit" class="btn btn-success mt-3">Create Contact</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('plugin-scripts')
<script>
  $(document).ready(function() {
      var socialMediaCounter = 1;

      $('#add-social-media').click(function() {
            var platforms = [
                "Behance", "Facebook", "Twitter", "Instagram", "LinkedIn", "Messenger",
                "Pinterest", "Snapchat", "Spotify", "Telegram", "TikTok", "Vimeo",
                "WhatsApp", "YouTube", "Zoom","Google",'PlayStore','AppStore', "Other"
            ]; // Add your platform options here

            var platformOptions = platforms.map(function(platform) {
                return `<option value="${platform}">${platform}</option>`;
            }).join('');

            var newEntry = `
                <div class="social-media-entry mt-10" style="display: flex; align-items: center;">
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




      var contactCounter = 1;

      $('#add-contact').click(function() {
            

            var newEntry = `
                <div class="contact-entry" style="display: flex; align-items: center;">
                    <input type="text" name="contactDetails[${contactCounter}][title]" class="form-control" placeholder="Title">
                    <input type="text" name="contactDetails[${contactCounter}][details]" class="form-control" placeholder="Details">
                    <button type="button" class="btn btn-sm btn-danger remove-contact">Remove</button>
                </div>
            `;

            $('#contact-details-inputs').append(newEntry);
            contactCounter++;
        });


      $(document).on('click', '.remove-contact', function() {
          $(this).closest('.contact-entry').remove();
      });



  });
</script>


  @endpush
