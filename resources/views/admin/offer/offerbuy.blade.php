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
</style>
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
                                            <td></td>
                                            <td>{{ $Offerbuy->Interest_data }}</td>
                                            <td> @if(app()->getLocale()=='en') {{ \Carbon\Carbon::parse($Offerbuy->created_at)->isoFormat('LL') }} @else {{ \Carbon\Carbon::parse($Offerbuy->created_at)->locale('th')->thaidate('j F Y') }} @endif</td>
                                            <td>@if($Offerbuy->offerbuy_startdate) @if(app()->getLocale()=='en') {{ \Carbon\Carbon::parse($Offerbuy->offerbuy_startdate)->isoFormat('LL') }} @else {{ \Carbon\Carbon::parse($Offerbuy->offerbuy_startdate)->locale('th')->thaidate('j F Y') }} @endif @endif</td>
                                            <td>@if($Offerbuy->offerbuy_startdate)@if(app()->getLocale()=='en') {{ \Carbon\Carbon::parse($Offerbuy->offerbuy_enddate)->isoFormat('LL') }} @else {{ \Carbon\Carbon::parse($Offerbuy->offerbuy_enddate)->locale('th')->thaidate('j F Y') }} @endif @endif</td>
                                            <td>
                                                {{-- @if ($seller->status == 1)
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
                                                @endif --}}
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="{{$Offerbuy->id}}rd_1" name="{{$Offerbuy->id}}status" @if ($Offerbuy->status == 1) checked @endif onchange="upstatusoffer({{$Offerbuy->id}},1)" class="custom-control-input" value="1">
                                                    <label class="custom-control-label green" for="{{$Offerbuy->id}}rd_1">{{ __('messages.status1') }}</label>
                                                  </div>
                                                  <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="{{$Offerbuy->id}}rd_2" name="{{$Offerbuy->id}}status" @if ($Offerbuy->status == 2) checked @endif onchange="upstatusoffer({{$Offerbuy->id}},2)" class="custom-control-input" value="2">
                                                    <label class="custom-control-label red" for="{{$Offerbuy->id}}rd_2">{{ __('messages.status2') }}</label>
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
                        </div>
                    </div>
                </div>
            </div>
            {{-- </div> --}}
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        function upstatusoffer(id,status){
            // alert(id+'  '+status);
            $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/upstatusoffer',
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
@endpush
