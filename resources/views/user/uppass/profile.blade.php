@extends('layouts.user')
    
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Profile') }}</div>
    
                <div class="card-body">
                    <form method="POST" action="{{ route('user.profile.store') }}" enctype="multipart/form-data">
                        @csrf
    
                        @if (session('success'))
                            <div class="alert alert-success" role="alert" class="text-danger">
                                {{ session('success') }}
                            </div>
                        @endif
  
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <select name="prefix" id="prefix" class="form-control ">
                                    <option value="">{{__('messages.selectprefix')}}</option>
                                    <option value="0" @if ( auth()->user()->prefix  == '0') selected @endif>{{ __('messages.prefix0') }}
                                    </option>
                                    <option value="1" @if (auth()->user()->prefix == '1') selected @endif>{{ __('messages.prefix1') }}
                                    </option>
                                    <option value="2" @if (auth()->user()->prefix  == '2') selected @endif>{{ __('messages.prefix2') }}
                                    </option>

                                </select>
                                @error('prefix')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
  
                            <div class="mb-3 col-md-6">
                                {{-- <img src="/avatars/{{ auth()->user()->avatar }}" style="width:80px;margin-top: 10px;"> --}}
                            </div>
  
                        </div>
  
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="firstname" class="form-label">{{ __('messages.first_name') }} </label>
                                <input class="form-control" type="text" id="firstname" name="firstname" value="{{ auth()->user()->firstname }}" autofocus="" >
                                @error('firstname')
                                    <span role="alert" class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
   
                            <div class="mb-3 col-md-6">
                                <label for="lastname" class="form-label">{{ __('messages.last_name') }}</label>
                                <input class="form-control" type="text" id="lastname" name="lastname" value="{{ auth()->user()->lastname }}" autofocus="" >
                                @error('lastname')
                                    <span role="alert" class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
   
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="password" class="form-label">Password: </label>
                                <input class="form-control" type="password" id="password" name="password" autofocus="" >
                                @error('password')
                                    <span role="alert" class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
   
                            <div class="mb-3 col-md-6">
                                <label for="confirm_password" class="form-label">Confirm Password: </label>
                                <input class="form-control" type="password" id="confirm_password" name="confirm_password" autofocus="" >
                                @error('confirm_password')
                                    <span role="alert" class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
   
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="tel" class="form-label">{{ __('messages.tel') }}</label>
                                <input class="form-control" type="text" id="tel" name="tel" value="{{ auth()->user()->tel }}" autofocus="" >
                                @error('tel')
                                    <span role="alert" class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            {{-- <div class="mb-3 col-md-6">
                                <label for="tel" class="form-label">Phone: </label>
                                <input class="form-control" type="text" id="tel" name="tel" value="{{ auth()->user()->tel }}" autofocus="" >
                                @error('tel')
                                    <span role="alert" class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> --}}
   
                            {{-- <div class="mb-3 col-md-6">
                                <label for="city" class="form-label">City: </label>
                                <input class="form-control" type="text" id="city" name="city" value="{{ auth()->user()->city }}" autofocus="" >
                                @error('city')
                                    <span role="alert" class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> --}}
                        </div>
    
                        <div class="row mb-0">
                            <div class="col-md-12 offset-md-5">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Upload Profile') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection