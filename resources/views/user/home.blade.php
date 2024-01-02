@extends('layouts.user')

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
    <div class="category-menu">


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
            <a href="#">1</a>/<a href="#">2</a>/<a href="#">3</a>
            </div>
        </div>

    </div>
    <div class="container-fluid">


        <div class="row">
         
            <div class="col-md-12">
                <!-- ส่วนเนื้อหาของหน้าเว็บ -->
                <div class="card">
                    <div class="custom-red-header text-center">New arrival</div>

                    <div class="card-body">
                        {{--  --}}
                        <div class="row">
                            <!-- เพิ่มสินค้าตามต้องการ -->

                            @for ($i = 1; $i <= 8; $i++)
                                <div class="col-md-3 mb-3">
                                    <div class="card">
                                        <img src="{{ asset('storage/images/demop.png') }}" class="card-img-top"
                                            alt="Product">
                                        <div class="card-body" style="background-color: rgb(255, 246, 218)">
                                            <h5 class="card-title">สินค้าที่ {{ $i }}</h5>
                                            <p class="card-text">รายละเอียดสินค้าที่ {{ $i }}</p>
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
