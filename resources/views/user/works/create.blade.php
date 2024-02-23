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
                <h2>{{ __('messages.Add_Performance') }}</h2>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {{-- @if ($ipdata)
                    @dd($ipdata)
                @endif --}}
            </div>
            <div class="col-md-9 right-side">
                <form class="row g-2" action="{{ route('work.create.step.one.post') }}" method="POST">
                    @csrf
                    <div class="row g-2">
                        <div class="col">
                            {{-- @dd($ipdata) --}}
                            {{-- <label for="name">{{ __('messages.profile_name') }}</label> --}}
                            <select class="form-control select2bs4 " style="width: 100%" onchange="finetype(this.value)"
                                id="iptype_id" name="iptype_id">
                                <option id=""> ----- ประเภททรัพย์สินทางปัญญา -----</option>
                                @foreach ($iptypes as $iptype)
                                    <option value="{{ $iptype->iptype_id }}"
                                        @if ($ipdata) @if ($ipdata['iptype_id'] == $iptype->iptype_id) selected @endif>
                                        {{ $iptype->iptype_name }}
                                    @else
                                        @if (old('iptype_id') == $iptype->iptype_id) selected
                                        @endif>{{ $iptype->iptype_name }}
                                @endif
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <span id="ipdetal">
                        {{-- @dd($ipdata) --}}
                        @if ($ipdata)
                            @foreach ($ipdata['ipdid'] as $key => $value)
                                {{-- {{ dd($ipdata)}} --}}
                                {{-- {{ $ipdata['ipdata'][$key] }} --}}
                                <div class="row g-2">
                                    <div class="col">
                                        {{-- {{$value->IPdetail->require}} --}}
                                        {{-- @dd($ipdetail) --}}

                                        {{-- {{ $value }} --}}
                                        @foreach ($ipdetail as $item)
                                            @if ($item['ipdetail_id'] == $value)
                                                {{-- {{ $item['ipdetail_name'] }}
                                            {{ $ipdata['ipdata'][$key] }} --}}
                                                @if ($item['require'] == 1)
                                                    <input type="hidden" name="ipdid[]" class="form-control"
                                                        value="{{ $value }}">
                                                    <label for="pr{{ $value }}">{{ $item['ipdetail_name'] }}</label>
                                                    <input type="{{ $item['type'] }}" name="ipdata[]"class="form-control"
                                                        placeholder="{{ $item['ipdetail_name'] }}"
                                                        aria-label="{{ $item['ipdetail_name'] }}" required
                                                        value="{{ old('ipdata.0') ?? $ipdata['ipdata'][$key] }}">
                                                @else
                                                    <input type="hidden" name="ipdid[]" class="form-control"
                                                        value="{{ $value }}">
                                                    <label
                                                        for="pr{{ $value }}">{{ $item['ipdetail_name'] }}</label>
                                                    <input type="{{ $item['type'] }}" name="ipdata[]"class="form-control"
                                                        placeholder="{{ $item['ipdetail_name'] }}"
                                                        aria-label="{{ $item['ipdetail_name'] }}"
                                                        value="{{ old('ipdata.0') ?? $ipdata['ipdata'][$key] }}">
                                                @endif
                                            @endif
                                        @endforeach
                                        {{-- @if ($value->IPdetail->require == 1)
                                        <input type="hidden" name="ipdid[]" class="form-control"
                                            value="{{ $value->IPdetail->ipdetail_id }}">
                                        <label
                                            for="pr{{ $value->IPdetail->ipdetail_id }}">{{ $value->IPdetail->ipdetail_name }}</label>
                                        <input type="{{ $value->IPdetail->type }}" name="ipdata[]"class="form-control"
                                            placeholder="{{ $value->IPdetail->ipdetail_name }}"
                                            aria-label="{{ $value->IPdetail->ipdetail_name }}" required
                                            value="{{ old('ipdata.0') ?? ($ipdata['ipdata'][$key] ?? $value->IPdataDetail_data) }}">
                                    @else
                                    <input type="hidden" name="ipdid[]" class="form-control"
                                            value="{{ $value->IPdetail->ipdetail_id }}">
                                        <label
                                            for="pr{{ $value->IPdetail->ipdetail_id }}">{{ $value->IPdetail->ipdetail_name }}</label>
                                        <input type="{{ $value->IPdetail->type }}" name="ipdata[]"class="form-control"
                                            placeholder="{{ $value->IPdetail->ipdetail_name }}"
                                            aria-label="{{ $value->IPdetail->ipdetail_name }}" 
                                            value="{{ old('ipdata.0') ?? ($ipdata['ipdata'][$key] ?? $value->IPdataDetail_data) }}">
                                
                                    @endif --}}
                                    </div>

                                </div>
                            @endforeach
                        @endif

                    </span>

                    {{-- <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="bio">Bio</label>
                            <textarea name="bio" class="form-control" required></textarea>
                        </div> --}}

                    {{-- <button type="submit" class="btn btn-primary">{{ __('messages.Add_Performance') }}</button> --}}
                    <button type="submit" class="btn btn-primary">Next</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        @if (old('iptype_id'))
            console.log({{ old('ipdata.0') }});

            finetype({{ old('iptype_id') }});
        @endif
        function finetype(iptype_id) {
            // alert(iptype_id);
            $.ajax({
                url: '{{ route('get.iptypedetail') }}',
                type: 'POST',
                data: {
                    iptype_id: iptype_id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {

                    $('#ipdetal').empty().append('');
                    $.each(data.ipdetails, function(key, value) {
                        if (value.require == 1) {
                            $('#ipdetal').append('<div class="row g-2">' +
                                ' <div class="col"><input type="hidden" name="ipdid[]" class="form-control" value="' +
                                value.ipdetail_id +
                                '"><label for="pr' + value.ipdetail_id + '">' +
                                value.ipdetail_name + '</label><input type="' +
                                value.type +
                                '"   name="ipdata[]" class="form-control" placeholder="' +
                                value.ipdetail_name + '" aria-label="' + value
                                .ipdetail_name + '" required value="{{ old('ipdata.0') }}">' +
                                ' </div></div>');
                        } else {
                            $('#ipdetal').append('<div class="row g-2">' +
                                ' <div class="col"><input type="hidden" name="ipdid[]" class="form-control" value="' +
                                value.ipdetail_id +
                                '"><label for="pr' + value.ipdetail_id + '">' +
                                value.ipdetail_name + ' ' + value.require +
                                '</label><input type="' +
                                value.type +
                                '"   name="ipdata[]" class="form-control" placeholder="' +
                                value.ipdetail_name + '" aria-label="' + value
                                .ipdetail_name + '"  value="{{ old('ipdata.0') }}">' +
                                ' </div></div>');
                        }

                    });
                    // $('#ipdetal').html(data.ipdetailsdata);
                    console.log(data);
                }
            });
        }
        // $(document).ready(function() {

        //     $('#iptype_id').change(function() {
        //         var iptype_id = $(this).val();
        //         if (iptype_id) {
        //             $('#amphur').prop('disabled', false);
        //             $.ajax({
        //                 url: '{{ route('get.iptypedetail') }}',
        //                 type: 'POST',
        //                 data: {
        //                     iptype_id: iptype_id,
        //                     _token: '{{ csrf_token() }}'
        //                 },
        //                 success: function(data) {
        //                     $('#ipdetal').empty().append('');
        //                     $.each(data.ipdetails, function(key, value) {
        //                         $('#ipdetal').append('<div class="row g-2">' +
        //                             ' <div class="col"><input type="hidden" name="ipdid[]" class="form-control" value="' +
        //                             value.ipdetail_id +
        //                             '"><label for="pr' + value.ipdetail_id + '">' +
        //                             value.ipdetail_name + '</label><input type="' +
        //                             value.type +
        //                             '"   name="ipdata[]" class="form-control" placeholder="' +
        //                             value.ipdetail_name + '" aria-label="' + value
        //                             .ipdetail_name + '" value="">' +
        //                             ' </div></div>');
        //                     });
        //                     console.log(data);
        //                 }
        //             });
        //         } else {
        //             $('#amphur').prop('disabled', true);
        //             $('#amphur').empty().append('<option value="">Select amphur</option>');
        //             $('#district').prop('disabled', true);
        //             $('#district').empty().append('<option value="">Select district</option>');
        //         }
        //     });

        //     $('#amphur').change(function() {
        //         var amphur_id = $(this).val();
        //         if (amphur_id) {
        //             $('#district').prop('disabled', false);
        //             $.ajax({
        //                 url: '{{ route('get.district') }}',
        //                 type: 'POST',
        //                 data: {
        //                     amphur_id: amphur_id,
        //                     _token: '{{ csrf_token() }}'
        //                 },
        //                 success: function(data) {
        //                     $('#district').empty().append(
        //                         '<option value="">เลือกตำบล</option>');
        //                     $.each(data.districts, function(key, value) {
        //                         $('#district').append('<option value="' + value
        //                             .DISTRICT_ID + '">' + value.DISTRICT_NAME +
        //                             '</option>');
        //                     });
        //                 }
        //             });
        //         } else {
        //             $('#district').prop('disabled', true);
        //             $('#district').empty().append('<option value="">Select Major</option>');
        //         }
        //     });


        //     // $('#userTable').DataTable();
        // });
    </script>
@endpush
