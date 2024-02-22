@extends('layouts.user')
@push('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
@endpush
@section('content')
    <div class="container">
        {{-- <div class="container-fluid"> --}}
        <div class="row justify-content-center">
            <div class="col-md-3 left-side">
                <h2>{{ __('messages.Offering_information') }}</h2>
                <a href="{{ route('seller.create') }}" class="btn btn-primary">{{ __('messages.Add_seller') }}</a>

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
                            <th>{{ __('messages.profile_name') }}</th>
                            <th>created_at</th>
                            <th>Status</th>
                            <th>Statusupdate</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sellers as $seller)
                            <tr>
                                <td scope="row">
                                    {{ ($sellers->currentPage() - 1) * $sellers->perPage() + $loop->iteration }}</td>
                                <td>{{ $seller->product_name }}</td>
                                <td>
                                    @if (app()->getLocale() == 'en')
                                        {{ \Carbon\Carbon::parse($seller->sellercreated_at)->isoFormat('LL') }}
                                    @else
                                        {{ \Carbon\Carbon::parse($seller->sellercreated_at)->locale('th')->thaidate('j F Y') }}
                                    @endif
                                </td>
                                <td>
                                    @if ($seller->status == 1)
                                        <div class="alert alert-success" role="alert">
                                            {{ __('messages.status1') }}
                                        </div>
                                    @elseif($seller->status == 2)
                                        <div class="alert alert-danger" role="alert">
                                            {{ __('messages.status2') }}
                                        </div>
                                    @else
                                        <div class="alert alert-warning" role="alert">
                                            {{ __('messages.status0') }}
                                        </div>
                                    @endif
                                    {{-- <input data-id="{{$seller->sid}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="แสดงผล (Publish)" data-off="ร่าง (Draft)" {{ $Product->display ? 'checked' : '' }}> --}}
                                </td>
                                <td>
                                    {{-- {{ $seller->statusupdated_at ?? '' }} --}}
                                    @if ($seller->statusupdated_at)
                                        @if (app()->getLocale() == 'en')
                                            {{ \Carbon\Carbon::parse($seller->statusupdated_at)->isoFormat('LL') }}
                                        @else
                                            {{ \Carbon\Carbon::parse($seller->statusupdated_at)->locale('th')->thaidate('j F Y') }}
                                        @endif
                                    @endif


                                </td>
                                <td>
                                    @if ($seller->status == null)
                                        {{-- <input data-id="{{$seller->sid}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="แสดงผล (Publish)" data-off="ร่าง (Draft)" {{ $seller->status ? 'checked' : '' }}> --}}
                                        <a href="{{ route('seller.edit', $seller->sid) }}" class="btn btn-primary">Edit</a>
                                        <form action="{{ route('seller.destroy', $seller->sid) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    @elseif($seller->status == 1)
                                    {{$seller->profile_id}}
                                        <input data-id="{{ $seller->sid }}" class="toggle-class" type="checkbox"
                                            data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                            data-on="เปิด (Open)" data-off="ปิด (Close)"
                                            {{ $seller->status_sell ? 'checked' : '' }}>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $sellers->withQueryString()->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(function() {
            $('.toggle-class').change(function() {
                var status = $(this).prop('checked') == true ? 1 : null;
                var id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/changeSellStatus',
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
