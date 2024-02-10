@extends('layouts.user')
@push('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">
@endpush
@section('content')
    <div class="container">
        {{-- <div class="container-fluid"> --}}
        <div class="row justify-content-center">
            <div class="col-md-3 left-side">
                <h2>{{ __('messages.appointment') }}</h2>

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
                <form class="row g-2" action="{{ route('profiles.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-2">
                        <div class="col">
                            {{-- <label for="name">{{ __('messages.profile_name') }}</label> --}}
                            <div class="form-group">
                                <div class='input-group date' id='datetimepicker'>
                                <input type='text' class="form-control" />
                                <span class="input-group-addon">
                                  <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                                </div>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col">
                                {{-- <label for="name">{{ __('messages.profile_name') }}</label> --}}
                                <input type="text" name="institute" class="form-control"
                                    placeholder="{{ __('messages.institute') }}" aria-label="{{ __('messages.institute') }}"
                                    value="{{old('institute') ??''}}" required>
                            </div>
                            <div class="col">
                                {{-- <label for="name">{{ __('messages.profile_name') }}</label> --}}
                                <input type="text" name="country" class="form-control"
                                    placeholder="{{ __('messages.country') }}" aria-label="{{ __('messages.country') }}"
                                    value="{{old('country') ??''}}"  required>
                            </div>

                        </div>
                        <div class="row g-2">
                            <div class="col">
                                {{-- <label for="name">{{ __('messages.profile_name') }}</label> --}}
                                <input type="text" name="address" class="form-control"
                                    placeholder="{{ __('messages.address') }}" aria-label="{{ __('messages.address') }}"
                                    value="{{old('address') ??''}}" required>
                            </div>
                        </div>

                        <div class="row g-2">
                            <div class="col">
                                <input type="text" name="province" class="form-control"
                                    placeholder="{{ __('messages.province') }}" aria-label="{{ __('messages.province') }}"
                                    value="{{old('province') ??''}}" required>
                            </div>
                            <div class="col">
                                <input type="text" name="district" class="form-control"
                                    placeholder="{{ __('messages.district') }}" aria-label="{{ __('messages.district') }}"
                                    value="{{old('district') ??''}}" required>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col">
                                <input type="text" name="tombon" class="form-control"
                                    placeholder="{{ __('messages.tombon') }}" aria-label="{{ __('messages.tombon') }}"
                                    value="{{old('tombon') ??''}}" required>
                            </div>
                            <div class="col">
                                <input type="text" name="zipcode" class="form-control"
                                    placeholder="{{ __('messages.zipcode') }}" aria-label="{{ __('messages.zipcode') }}"
                                    value="{{old('zipcode') ??''}}" required>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col">
                                <input class="form-control" id="tel" type="text" name="tel"
                                    placeholder="{{ __('messages.tel') }}" aria-label="{{ __('messages.tel') }}"
                                    maxlength="10" data-validation="length number" data-validation-length="min9"
                                    data-validation-error-msg="The answer you gave was not a correct number a value (9-10 chars)"
                                    value="{{old('tel') ??''}}"  required>
                            </div>
                            <div class="col">
                                <input type="text" name="website" class="form-control"
                                    placeholder="{{ __('messages.website') }}" aria-label="{{ __('messages.website') }}"
                                    value="{{old('website') ??''}}" required>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col">
                                <input type="text" name="facebook" class="form-control"
                                    placeholder="{{ __('messages.facebook') }}" aria-label="{{ __('messages.facebook') }}"
                                    value="{{old('facebook') ??''}}" required>
                            </div>
                            <div class="col">
                                <input type="text" name="twitter" class="form-control"
                                    placeholder="{{ __('messages.twitter') }}" aria-label="{{ __('messages.twitter') }}"
                                    value="{{old('twitter') ??''}}" required>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col">
                                <input type="text" name="line" class="form-control"
                                    placeholder="{{ __('messages.line') }}" aria-label="{{ __('messages.line') }}"
                                    value="{{old('line') ??''}}" required>
                            </div>
                            <div class="col">
                                <input type="text" name="Instagram" class="form-control"
                                    placeholder="{{ __('messages.Instagram') }}"
                                    aria-label="{{ __('messages.Instagram') }}" value="{{old('Instagram') ??''}}" required>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col">
                                <label for="profile_picture">{{ __('messages.profile_picture') }}</label>
                                <input type="file" autofocus required accept="image/png, image/jpeg"
                                    name="profile_picture" placeholder="{{ __('messages.profile_picture') }}" aria-label="{{ __('messages.profile_picture') }}"
                                    class="form-control" />
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
                       
                        <button type="submit" class="btn btn-primary">{{ __('messages.Create_Profile') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript">
        $(function() {
           $('#datetimepicker').datetimepicker();
        });
    </script>
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
