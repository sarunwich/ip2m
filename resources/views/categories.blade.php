@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- เมนูหมวดหมู่ที่แสดงตรงกลางด้านซ้าย -->
            <div class="col-md-3">
                <div class="category-menu">
                    <h2 class="text-center">เมนูหมวดหมู่</h2>
                    <ul>
                        @foreach ($groups as $key => $group)
                            <li>  <a href="{{ route('findgroup', $group->group_id)}}">{{ $group->group_name }}</a></li>
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
                </div>
            </div>
        </div>
    </div>
@endsection
