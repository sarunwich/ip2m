@extends('layouts.user')

@section('content')
    <div class="container">
        {{-- <div class="container-fluid"> --}}
        <div class="row justify-content-center">
            <div class="col-md-3 left-side" >
                <h2>{{ __('messages.Work_information') }}</h2>
                <a href="{{ route('works.create') }}" class="btn btn-primary">{{ __('messages.Add_Performance') }}</a>

                @if (session('success'))
                    <div class="alert alert-success mt-3">
                        {{ session('success') }}
                    </div>
                @endif

            </div>
            <div class="col-md-9 right-side">
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th>{{ __('messages.profile_name') }}</th>

                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($profiles as $profile)
                            <tr>
                                <td>{{ $profile->profile_name }}</td>

                                <td>
                                    <a href="{{ route('profiles.edit', $profile->profile_id ) }}" class="btn btn-primary">Edit</a>
                                    <form action="{{ route('profiles.destroy', $profile->profile_id ) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
