@extends('layouts.user')
@push('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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
                <form id="appointment-store" class="row g-2" action="{{ route('appointment.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row g-2">
                        <div class="col">
                            <label for="name">{{ __('messages.date_time') }}</label>
                            <input type="datetime-local" class="form-control" name="appointment_time">
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input custom-checkbox" type="checkbox" value="1"
                                    id="purpose1" name="purpose1">
                                <label class="form-check-label" for="purpose1">
                                    ต้องการรายละเอียดสินค้า
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input custom-checkbox" type="checkbox" value="1"
                                    id="purpose2" name="purpose2">
                                <label class="form-check-label" for="purpose2">
                                    ต้องการใบเสนอราคา
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input custom-checkbox" onclick="myFunction()" type="checkbox"
                                    value="1" id="purpose3" name="purpose3">
                                <label class="form-check-label" for="purpose3">
                                    อื่นๆ ระบุ..
                                    <div id="inputContainer" style="display: none;">
                                        <input type="text" class="form-control" id="other" name="other"
                                            maxlength="500" placeholder="Enter something">
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col">
                            <label for="name">{{ __('messages.Details_to_seller') }}</label>
                            <input type="text" class="form-control" name="appointment_detail">
                        </div>
                    </div>
                    <input type="hidden" name="sid" value="{{ $id }}">

                    <button type="submit" onclick="loder()" class="buttonred">{{ __('messages.Send') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        config = {
            enableTime: true,
            dateFormat: 'Y-m-d H:i',
        }
        flatpickr("input[type=datetime-local]", config);
    </script>
    <script>
        // Initialize Flatpickr with DateTime functionality
        flatpickr("#datetimepicker", {
            enableTime: true, // Enable time selection
            dateFormat: "Y-m-d H:i", // Customize the date and time format as needed
        });


        let btn = document.querySelector('button');
        let loader = document.querySelector('#pageLoader')
        function loder() {
            // alert('ttt');
            loader.style.display = 'block';

        }
    </script>
@endpush
