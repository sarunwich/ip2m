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
                <h2>{{ __('messages.Add_seller') }}</h2>

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
                <form class="row g-2" action="{{ route('seller.update',$seller->sid) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="row g-2">
                        <div class="col">

                            <label for="title">{{ __('messages.store_name') }}:</label>
                            <input type="text" value="{{ old('store_name') ?? ($seller->store_name ?? '') }}"
                                maxlength="255" class="form-control" id="taskTitle" name="store_name" required>

                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="person_type" id="person_type1"
                                    @if ($seller->person_type == 1) checked @endif value="1">
                                <label class="form-check-label" for="person_type1">{{ __('messages.person_type1') }}</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="person_type" id="person_type2"
                                    @if ($seller->person_type == 2) checked @endif value="2">
                                <label class="form-check-label" for="person_type2">{{ __('messages.person_type2') }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col">

                            <label for="title">{{ __('messages.id_number') }}:</label>
                            <input type="text" value="{{ old('id_number') ?? $seller->id_number ??'' }}" maxlength="50" class="form-control"
                                id="id_number" name="id_number" required>

                        </div>
                        {{-- <div class="col">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" name="seller_email"
                                value="{{ old('seller_email') ?? $seller->seller_email?? '' }}" aria-describedby="emailHelp" required>
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div> --}}
                    </div>
                    <div class="row g-2">
                        <div class="col">
                            <label for="inputGroupSelect01" class="form-label">{{ __('messages.profile') }}</label>

                            <select class="form-select" id="inputGroupSelect01" name="profile_id">
                                <option selected>Choose...</option>
                                @foreach ($profiles as $profile)
                                    <option @if($seller->profile_id==$profile->profile_id) selected @endif value="{{ $profile->profile_id }}">{{ $profile->profile_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="pid" class="form-label">{{ __('messages.Work_information') }}</label>
{{-- {{$seller->pid}} --}}
                            <select class="form-select" id="pid" name="pid">
                                <option selected>Choose...</option>
                                @foreach ($products as $product)
                                    <option @if($seller->pid==$product->id) selected @endif value="{{ $product->id }}">{{ $product->product_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col">
                            <label for="pid" class="form-label">{{ __('messages.Accept_sale') }}</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="accept" id="Accept_sale_1"
                                @if ($seller->accept == 1) checked @endif  value="1" >
                                <label class="form-check-label"
                                    for="Accept_sale_1">{{ __('messages.Accept_sale_1') }}</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="accept" id="Accept_sale_0"
                                @if ($seller->accept == 0) checked @endif  value="0">
                                <label class="form-check-label"
                                    for="Accept_sale_0">{{ __('messages.Accept_sale_0') }}</label>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
@endpush
