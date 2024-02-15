@extends('layouts.app')

@section('content')
  

   

   
    
    <div class="row justify-content-center">

        {{-- {{dd($product)}} --}}


        <div class="col-md-9">
            <!-- ส่วนเนื้อหาของหน้าเว็บ -->
            <div class="row">

                <div class="col-md-6 left-side">
                    <img src="{{ asset('storage/ProductImagebuys/' . $offerbuy->imagesbuy[0]->ProductImagebuy_name) }}"
                        class="card-img-top" alt="Product">
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
                        @if(app()->getLocale()=='en') {{ \Carbon\Carbon::parse($offerbuy->offerbuy_startdate)->isoFormat('LL') }} @else {{ \Carbon\Carbon::parse($offerbuy->offerbuy_startdate)->locale('th')->thaidate('j F Y') }} @endif
                        <br><strong class="mb-4">{{ __('messages.enddate') }}:</strong>
                        @if(app()->getLocale()=='en') {{ \Carbon\Carbon::parse($offerbuy->offerbuy_enddate)->isoFormat('LL') }} @else {{ \Carbon\Carbon::parse($offerbuy->offerbuy_enddate)->locale('th')->thaidate('j F Y') }} @endif
                       <hr>
                       <strong class="mb-4">{{ __('messages.Contact') }}:</strong>
                        {{ $offerbuy->profile_name }} {{ $offerbuy->profile_tel }} 
                        <hr>
                        <a href="{{ route('response.create',['id' => $offerbuy->id]) }}"><button class="buttonred">{{ __('messages.ResponseTenderOffer') }}</button></a>
                </div>
            </div>
            <br>


        </div>





    </div>
@endsection
