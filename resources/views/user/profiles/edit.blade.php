@extends('layouts.user')
@push('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
@endpush
@section('content')
    <div class="container">
        {{-- <div class="container-fluid"> --}}
        <div class="row justify-content-center">
            <div class="col-md-3 left-side">
                <h2>{{ __('messages.Create_Profile') }}</h2>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="col-md-9 right-side">
                <form class="row g-2" action="{{ route('profiles.update', $profile->profile_id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="row g-2">
                        <div class="col">
                            {{-- <label for="name">{{ __('messages.profile_name') }}</label> --}}
                            <input type="text" name="profile_name" class="form-control"
                                placeholder="{{ __('messages.profile_name') }}"
                                aria-label="{{ __('messages.profile_name') }}" value="{{ $profile->profile_name ?? '' }}"
                                required>
                        </div>
                        <div class="row g-2">
                            <div class="col">
                                {{-- <label for="name">{{ __('messages.profile_name') }}</label> --}}
                                <input type="text" name="institute" class="form-control"
                                    placeholder="{{ __('messages.institute') }}" aria-label="{{ __('messages.institute') }}"
                                    value="{{ $profile->institute ?? '' }}" required>
                            </div>
                            <div class="col">
                                {{-- <label for="name">{{ __('messages.profile_name') }}</label> --}}
                                <input type="text" name="country" class="form-control"
                                    placeholder="{{ __('messages.country') }}" aria-label="{{ __('messages.country') }}"
                                    value="{{ $profile->country ?? '' }}" required>
                            </div>

                        </div>
                        <div class="row g-2">
                            <div class="col">
                                {{-- <label for="name">{{ __('messages.profile_name') }}</label> --}}
                                <input type="text" name="address" class="form-control"
                                    placeholder="{{ __('messages.address') }}" aria-label="{{ __('messages.address') }}"
                                    value="{{ $profile->address ?? '' }}" required>
                            </div>
                        </div>

                        <div class="row g-2">
                            <div class="col">
                                <input type="text" name="province" class="form-control"
                                    placeholder="{{ __('messages.province') }}" aria-label="{{ __('messages.province') }}"
                                    value="{{ $profile->province ?? '' }}" required>
                            </div>
                            <div class="col">
                                <input type="text" name="district" class="form-control"
                                    placeholder="{{ __('messages.district') }}" aria-label="{{ __('messages.district') }}"
                                    value="{{ $profile->district ?? '' }}" required>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col">
                                <input type="text" name="tombon" class="form-control"
                                    placeholder="{{ __('messages.tombon') }}" aria-label="{{ __('messages.tombon') }}"
                                    value="{{ $profile->tombon ?? '' }}" required>
                            </div>
                            <div class="col">
                                <input type="text" name="zipcode" class="form-control"
                                    placeholder="{{ __('messages.zipcode') }}" aria-label="{{ __('messages.zipcode') }}"
                                    value="{{ $profile->zipcode ?? '' }}" required>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col">
                                <input class="form-control" id="tel" type="text" name="tel"
                                    placeholder="{{ __('messages.tel') }}" aria-label="{{ __('messages.tel') }}"
                                    maxlength="10" data-validation="length number" data-validation-length="min9"
                                    data-validation-error-msg="The answer you gave was not a correct number a value (9-10 chars)"
                                    value="{{ $profile->tel ?? '' }}" required>
                            </div>
                            <div class="col">
                                <input type="text" name="website" class="form-control"
                                    placeholder="{{ __('messages.website') }}" aria-label="{{ __('messages.website') }}"
                                    value="{{ $profile->website ?? '' }}" required>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col">
                                <input type="text" name="facebook" class="form-control"
                                    placeholder="{{ __('messages.facebook') }}" aria-label="{{ __('messages.facebook') }}"
                                    value="{{ old('facebook') ?? ($profile->facebook ?? '') }}" required>
                            </div>
                            <div class="col">
                                <input type="text" name="twitter" class="form-control"
                                    placeholder="{{ __('messages.twitter') }}" aria-label="{{ __('messages.twitter') }}"
                                    value="{{ old('twitter') ?? ($profile->twitter ?? '') }}" required>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col">
                                <input type="text" name="line" class="form-control"
                                    placeholder="{{ __('messages.line') }}" aria-label="{{ __('messages.line') }}"
                                    value="{{ old('line') ?? ($profile->line ?? '') }}" required>
                            </div>
                            <div class="col">
                                <input type="text" name="Instagram" class="form-control"
                                    placeholder="{{ __('messages.Instagram') }}"
                                    aria-label="{{ __('messages.Instagram') }}"
                                    value="{{ old('Instagram') ?? ($profile->Instagram ?? '') }}" required>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col">
                                <label for="profile_picture">{{ __('messages.profile_picture') }}</label>
                                @if ($profile->profile_picture)
                                    <img src="{{ asset('storage/profile_picture/' . $profile->profile_picture) }}"
                                        class="img-fluid rounded-circle mb-2" style="width: 80px;" alt="profile">
                                @endif
                                <input type="file" autofocus  accept="image/png, image/jpeg"
                                    name="profile_picture" placeholder="{{ __('messages.profile_picture') }}"
                                    aria-label="{{ __('messages.profile_picture') }}" class="form-control" />
                            </div>
                        </div>
                        {{-- <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="bio">Bio</label>
                            <textarea name="bio" class="form-control" required></textarea>
                        </div> --}}

                        <button type="submit" class="btn btn-primary">{{ __('messages.Update_Profile') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {

            $('#province').change(function() {
                var province_id = $(this).val();
                if (province_id) {
                    $('#amphur').prop('disabled', false);
                    $.ajax({
                        url: '{{ route('get.amphur') }}',
                        type: 'POST',
                        data: {
                            province_id: province_id,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            $('#amphur').empty().append('<option value="">เลือกอำเภอ</option>');
                            $.each(data.amphurs, function(key, value) {
                                $('#amphur').append('<option value="' + value
                                    .AMPHUR_ID + '">' + value.AMPHUR_NAME +
                                    '</option>');
                            });
                        }
                    });
                } else {
                    $('#amphur').prop('disabled', true);
                    $('#amphur').empty().append('<option value="">Select amphur</option>');
                    $('#district').prop('disabled', true);
                    $('#district').empty().append('<option value="">Select district</option>');
                }
            });

            $('#amphur').change(function() {
                var amphur_id = $(this).val();
                if (amphur_id) {
                    $('#district').prop('disabled', false);
                    $.ajax({
                        url: '{{ route('get.district') }}',
                        type: 'POST',
                        data: {
                            amphur_id: amphur_id,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            $('#district').empty().append(
                                '<option value="">เลือกตำบล</option>');
                            $.each(data.districts, function(key, value) {
                                $('#district').append('<option value="' + value
                                    .DISTRICT_ID + '">' + value.DISTRICT_NAME +
                                    '</option>');
                            });
                        }
                    });
                } else {
                    $('#district').prop('disabled', true);
                    $('#district').empty().append('<option value="">Select Major</option>');
                }
            });


            // $('#userTable').DataTable();
        });
    </script>
@endpush
