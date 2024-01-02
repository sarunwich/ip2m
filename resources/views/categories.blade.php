@extends('layouts.app')
  
@section('content')

<div class="container-fluid">
    <div class="row">
        <!-- เมนูหมวดหมู่ที่แสดงตรงกลางด้านซ้าย -->
        <div class="col-md-3">
            <div class="category-menu">
                <h2 class="text-center">เมนูหมวดหมู่</h2>
                <ul>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <!-- เพิ่มหมวดหมู่เพิ่มเติมตามต้องการ -->
                </ul>
            </div>
        </div>
        <!-- ส่วนเนื้อหา -->
        <div class="col-md-9">
            <!-- ส่วนเนื้อหาของหน้าเว็บ -->
            <div class="card">
                <div class="custom-red-header text-center" >New arrival</div>

                <div class="card-body">
                    {{--  --}}
                    <div class="row">
                        <!-- เพิ่มสินค้าตามต้องการ -->

                        @for ($i = 1; $i <=8 ; $i++)
                            
                            <div class="col-md-3 mb-3">
                            <div class="card">
                                <img src="{{ asset('storage/images/demop.png') }}" class="card-img-top" alt="Product">
                                <div class="card-body" style="background-color: rgb(255, 246, 218)">
                                    <h5 class="card-title">สินค้าที่ {{$i}}</h5>
                                    <p class="card-text">รายละเอียดสินค้าที่ {{$i}}</p>
                                    <a href="#" class="btn btn-primary">ดูรายละเอียด</a>
                                </div>
                            </div>
                        </div>
                        @endfor
                        
                       
                    </div>
                    {{--  --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection