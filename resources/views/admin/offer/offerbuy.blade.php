@extends('layouts.admin')
@push('style')
    <style>
        .custom-control-input:checked~.custom-control-label::before {
            color: #fff;
            border-color: #7B1FA2;
        }

        .custom-control-input:checked~.custom-control-label.red::before {
            background-color: red;
        }

        .custom-control-input:checked~.custom-control-label.green::before {
            background-color: green;
        }
        .content-block {
            display: none;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush
@section('content')
    <div class="container">
        {{-- <div class="container-fluid"> --}}
        <div class="row justify-content-center">
            {{-- <div class="col-md-3 left-side" >
                <h2>{{ __('messages.Offering_information') }}</h2>
                <a href="{{ route('seller.create') }}" class="btn btn-primary">{{ __('messages.Add_seller') }}</a>

                @if (session('success'))
                    <div class="alert alert-success mt-3">
                        {{ session('success') }}
                    </div>
                @endif

            </div> --}}
            {{-- <div class="col-md-9 right-side"> --}}
            <div class="row">

                <div class="col-md-12">
                    <!-- ส่วนเนื้อหาของหน้าเว็บ -->
                    <div class="card">
                        <div class="custom-red-header text-center">{{ __('messages.Offering') }}</div>
                        <div class="card-body">
                            <table class="table mt-3">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>#ON</th>
                                        <th>{{ __('messages.Interest_data') }}</th>
                                        <th>created_at</th>
                                        <th>Approve</th>
                                        <th>end</th>
                                        <th>Status</th>
                                        {{-- <th>Statusupdate</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Offerbuys as $Offerbuy)
                                        <tr>
                                            <td>{{ ($Offerbuys->currentPage() - 1) * $Offerbuys->perPage() + $loop->iteration }}
                                            </td>
                                            <td>F{{ $Offerbuy->id }}</td>
                                            <td>{{ $Offerbuy->Interest_data }}</td>
                                            <td>
                                                @if (app()->getLocale() == 'en')
                                                    {{ \Carbon\Carbon::parse($Offerbuy->created_at)->isoFormat('LL') }}
                                                @else
                                                    {{ \Carbon\Carbon::parse($Offerbuy->created_at)->locale('th')->thaidate('j F Y') }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($Offerbuy->offerbuy_startdate)
                                                    @if (app()->getLocale() == 'en')
                                                        {{ \Carbon\Carbon::parse($Offerbuy->offerbuy_startdate)->isoFormat('LL') }}
                                                    @else
                                                        {{ \Carbon\Carbon::parse($Offerbuy->offerbuy_startdate)->locale('th')->thaidate('j F Y') }}
                                                    @endif
                                                @endif
                                            </td>
                                            <td>
                                                <div id="dateshow">
                                                @if ($Offerbuy->offerbuy_startdate)
                                                    @if (app()->getLocale() == 'en')
                                                        {{ \Carbon\Carbon::parse($Offerbuy->offerbuy_enddate)->isoFormat('LL') }}
                                                    @else
                                                        {{ \Carbon\Carbon::parse($Offerbuy->offerbuy_enddate)->locale('th')->thaidate('j F Y') }}
                                                    @endif
                                                @endif
                                                <button type="button" onclick="toggleContent({{ $Offerbuy->id }})" class="btn btn-outline-warning"><i class="fas fa-edit"></i></button> 
                                                </div>
                                                <div id="dateedit{{ $Offerbuy->id }}" class="content-block">
                                                    <input type="text" class="form-control"
                                                    onchange="update_date(this.value,{{ $Offerbuy->id }});"
                                                    id="datetimepicker" name="appointment_time"
                                                    value="{{ $Offerbuy->offerbuy_enddate }}">
                                                </div>
                                            </td>
                                            <td>
                                                
                                               
                                                <a href="{{ route('offer.show', $Offerbuy->id) }}"> <button type="button"
                                                        class="btn btn-outline-success"><i class="fa fa-eye"
                                                            aria-hidden="true"></i></button></a>

                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="{{ $Offerbuy->id }}rd_1"
                                                        name="{{ $Offerbuy->id }}status"
                                                        @if ($Offerbuy->status == 1) checked @endif
                                                        onchange="upstatusoffer({{ $Offerbuy->id }},1)"
                                                        class="custom-control-input" value="1">
                                                    <label class="custom-control-label green"
                                                        for="{{ $Offerbuy->id }}rd_1">{{ __('messages.status1') }}</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="{{ $Offerbuy->id }}rd_2"
                                                        name="{{ $Offerbuy->id }}status"
                                                        @if ($Offerbuy->status == 2) checked @endif
                                                        onchange="upstatusoffer({{ $Offerbuy->id }},2)"
                                                        class="custom-control-input" value="2">
                                                    <label class="custom-control-label red"
                                                        for="{{ $Offerbuy->id }}rd_2">{{ __('messages.status2') }}</label>
                                                </div>
                                            </td>
                                            {{-- <td>{{ $seller->statusupdated_at ?? '' }}</td> --}}
                                            {{-- <td>
                                                

                                                <a href="{{ route('seller.edit', $seller->sid) }}"
                                                    class="btn btn-primary">Edit</a>
                                                <form action="{{ route('seller.destroy', $seller->sid) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Are you sure?')">Delete</button>
                                                </form>
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {!! $Offerbuys->withQueryString()->links('pagination::bootstrap-5') !!}
                        </div>
                    </div>
                </div>
            </div>
            {{-- </div> --}}
        </div>
    </div>
@endsection
@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        config = {
            enableTime: false,
            dateFormat: 'Y-m-d',
        }
        flatpickr("input[type=datetime-local]", config);
    </script>
    <script>
        // Initialize Flatpickr with DateTime functionality
        flatpickr("#datetimepicker", {
            enableTime: false, // Enable time selection
            dateFormat: "Y-m-d", // Customize the date and time format as needed
        });
    </script>
    <script>
        function upstatusoffer(id, status) {
            // alert(id+'  '+status);
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ route('admin.upstatusoffer') }}',
                data: {
                    'status': status,
                    'id': id
                },
                success: function(data) {
                    console.log(data.success)
                }
            });
        }
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
    <script>
        function update_date(enddate, id) {
            // var offerbuy_enddate= enddate.value;
            //  alert(enddate);
            $.ajax({
                url: '{{ route('admin.calendar.update') }}',
                method: 'POST',
                data: {
                    enddate: enddate,
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Handle success response
                    console.log(response);
                    console.log('Date updated successfully!');
                    if (response.success) {
                        location.reload();
                        // If the update was successful, show a success message with SweetAlert
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message
                        });
                    } else {
                        // If the update failed, show an error message with SweetAlert
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: response.message
                        });
                    }
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.error(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'An error occurred while processing your request. Please try again later.'
                    });
                }
            });
        }
        function toggleContent(id) {
            // Get the content block element
            var contentBlock = document.getElementById("dateedit"+id);

            // Toggle the display property
            if (contentBlock.style.display === "none") {
                contentBlock.style.display = "block";
            } else {
                contentBlock.style.display = "none";
            }
        }
    </script>
@endpush
