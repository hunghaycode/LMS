<div class="row">
    <div class="col-lg-9 order-2 order-lg-0">
        <div class="white-bg">
            <div class="students-info-form">
                <h6 class="font-title--card">Your Information</h6>
                <form action="{{ route('user.profile.update') }}" method="POST"enctype="multipart/form-data">
                    @csrf
                    <div class="col-lg-6">
                        <div class="white-bg">
                            <div class="change-image-wizard">
                                <div class="image mx-auto">
                                    <img id="showImage"
                                        src="{{ !empty($profileInfo->photo) ? url(  $profileInfo->photo) : url('upload/no_image.jpg') }}"
                                        alt="User" />
                                </div>
                                <div class="d-flex justify-content-center">
                                    <input type="file" id="image" name="photo" class="form-control"
                                        placeholder="CHANGE
                                        iMAGE"></input>
                                </div>
                                <p>Image size should be under 1MB image ratio 200px.</p>
                            </div>
                        </div>
                    </div>
                
                    <div class="row g-3">
                        <div class="col-lg-6">
                            <label for="name">First Name</label>
                            <input type="text" class="form-control" placeholder="Phillip" name="name"
                                id="name" value="{{ $profileInfo->name }}" />
                        </div>
                        <div class="col-lg-6">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="phillip.bergson@gmail.com" value="{{ $profileInfo->email }}" />
                        </div>
                    </div>


                    <div class="row g-3">
                        <div class="col-lg-6">
                            <label for="pnumber">Phone Number</label>
                            <input type="text" class="form-control" placeholder="" name="phone" id="pnumber"
                                value="{{ $profileInfo->phone }}" />
                        </div>
                        <div class="col-lg-6">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" placeholder="" name="address" id="address"
                                value="{{ $profileInfo->address }}" />
                        </div>
                    </div>

                    <div class="d-flex justify-content-lg-end justify-content-center mt-2">
                        <button class="button button-lg button--primary" type="submit">Save
                            Changes</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="white-bg mt-4">
            <div class="students-info-form">
                <h6 class="font-title--card">Change Password</h6>
                <form method="post" action="{{ route('user.password.update') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <label for="cpass">Current Password</label>
                            <div class="input-with-icon">
                                <input type="password" name="old_password" id="old_password" class="form-control"
                                    placeholder="Enter Password" />

                                <div class="input-icon" onclick="showPassword('cpass',this)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z">
                                        </path>
                                        <circle cx="12" cy="12" r="3">
                                        </circle>
                                    </svg>
                                </div>
                                @error('old_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="npass">New Password</label>
                            <div class="input-with-icon">
                                <input type="password" name="new_password" id="new_password" class="form-control"
                                    placeholder="Enter Password" />
                                <div class="input-icon" onclick="showPassword('npass',this)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z">
                                        </path>
                                        <circle cx="12" cy="12" r="3">
                                        </circle>
                                    </svg>
                                </div>
                                @error('new_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="cnpass">Confirm New Password</label>
                            <div class="input-with-icon">
                                <input type="password" name="new_password_confirmation"
                                    id="new_password_confirmation" class="form-control"
                                    placeholder="Enter Password" />
                                <div class="input-icon" onclick="showPassword('cnpass',this)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z">
                                        </path>
                                        <circle cx="12" cy="12" r="3">
                                        </circle>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-lg-end justify-content-center mt-2">
                        <button class="button button-lg button--primary" type="submit">Save
                            Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-3 order-1 order-lg-0 mt-4 mt-lg-0">
        <div class="white-bg">
            <div class="change-image-wizard">
                <div class="image mx-auto">
                    <img id="showImage"
                        src="{{ !empty($profileInfo->photo) ? url( $profileInfo->photo) : url('upload/no_image.jpg') }}"
                        alt="User" />
                </div>
                <div class="d-flex justify-content-center">
                    <input type="file" id="image" name="photo" class="form-control"
                        placeholder="CHANGE
                        iMAGE"></input>
                </div>
                <p>Image size should be under 1MB image ratio 200px.</p>
            </div>
        </div>
    </div>
 

</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#image').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files[0]); // Đảm bảo sử dụng chỉ số 0
        });
    });
</script>

{{-- <img id="showImage"
src="{{ !empty($profileInfo->photo) ? url('upload/instructor_images/' . $profileInfo->photo) : url('vendors/images/photo1.jpg') }}"
alt="Admin" class="rounded-circle p-1 "
width="120"> --}}
