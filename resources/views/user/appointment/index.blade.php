@extends('layouts.user')

@section('content')
    <div class="container">
        {{-- <div class="container-fluid"> --}}
        {{-- เสนอขาย --}}
        <div class="row justify-content-center">
            <div class="col-md-3 left-side">
                <h2>{{ __('messages.appointment') }}</h2>
                <h4>{{ __('messages.Offering_information') }}</h4>

                {{-- <a href="{{ route('profiles.create') }}" class="btn btn-primary">{{ __('messages.Create_Profile') }}</a> --}}

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
                            <th>{{ __('messages.appointment') }}</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sellers as $seller)
                            <tr>
                                <td><strong>{{ $seller->product_name }}</strong></td>
                                {{-- <td>
                                    <a href="{{ route('profiles.edit', $profile->profile_id ) }}" class="btn btn-primary">Edit</a>
                                    <form action="{{ route('profiles.destroy', $profile->profile_id ) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td> --}}

                            </tr>
                            <tr>
                                <td>
                                    <div class="accordion" id="accordionExample">
                                        @foreach ($seller->appointments as $appointment)
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="heading{{ $appointment->id }}">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#collapse{{ $appointment->id }}"
                                                        onclick="upreadAppointment({{ $appointment->id }})"
                                                        aria-expanded="true" aria-controls="collapseOne">
                                                        @if ($appointment->status_appointments == 1)
                                                            <i class="fas fa-eye eye-icon ml-1" aria-hidden="true"></i>
                                                        @else
                                                            <i class="fa fa-eye ml-1" aria-hidden="true"></i>
                                                        @endif

                                                        <strong class="ml-1"> {{ __('messages.daterecord') }} ::&nbsp;
                                                        </strong>
                                                        @if (app()->getLocale() == 'en')
                                                            {{ \Carbon\Carbon::parse($appointment->created_at)->isoFormat('LLL') }}
                                                        @else
                                                            {{ \Carbon\Carbon::parse($appointment->created_at)->locale('th')->thaidate('j F Y H:i:s') }}
                                                        @endif
                                                        {{-- {{ $appointment->created_at }} --}}
                                                        &nbsp;&nbsp;
                                                        <strong> {{ __('messages.date_time') }}
                                                            {{ __('messages.appointment') }}:: &nbsp;
                                                        </strong>
                                                        @if (app()->getLocale() == 'en')
                                                            {{ \Carbon\Carbon::parse($appointment->appointment_time)->isoFormat('LLL') }}
                                                        @else
                                                            {{ \Carbon\Carbon::parse($appointment->appointment_time)->locale('th')->thaidate('j F Y H:i:s') }}
                                                        @endif
                                                        {{-- {{ $appointment->appointment_time }} --}}
                                                        {{-- {{ $appointment->rid }} --}}

                                                    </button>
                                                </h2>
                                                <div id="collapse{{ $appointment->id }}"
                                                    class="accordion-collapse collapse"
                                                    aria-labelledby="heading{{ $appointment->id }}"
                                                    data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        @if ($appointment->purpose1)
                                                            <br>
                                                            <p>{{ __('messages.purpose1') }}</p>
                                                        @endif
                                                        @if ($appointment->purpose2)
                                                            <p>{{ __('messages.purpose2') }}</p>
                                                        @endif
                                                        @if ($appointment->purpose3)
                                                            <p>{{ __('messages.purpose3') }}</p>
                                                            {{ $appointment->other }}
                                                        @endif
                                                        {{-- <br> --}}
                                                        <p><strong> {{ __('messages.Details_to_seller') }} ::</strong></p>
                                                        {{ $appointment->appointment_detail }}
                                                        <hr>
                                                        @foreach ($users as $user)
                                                            @if ($user->id == $appointment->rid)
                                                                <strong></strong> {{ $user->firstname }}
                                                                {{ $user->lastname }} {{ $user->tel }}
                                                            @endif
                                                        @endforeach
                                                        <hr>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        {{-- {{ $appointments->links() }} --}}
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

                {!! $sellers->withQueryString()->links('pagination::bootstrap-5') !!}
            </div>
        </div>
        <br>
        {{-- เสนอซื้อ --}}
        <div class="row justify-content-center">
            <div class="col-md-3 left-side">
                <h2>{{ __('messages.appointment') }}</h2>
                <h4>{{ __('messages.Tender_offer_information') }}</h4>

                {{-- <a href="{{ route('profiles.create') }}" class="btn btn-primary">{{ __('messages.Create_Profile') }}</a> --}}

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
                            <th>#</th>
                            <th>{{ __('messages.appointment') }}</th>
                            <th> {{ __('messages.Interest_data') }}</th>
                            <th>{{ __('messages.daterecord') }}</th>
                            <th>{{ __('messages.detail') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($response_offerbuys as $response_offerbuy)
                            <tr>
                                <th scope="row">
                                    {{ ($response_offerbuys->currentPage() - 1) * $response_offerbuys->perPage() + $loop->iteration }}
                                </th>
                                <td>F{{ $response_offerbuy->id }}</td>
                                <td>{{ $response_offerbuy->Interest_data }}</td>
                                <td>
                                    @if (app()->getLocale() == 'en')
                                        {{ \Carbon\Carbon::parse($response_offerbuy->response_date)->isoFormat('LL') }}
                                    @else
                                        {{ \Carbon\Carbon::parse($response_offerbuy->response_date)->locale('th')->thaidate('j F Y') }}
                                    @endif
                                </td>
                                <td>{{ $response_offerbuy->response_detail }}</td>
                                <td>
                                    {{-- <a href="{{ route('response.edit', $response_offerbuy->resid ) }}" class="btn btn-primary">Edit</a> --}}
                                    <form action="{{ route('response.destroy', $response_offerbuy->resid) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $response_offerbuys->withQueryString()->links('pagination::bootstrap-5') !!}
            </div>
        </div>
        <br>
        {{-- สินค่าที่สนใจ --}}
        <div class="row justify-content-center">
            <div class="col-md-3 left-side">
                <h2>{{ __('messages.appointment') }}</h2>
                <h4>{{ __('messages.Interested_products') }}</h4>
                {{-- <a href="{{ route('profiles.create') }}" class="btn btn-primary">{{ __('messages.Create_Profile') }}</a> --}}

                @if (session('success'))
                    <div class="alert alert-success mt-3">
                        {{ session('success') }}
                    </div>
                @endif

            </div>
            <div class="col-md-9 right-side">

                <div class="accordion" id="accordionappointment">
                    @foreach ($appointments as $appointment)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingx{{ $appointment->id }}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapsex{{ $appointment->id }}"
                                    onclick="upreadAppointment({{ $appointment->id }})" aria-expanded="true"
                                    aria-controls="collapseOne">
                                    {{ ($appointments->currentPage() - 1) * $appointments->perPage() + $loop->iteration }}
                                    {{ $appointment->product_name }}
                                    {{-- <strong class="ml-1"> {{ __('messages.daterecord') }} ::&nbsp;
                                    </strong>
                                    @if (app()->getLocale() == 'en')
                                        {{ \Carbon\Carbon::parse($appointment->created_at)->isoFormat('LLL') }}
                                    @else
                                        {{ \Carbon\Carbon::parse($appointment->created_at)->locale('th')->thaidate('j F Y H:i:s') }}
                                    @endif --}}
                                    {{-- {{ $appointment->created_at }} --}}
                                    &nbsp;&nbsp;
                                    <strong> {{ __('messages.date_time') }}
                                        {{ __('messages.appointment') }}:: &nbsp;
                                    </strong>
                                    @if (app()->getLocale() == 'en')
                                        {{ \Carbon\Carbon::parse($appointment->appointment_time)->isoFormat('LLL') }}
                                    @else
                                        {{ \Carbon\Carbon::parse($appointment->appointment_time)->locale('th')->thaidate('j F Y H:i:s') }}
                                    @endif


                                </button>
                            </h2>
                            <div id="collapsex{{ $appointment->id }}" class="accordion-collapse collapse"
                                aria-labelledby="headingx{{ $appointment->id }}" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    @if ($appointment->purpose1)
                                        <br>
                                        <p>{{ __('messages.purpose1') }}</p>
                                    @endif
                                    @if ($appointment->purpose2)
                                        <p>{{ __('messages.purpose2') }}</p>
                                    @endif
                                    @if ($appointment->purpose3)
                                        <p>{{ __('messages.purpose3') }}</p>
                                        {{ $appointment->other }}
                                    @endif
                                    {{-- <br> --}}
                                    <p><strong> {{ __('messages.Details_to_seller') }} ::</strong></p>
                                    {{ $appointment->appointment_detail }}
                                    <hr>
                                    {{$appointment->profile_name}}
                                    {{$appointment->store_name}}
                                    {{$appointment->tel}}
                                    {{-- @foreach ($users as $user)
                                        @if ($user->id == $appointment->rid)
                                            <strong></strong> {{ $user->firstname }}
                                            {{ $user->lastname }} {{ $user->tel }}
                                        @endif
                                    @endforeach --}}
                                    <hr>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {!! $appointments->withQueryString()->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        function upreadAppointment(id) {
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '/upreadApp',
                data: {
                    'id': id
                },
                success: function(data) {
                    console.log(data.success)

                }
            });
        }
    </script>
@endpush
