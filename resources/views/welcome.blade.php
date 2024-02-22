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
    <div class="container">
        {{-- <div class="container-fluid"> --}}
        <div class="row justify-content-center">
            <div class="col-md-6 mx-auto">
                <strong class="strong"> IP Match & Mart</strong>
                <h1>Shopping Online</h1>
                @if (app()->getLocale() == 'th')
                    <div style="text-indent: 2.5em;">
                        TSU IP Match & Mart (IP2M) แพลตฟอร์มบริการและจัดการสิทธิเทคโนโลยี (TSU IP licensing platform)
                        แบบออนไลน์
                        เฟส 2 ซึ่งเป็นโครงการพัฒนาต่อจากระบบ IP TSU System
                        ที่ให้นักวิจัยยื่นจดแจ้งทะเบียนทรัพย์สินทางปัญญาแบบออนไลน์ โดยระบบ IP Match & Mart
                        จะแบ่งเป็นสองระบบงานที่มีจุดประสงค์แตกต่างกัน กล่าวคือ ระบบ IP Match
                        มีวัตถุประสงค์เพื่อสร้างระบบจับคู่ผลงานวิจัยและนวัตกรรมที่เหมาะสมกับผู้ประกอบการหรือผู้สนใจเทคโนโลยีนั้น
                        และระบบ IP Mart
                        เป็นระบบตลาดออนไลน์ของผลงานวิจัยและนวัตกรรมของมหาวิทยาลัยทักษิณที่อนุญาตให้ลูกค้าจากภายนอกมาซื้อผลิตภัณฑ์ได้
                    </div>
                @else
                    <div style="text-indent: 2.5em;">
                        The "TSU IP Match & Mart (IP2M)" is an online service platform and technology rights management
                        system,
                        also known as the TSU IP licensing platform, developed as an extension of the TSU System IP. This
                        platform enables researchers to submit online registrations for intellectual property. The IP Match
                        &
                        Mart system comprises two subsystems with distinct objectives. The IP Match system aims to establish
                        a
                        matching system for research and innovation works suitable for businesses or interested parties. On
                        the
                        other hand, the IP Mart system serves as an online marketplace for research and innovation products
                        from
                        Thaksin University, allowing external customers to purchase these products.
                        {{-- {{ __('messages.title') }} --}}
                    </div>
                @endif
            </div>
            <div class="col-md-6 mx-auto">
                <img src="{{ asset('storage/images/ip2m.jpg') }}" width="100%" alt="Image Alt Text">

            </div>

        </div>

        <div class="row justify-content-center mt-4">

            <div class="col-md-12">
                <div class="card">
                    {{-- <div class="custom-red-header text-center" >New arrival</div> --}}
                    <div class="custom-red-header d-flex justify-content-between align-items-center text-center">
                        <h3 class=" ml-4"> {{ __('messages.Newarrival') }}</h3>
                        {{-- <a href="#" class="btn btn-primary float-end">ดูรายละเอียด</a> --}}

                    </div>
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
                                            <p class="card-text">รายละเอียดสินค้าที่ i2M{{ $seller->id }}</p>
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
                        <h3 class=" ml-4"> {{ __('messages.Find_product') }}</h3>
                        {{-- <a href="#" class="btn btn-primary float-end">ดูรายละเอียด</a> --}}

                    </div>
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


                            @foreach ($groups as $key => $group)
                                <div class="col-md-3 mb-3">
                                    <a href="{{ route('findgroup', $group->group_id) }}">
                                        <div class="card ">
                                            @if ($group->image)
                                                <img src="{{ asset('storage/images/' . $group->image) }}"
                                                    class="card-img-top" alt="Product">
                                            @else
                                            @endif
                                            <div class="card-body ">
                                                {{-- <h5 class="card-title ">Product {{ $i }}</h5> --}}
                                                <p class="card-text">
                                                    <span class="badge rounded-pill bg-success">เสนอซื้อ
                                                    @foreach ($productCount as $product)
                                                        @if ($product->group_id == $group->group_id)
                                                            {{ $product->count }}
                                                        @endif
                                                    @endforeach</span>
                                                    <span class="badge rounded-pill bg-primary">  เสนอขาย
                                                    @foreach ($offerbuyCount as $offerbuy)
                                                        @if ($offerbuy->group_id == $group->group_id)
                                                            {{ $offerbuy->Offercount }}
                                                        @endif
                                                    @endforeach</span>
                                                  
                                                    
                                                </p>

                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach

                        </div>
                        {{--  --}}
                    </div>
                </div>
            </div>
            {{--  --}}
        </div>

    </div>
@endsection
