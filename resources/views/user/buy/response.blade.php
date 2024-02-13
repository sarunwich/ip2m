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
                <h2>{{ __('messages.ResponseTenderOffer') }}</h2>
                <h4 class="card-text">F{{$id}}</4>
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
                <form class="row g-2" action="{{ route('response.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                 
                   
                    <div class="row g-2">
                        <div class="col">
                            <label for="name">{{ __('messages.detail') }}</label>
                            
                            <textarea class="form-control" id="response_detail" name="response_detail" rows="3" required>{{ old('response_detail') ?? '' }}</textarea>

                        </div>
                    </div>
                    <input type="hidden" name="id" value="{{$id}}">
                    
                    <button type="submit" class="buttonred col-sm-2">{{ __('messages.Send') }}</button>

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
    </script>
    <script type="text/javascript">
        function myFunction() {
            var x = document.getElementById("inputContainer");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }

       
    </script>
@endpush
