@extends('layouts.user')
@push('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
@endpush
@section('content')
    <div class="container">
        {{-- <div class="container-fluid"> --}}
        <div class="row justify-content-center">
            <div class="col-md-3 left-side ">
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
                            <th>#</th>
                            <th>{{ __('messages.profile_name') }}</th>
                            <th>created_at</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Products as $Product)
                            <tr>
                                <th scope="row">
                                    {{ ($Products->currentPage() - 1) * $Products->perPage() + $loop->iteration }}</th>
                                <td>{{ $Product->product_name }}</td>
                                <td>
                                    @if (app()->getLocale() == 'en')
                                        {{ \Carbon\Carbon::parse($Product->created_at)->isoFormat('LL') }}
                                    @else
                                        {{ \Carbon\Carbon::parse($Product->created_at)->locale(app()->getLocale())->thaidate('j F Y') }}
                                    @endif
                                </td>
                                <td>
                                    <input data-id="{{ $Product->id }}" class="toggle-class" type="checkbox"
                                        data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                        data-on="แสดงผล (Publish)" data-off="ร่าง (Draft)"
                                        {{ $Product->display ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <a href="{{ route('works.edit', $Product->id) }}" class="btn btn-primary">Edit</a>
                                    @if ($Product->seller)
                                        @if ($Product->seller->accept != 1)
                                            <form action="{{ route('works.destroy', $Product->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $Products->withQueryString()->links('pagination::bootstrap-5') !!}
                {{-- <div class="d-flex justify-content-center">
                    {!!$Products->links() !!}
                </div> --}}
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
                    url: '/changeStatus',
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
