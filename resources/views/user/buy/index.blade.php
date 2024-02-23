@extends('layouts.user')

@section('content')
    <div class="container">
        {{-- <div class="container-fluid"> --}}
        <div class="row justify-content-center">
            <div class="col-md-3 left-side">
                <h2>{{ __('messages.Tender_offer_information') }}</h2>
                <a href="{{ route('buy.create') }}" class="btn btn-primary">{{ __('messages.AddTender_offer') }}</a>

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
                            <th>{{ __('messages.Purchase_request_number') }}</th>
                            {{-- <th>created_at</th> --}}
                            <th>{{ __('messages.Approvedate') }}</th>
                            <th>{{ __('messages.enddate') }}</th>
                            <th>{{ __('messages.Interest_data') }}</th>
                            <th>{{ __('messages.detail') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Offerbuys as $Offerbuy)
                            <tr>
                                <td scope="row">{{ ($Offerbuys->currentPage() - 1) * $Offerbuys->perPage() + $loop->iteration }}</td>
                                <td>F{{ $Offerbuy->id }}</td>
                                {{-- <td>
                                    @if (app()->getLocale() == 'en')
                                        {{ \Carbon\Carbon::parse($Offerbuy->created_at)->isoFormat('LL') }}
                                    @else
                                        {{ \Carbon\Carbon::parse($Offerbuy->created_at)->locale(app()->getLocale())->thaidate('j F Y') }}
                                    @endif
                                </td> --}}
                                <td>
                                    @if ($Offerbuy->offerbuy_startdate)
                                        @if (app()->getLocale() == 'en')
                                            {{ \Carbon\Carbon::parse($Offerbuy->offerbuy_startdate)->isoFormat('LL') }}
                                        @else
                                            {{ \Carbon\Carbon::parse($Offerbuy->offerbuy_startdate)->locale('th')->thaidate('j F Y') }}
                                        @endif
                                    @else
                                        {{ __('messages.status0') }}
                                    @endif
                                </td>
                                <td>
                                    @if ($Offerbuy->offerbuy_startdate)
                                        @if (app()->getLocale() == 'en')
                                            {{ \Carbon\Carbon::parse($Offerbuy->offerbuy_enddate)->isoFormat('LL') }}
                                        @else
                                            {{ \Carbon\Carbon::parse($Offerbuy->offerbuy_enddate)->locale('th')->thaidate('j F Y') }}
                                        @endif
                                    @else
                                        {{ __('messages.status0') }}
                                    @endif
                                </td>
                                <td>{{ $Offerbuy->Interest_data }}</td>
                                <td>{{ $Offerbuy->offbuy_detail }}</td>
                                {{-- <td>
                                   @if ($seller->status == 1)
                                   <div class="alert alert-success" role="alert">
                                    {{ __('messages.status1') }}
                                  </div>
                                   @elseif($seller->status==2)
                                   <div class="alert alert-danger" role="alert">
                                    {{ __('messages.status2') }}
                                  </div>
                                   @else
                                   <div class="alert alert-warning" role="alert">
                                    {{ __('messages.status0') }}
                                  </div>
                                   @endif
                                 
                                </td> --}}
                                {{-- <td>{{ $seller->statusupdated_at ?? '' }}</td>--}}
                                <td>
                                    @if($Offerbuy->status==1)
                                    <div class="alert alert-success" role="alert">
                                        {{ __('messages.status1') }}
                                      </div>
                                    @else
                                    <a href="{{ route('buy.edit', $Offerbuy->id  ) }}" class="btn btn-primary">Edit</a>
                                    <form action="{{ route('buy.destroy', $Offerbuy->id ) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                    @endif
                                </td> 
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $Offerbuys->withQueryString()->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(function() {
            $('.toggle-class').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route('user.changeStatus') }}',
                    data: {
                        'status': status,
                        'id': id
                    },
                    success: function(data) {
                        console.log(data.success)
                    }
                });
            })
        })
    </script>
@endpush
