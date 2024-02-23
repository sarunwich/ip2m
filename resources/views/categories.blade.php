@extends('layouts.app')
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
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- เมนูหมวดหมู่ที่แสดงตรงกลางด้านซ้าย -->
            <div class="col-md-3">
                <div class="category-menu">
                    <h2 class="text-center">เมนูหมวดหมู่</h2>
                    <ul>
                        @foreach ($groups as $key => $group)
                            <li> <a href="{{ route('findgroup', $group->group_id) }}">{{ $group->group_name }}</a></li>
                        @endforeach
                        <!-- เพิ่มหมวดหมู่เพิ่มเติมตามต้องการ -->
                    </ul>
                </div>
            </div>
            <!-- ส่วนเนื้อหา -->
            <div class="col-md-9">
                <!-- ส่วนเนื้อหาของหน้าเว็บ -->
                <div class="card">
                    <div class="custom-red-header text-center">New arrival</div>

                    <div class="card-body">
                        {{--  --}}
                        <div class="row">
                            <!-- เพิ่มสินค้าตามต้องการ -->

                            @foreach ($sellers as $seller)
                                <div class="col-md-3 mb-3">
                                    <div class="card">
                                        <img src="{{ asset('storage/ProductImage/' . $seller->images[0]->ProductImage_name) }}"
                                            class="card-img-top" alt="Product">
                                        <div class="card-body" style="background-color: rgb(249, 219, 187)">
                                            <h5 class="card-title">{{ $seller->product_name }}</h5>
                                            <p class="card-text">รายละเอียดสินค้าที่ i2M{{ substr($seller->id, 2, 7) }}</p>
                                            <a href="{{ route('showproduct', $seller->id) }}"><button
                                                    class="buttonred">ดูรายละเอียด</button></a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            {!! $sellers->withQueryString()->links('pagination::bootstrap-5') !!}
                        </div>
                        {{--  --}}
                    </div>
                    <br>
                    <br>
                    <div class="row justify-content-center mt-4">
                        {{-- ตามหาผลิตภัน --}}
                        <div class="col-md-12">
                            <div class="card">
                                <div class="custom-red-header text-center" >{{ __('messages.Find_product') }}</div>
                                {{-- <div
                                    class="custom-red-header d-flex justify-content-between align-items-center text-center">
                                    <h3 class=" ml-4"> {{ __('messages.Find_product') }}</h3>
                                    
                                </div> --}}
                                <div class="card-body">
                                    {{--  --}}
                                    <div class="row">
                                        <!-- เพิ่มสินค้าตามต้องการ -->
                                        {{-- {{dd($offerbuys)}} --}}
                                        @foreach ($offerbuys as $offerbuy)
                                            <div class="col-md-3 mb-3">
                                                <div class="card">


                                                    @if ($offerbuy->imagesbuy)
                                                        <img src="{{ asset('storage/images/ip2m.jpg') }}"
                                                            class="card-img-top" alt="Product">
                                                    @else
                                                        <img src="{{ asset('storage/ProductImagebuys/' . $offerbuy->imagesbuy[0]->ProductImagebuy_name) }}"
                                                            class="card-img-top" alt="Product">
                                                    @endif

                                                    <div class="card-body" style="background-color: rgb(249, 219, 187)">
                                                        <h5 class="card-title">{{ $offerbuy->Interest_data }}</h5>
                                                        <p class="card-text">รายละเอียดสินค้าที่ F{{ $offerbuy->id }}</p>
                                                        <a href="{{ route('showoffer', $offerbuy->id) }}"><button
                                                                class="buttonred">ดูรายละเอียด</button></a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        {!! $offerbuys->withQueryString()->links('pagination::bootstrap-5') !!}
                                    </div>
                                    {{--  --}}
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
