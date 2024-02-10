@extends('layouts.user')

@section('content')
    <div class="container">
        {{-- <div class="container-fluid"> --}}
        <div class="row justify-content-center">
            <div class="col-md-3 left-side  >
                <h2>{{ __('messages.Work_information') }}</h2>
                <a href="{{ route('works.create') }}" class="btn btn-primary">{{ __('messages.Add_Performance') }}</a>

                @if (session('success'))
                    <div class="alert alert-success mt-3">
                        {{ session('success') }}
                    </div>
                @endif

            </div>
            <div class="col-md-9 right-side">
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th>{{ __('messages.profile_name') }}</th>
                            <th>created_at</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Products as $Product)
                            <tr>
                                <td>{{ $Product->product_name }}</td>
                                <td>{{ $Product->created_at }}</td>
                                <td>
                                    <input data-id="{{$Product->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="แสดงผล (Publish)" data-off="ร่าง (Draft)" {{ $Product->display ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <a href="{{ route('products.edit', $Product->id  ) }}" class="btn btn-primary">Edit</a>
                                    <form action="{{ route('products.destroy', $Product->id  ) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    $(function() {
      $('.toggle-class').change(function() {
          var status = $(this).prop('checked') == true ? 1 : 0; 
          var id = $(this).data('id'); 
           
          $.ajax({
              type: "GET",
              dataType: "json",
              url: '/changeStatus',
              data: {'status': status, 'id': id},
              success: function(data){
                console.log(data.success)
              }
          });
      })
    })
  </script>
  @endpush
