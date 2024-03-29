@extends('layouts.user')
@push('style')
    <style>
        .card-title {
            width: auto;
            /* or any other width */
            white-space: nowrap;
            /* prevents text from wrapping */
            overflow: hidden;
            /* hides overflow */
            text-overflow: ellipsis;
            /* display an ellipsis (...) to indicate overflow */
        }
    </style>
    @section('content')
        {{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
  
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
  
                    You are a User.
                </div>
            </div>
        </div>
    </div>
</div> --}}

        <div class="mcategory-menu">
            {{-- <div class="row justify-content-center"> --}}

            <div class="mb-3 row justify-content-center">

                <div class="col-sm-6 ">
                    <form action="{{ route('home') }}" method="get">
                        <div class="input-group ">
                            <input type="text" name="q" class="form-control" placeholder="Search this blog">
                            <div class="input-group-append ">
                                <button class="btn btn-secondary" type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-search" viewBox="0 0 16 16">
                                        <path
                                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="mb-3 row justify-content-center">
                <div class="col-sm-12 text-center">
                    @foreach ($iptypes as $key => $iptype)
                        @if ($key != 0)
                            |
                        @endif

                        <a href="{{ route('findtype', $iptype->iptype_id) }}"
                            style="color: white">{{ $iptype->iptype_name }}</a>
                    @endforeach
                </div>
            </div>

        </div>
        <br>
        {{-- <div class="container-fluid"> --}}
        <div class="row justify-content-center">

            <div class="row">

                <div class="col-md-12">
                    <!-- ส่วนเนื้อหาของหน้าเว็บ -->
                    <div class="card">
                        <div class="custom-red-header text-center">
                            <h3>{{ __('messages.Newarrival') }}</h3>
                        </div>

                        <div class="card-body">
                            {{--  --}}
                            <div class="row">
                                <!-- เพิ่มสินค้าตามต้องการ -->
                                @foreach ($sellers as $seller)
                                    {{-- @for ($i = 1; $i <= 8; $i++) --}}
                                    <div class="col-md-3 mb-3">
                                        <div class="card">

                                            {{-- @foreach ($seller->images as $picture)
                                       
                                    @endforeach --}}
                                            <img src="{{ asset('storage/ProductImage/' . $seller->images[0]->ProductImage_name) }}"
                                                class="card-img-top" alt="Product">
                                            <div class="card-body" style="background-color: rgb(255, 246, 218)">
                                                <h5 class="card-title">{{ $seller->product_name }}</h5>
                                                <p class="card-text">รายละเอียดสินค้าที่ i2M{{ substr($seller->id, 2, 7) }}</p>
                                                <a href="{{ route('products.show', $seller->id) }}"><button
                                                        class="buttonred">ดูรายละเอียด</button></a>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- @endfor --}}
                                @endforeach


                            </div>
                            {{--  --}}
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row mt-4">

                <div class="col-md-12">
                    <!-- ตามหา -->
                    <div class="card">
                        <div class="custom-red-header text-center">
                            <h3>{{ __('messages.Find_product') }}</h3>
                        </div>

                        <div class="card-body">
                            {{--  --}}
                            <div class="row">
                                <!-- เพิ่มสินค้าตามต้องการ -->
                                @foreach ($offerbuys as $offerbuy)
                                    {{-- @for ($i = 1; $i <= 8; $i++) --}}
                                    <div class="col-md-3 mb-3">
                                        <div class="card">

                                            {{-- @foreach ($seller->images as $picture)
                                       
                                    @endforeach --}}
                                            @if ($offerbuy->imagesbuy)
                                                <img src="{{ asset('storage/images/ip2m.jpg') }}" class="card-img-top"
                                                    alt="Product">
                                            @else
                                                <img src="{{ asset('storage/ProductImagebuys/' . $offerbuy->imagesbuy[0]->ProductImagebuy_name) }}"
                                                    class="card-img-top" alt="Product">
                                            @endif
                                            <div class="card-body" style="background-color: rgb(255, 246, 218)">
                                                <h5 class="card-title">{{ $offerbuy->Interest_data }}</h5>
                                                <p class="card-text">รายละเอียดสินค้าที่ F{{ $offerbuy->id }}</p>
                                                <a href="{{ route('buy.show', $offerbuy->id) }}"><button
                                                        class="buttonred">ดูรายละเอียด</button></a>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- @endfor --}}
                                @endforeach


                            </div>
                            {{--  --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
