@extends('layouts.admin')

@section('content')
   

    <div class="mcategory-menu">
        {{-- <div class="row justify-content-center"> --}}

        <div class="mb-3 row justify-content-center">

            <div class="col-sm-6 ">
                <div class="input-group ">
                    <input type="text" class="form-control" placeholder="Search this blog">
                    <div class="input-group-append ">
                        <button class="btn btn-secondary" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-search" viewBox="0 0 16 16">
                                <path
                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-3 row justify-content-center">
            <div class="col-sm-6 text-center">
               
            </div>
        </div>

    </div>

    {{-- <div class="container-fluid"> --}}
    <br>
    <div class="row justify-content-center">

        {{-- {{dd($product)}} --}}


        <div class="col-md-9">
            <!-- ส่วนเนื้อหาของหน้าเว็บ -->
            <div class="row">

                <div class="col-md-6 left-side">
                    @if ($offerbuy->imagesbuy)
                        <img src="{{ asset('storage/images/ip2m.jpg') }}" class="card-img-top" alt="Product">
                    @else
                        <img src="{{ asset('storage/ProductImagebuys/' . $offerbuy->imagesbuy[0]->ProductImagebuy_name) }}"
                            class="card-img-top" alt="Product">
                    @endif
                    <hr>
                </div>

                <div class="col-md-6 right-side">
                    <strong>
                        <p>{{ __('messages.Interest_data') }}</p>
                    </strong>
                    {{ $offerbuy->Interest_data }}
                    <hr>
                    <strong>
                        <p>{{ __('messages.category') }}</p>
                    </strong>
                    {{ $offerbuy->category->category_name }}
                    <hr>
                    <strong>{{ __('messages.detail') }}:</strong>
                    {{ $offerbuy->offbuy_detail }}
                    <hr>
                    <strong>{{ __('messages.Budget') }}:</strong>
                    {{ $offerbuy->offerbuy_price }}
                    <hr>


                    <strong class="mb-4">{{ __('messages.startdate') }}:</strong>
                    @if (app()->getLocale() == 'en')
                        {{ \Carbon\Carbon::parse($offerbuy->offerbuy_startdate)->isoFormat('LL') }}
                    @else
                        {{ \Carbon\Carbon::parse($offerbuy->offerbuy_startdate)->locale('th')->thaidate('j F Y') }}
                    @endif
                    <br><strong class="mb-4">{{ __('messages.enddate') }}:</strong>
                    @if (app()->getLocale() == 'en')
                        {{ \Carbon\Carbon::parse($offerbuy->offerbuy_enddate)->isoFormat('LL') }}
                    @else
                        {{ \Carbon\Carbon::parse($offerbuy->offerbuy_enddate)->locale('th')->thaidate('j F Y') }}
                    @endif
                    <hr>
                    <strong class="mb-4">{{ __('messages.Contact') }}:</strong>
                    {{ $offerbuy->profile_name }} {{ $offerbuy->profile_tel }}
                    <hr>
                    {{-- <a href="{{ route('response.create', ['id' => $offerbuy->id]) }}"><button
                            class="buttonred">{{ __('messages.ResponseTenderOffer') }}</button></a> --}}
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="{{$offerbuy->id}}rd_1" name="{{$offerbuy->id}}status" @if ($offerbuy->status == 1) checked @endif onchange="upstatusoffer({{$offerbuy->id}},1)" class="custom-control-input" value="1">
                                <label class="custom-control-label green" for="{{$offerbuy->id}}rd_1">{{ __('messages.status1') }}</label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="{{$offerbuy->id}}rd_2" name="{{$offerbuy->id}}status" @if ($offerbuy->status == 2) checked @endif onchange="upstatusoffer({{$offerbuy->id}},2)" class="custom-control-input" value="2">
                                <label class="custom-control-label red" for="{{$offerbuy->id}}rd_2">{{ __('messages.status2') }}</label>
                              </div>
                </div>
            </div>
            <br>


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
