@extends('layouts.app')

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

    {{-- <div class="mcategory-menu">
      

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
                @foreach ($iptypes as $key => $iptype)
                    @if ($key != 0)
                        |
                    @endif
                    <a href="#" style="color: white">{{ $iptype->iptype_name }}</a>
                @endforeach
            </div>
        </div>

    </div> --}}

    {{-- <div class="container-fluid"> --}}
    <br>
    <div class="row justify-content-center">

        {{-- {{dd($product)}} --}}


        <div class="col-md-9">
            <!-- ส่วนเนื้อหาของหน้าเว็บ -->
            <div class="row">
                <div class="col-md-6 left-side">
                    <img src="{{ asset('storage/ProductImage/' . $product->images[0]->ProductImage_name) }}"
                        class="card-img-top" alt="Product">
                    <hr>


                </div>

                <div class="col-md-6 right-side">
                    <strong>
                        <p>{{ __('messages.product_name') }}</p>
                    </strong>
                    {{ $product->product_name }}
                    <hr>
                    <strong>
                        <p>{{ __('messages.Name_of_work_owner') }}</p>
                    </strong>
                    @foreach ($product->IPdatails as $IPdatail)
                        @if ($IPdatail->ipdetail_id == 8)
                            {{ $IPdatail->IPdataDetail_data }}
                        @endif
                    @endforeach
                    <hr>
                    <p> <strong>{{ __('messages.Intellectual_property_type') }}:</strong></p>
                    {{ $product->iptypename }}
                    <hr>
                    <p><strong>{{ __('messages.category') }}:</strong></p>
                    {{ $product->category_name }}
                    <hr>
                    <p><strong>{{ __('messages.price') }}:</strong></p>
                    {{ $product->price }}
                    <hr>
                    <a href="{{ route('appointment.create',['sid' => $product->sid]) }}"><button class="buttonred">{{ __('messages.appointment') }}</button></a>
                    {{-- <p class="card-text">{{ __('messages.product_name') }}</p>
                    {{ $product->product_name }}
                    <p class="card-text">{{ __('messages.product_name') }}</p>
                    {{ $product->product_name }} --}}

                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-12 right-side">
                    {{-- <strong>{{ __('messages.Intellectual_property_type') }}:</strong>
                    {{ $product->iptypename }}
                    <hr>
                    <strong>{{ __('messages.category') }}:</strong>
                    {{ $product->category_name }}
                    <hr>
                    <strong>{{ __('messages.price') }}:</strong>
                    {{ $product->price }}
                    <hr> --}}
                    <strong>{{ __('messages.product_detail') }}:</strong>
                    {{ $product->product_detail }}
                    <hr>

                    @foreach ($product->IPdatails as $IPdatail)
                        @foreach ($iPdetails as $iPdetail)
                            @if ($IPdatail->ipdetail_id == $iPdetail->ipdetail_id && $IPdatail->ipdetail_id != 8)
                                <strong>{{ $iPdetail->ipdetail_name }}:</strong>
                                @php  $type =$iPdetail->type ; @endphp
                            @endif
                        @endforeach
                        @if ($IPdatail->ipdetail_id != 8)
                        @if ($type == 'date')
                         
                                @if (app()->getLocale() == 'en')
                                    {{ \Carbon\Carbon::parse($IPdatail->IPdataDetail_data)->isoFormat('LL') }}
                                @else
                                    {{ \Carbon\Carbon::parse($IPdatail->IPdataDetail_data)->locale('th')->thaidate('j F Y') }}
                                @endif
                            @else
                                {{ $IPdatail->IPdataDetail_data }}
                            @endif
                            {{-- {{ $IPdatail->IPdataDetail_data }} --}}
                            <hr>
                        @endif
                    @endforeach
                    {{-- {{ dd($iPdetails) }} --}}
                </div>
            </div>
        </div>





    </div>
@endsection
