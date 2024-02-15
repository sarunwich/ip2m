@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- <div class="container-fluid"> --}}
        <div class="row justify-content-center">
            <div class="col-md-6">
                <strong class="strong"> IP Mart</strong>
                <h1>Shopping Online</h1>
                <h5>
                



{{ __('messages.title') }}
                </h5>
            </div>
            <div class="col-md-6">
                <img src="{{ asset('storage/images/thonglangshop.png') }}" width="100%" alt="Image Alt Text">

            </div>

        </div>

        <div class="row justify-content-center mt-4">

            <div class="col-md-12">
                <div class="card">
                    {{-- <div class="custom-red-header text-center" >New arrival</div> --}}
                    <div class="custom-red-header d-flex justify-content-between align-items-center text-center">
                        <h3 class="card-title  ml-4"> {{ __('messages.Newarrival') }}</h3>
                        <a href="#" class="btn btn-primary float-end">ดูรายละเอียด</a>

                    </div>
                    <div class="card-body">
                        {{--  --}}
                        <div class="row">
                            <!-- เพิ่มสินค้าตามต้องการ -->

                            @foreach ($sellers as $seller)
                                <div class="col-md-3 mb-3">
                                    <div class="card">
                                        <img src="{{ asset('storage/ProductImage/'.$seller->images[0]->ProductImage_name) }}" class="card-img-top"
                                            alt="Product">
                                        <div class="card-body" style="background-color: rgb(249, 219, 187)">
                                            <h5 class="card-title">{{ $seller->product_name }}</h5>
                                            <p class="card-text">รายละเอียดสินค้าที่ i2M{{substr($seller->id,2,7)}}</p>
                                            <a href="{{ route('showproduct', $seller->id) }}" ><button class="buttonred">ดูรายละเอียด</button></a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                        {{--  --}}
                    </div>
                </div>
            </div>
            <br>
        </div>
        <div class="row justify-content-center mt-4">
            {{-- ตามหาผลิตภัน --}}
            <div class="col-md-12">
                <div class="card">
                    {{-- <div class="custom-red-header text-center" >New arrival</div> --}}
                    <div class="custom-red-header d-flex justify-content-between align-items-center text-center">
                        <h3 class="card-title  ml-4"> {{ __('messages.Find_product') }}</h3>
                        <a href="#" class="btn btn-primary float-end">ดูรายละเอียด</a>

                    </div>
                    <div class="card-body">
                        {{--  --}}
                        <div class="row">
                            <!-- เพิ่มสินค้าตามต้องการ -->

                            @foreach ($offerbuys as $offerbuy)
                                <div class="col-md-3 mb-3">
                                    <div class="card">
                                        <img src="{{ asset('storage/ProductImagebuys/'.$offerbuy->imagesbuy[0]->ProductImagebuy_name) }}" class="card-img-top"
                                            alt="Product">
                                        <div class="card-body" style="background-color: rgb(249, 219, 187)">
                                            <h5 class="card-title">{{ $offerbuy->Interest_data }}</h5>
                                            <p class="card-text">รายละเอียดสินค้าที่ F{{$offerbuy->id}}</p>
                                            <a href="{{ route('showoffer', $offerbuy->id) }}" ><button class="buttonred">ดูรายละเอียด</button></a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                        {{--  --}}
                    </div>
                </div>
            </div>
            <br>
        </div>
        <div class="row justify-content-center mt-4">
            {{--  --}}
            <div class="col-md-12">
                <div class="card ">
                    <div class="custom-red-header d-flex justify-content-between align-items-center text-center">
                        <h3 class="card-title ml-4"> {{ __('messages.group') }}</h3>
                        <a href="/categories" class="btn btn-primary float-end">ดูรายละเอียด</a>
                    </div>

                    <div class="card-body">
                        {{--  --}}
                        <div class="row">
                            <!-- เพิ่มสินค้าตามต้องการ -->

                            @for ($i = 1; $i <= 8; $i++)
                                <div class="col-md-3 mb-3">
                                    <div class="card ">
                                        {{-- <img src="{{ asset('storage/images/demop.png') }}" class="card-img-top" alt="Product"> --}}
                                        <div class="card-body ">
                                            <h5 class="card-title ">Product {{ $i }}</h5>
                                            <p class="card-text">จำนวนรายการที่มี {{ $i }}</p>

                                        </div>
                                    </div>
                                </div>
                            @endfor


                        </div>
                        {{--  --}}
                    </div>
                </div>
            </div>
            {{--  --}}
        </div>

    </div>
@endsection
