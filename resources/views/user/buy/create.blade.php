@extends('layouts.user')
@push('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
@endpush
@section('content')
    <div class="container">
        {{-- <div class="container-fluid"> --}}
        <div class="row justify-content-center">
            <div class="col-md-3 left-side">
                <h2>{{ __('messages.AddTender_offer') }}</h2>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {{-- @if ($ipdata)
                    @dd($ipdata)
                @endif --}}
            </div>
            <div class="col-md-9 right-side">
                <form class="row g-2" action="{{ route('buy.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-2">
                        <div class="col">
                            <label for="category">{{ __('messages.group') }} :</label>
                            <select class="form-control select2bs4 " style="width: 100%" onchange="finecategory(this.value)"
                                id="group" name="group" data-validation="required">
                                <option id=""> ----- กลุ่มสินค้า -----</option>
                                @foreach ($groups as $group)
                                    <option value="{{ $group->group_id }}"
                                        @if (old('group') == $group->group_id) selected @endif>{{ $group->group_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="category">{{ __('messages.category') }}:</label>
                            <select class="form-control select2bs4" title="Please select" style="width:100%" id="category"
                                name="category_id" title="เลือก" disabled data-validation="required">
                                <option id=""> -- Select --</option>


                            </select>
                        </div>

                    </div>
                    <div class="row g-2">
                        <div class="col">
                            <label for="inputGroupSelect01" class="form-label">{{ __('messages.profile') }}</label>
                            
                            <select class="form-select" id="inputGroupSelect01" name="profile_id">
                                <option selected>Choose...</option>
                                @foreach($profiles as $profile)
                                <option value="{{ $profile->profile_id}}">{{ $profile->profile_name }}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="col">

                            <label for="title">{{ __('messages.Interest_data') }}:</label>
                            <input type="text" value="{{ old('Interest_data') ?? '' }}" maxlength="500"
                                class="form-control" id="taskTitle" name="Interest_data" required>

                        </div>
                    </div>

                    <div class="row g-2">
                        <div class="col">
                            <label for="pid" class="form-label">{{ __('messages.detail') }}</label>
                            <textarea class="form-control" id="offbuy_detail" name="offbuy_detail" rows="3" required>{{ old('offbuy_detail') ?? '' }}</textarea>
                        </div>
                    </div>


                    <div class="row g-2">
                        <div class="col-4">
                            <label for="title">{{ __('messages.Budget') }}:</label>
                            <input type="text" value="{{ old('offerbuy_price') ?? '' }}" maxlength="500"
                                class="form-control" id="offerbuy_price" name="offerbuy_price" required>
                        </div>
                    </div>
                    <div id="dynamic-form">
                        <div class="row g-2">
                            <div class="col">
                                <label for="field_1">ภาพที่ 1 :</label>
                                <div class="input-group mb-3">
                                    <input type="file" name="fields[]" id="field_1" accept="image/*"
                                        class="form-control" placeholder="Recipient's username"
                                        aria-label="Recipient's username" aria-describedby="button-addon2" >
                                    {{-- <button class="btn btn-danger" type="button" id="button-addon2">Remove</button> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col-2">
                            <button class="btn btn-success"  type="button" onclick="education_fields();" id="add-field">Add
                                Picture</button>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        function finecategory(group_id) {
            $('#category').prop('disabled', false);
            $.ajax({
                url: '{{ route('get.category') }}',
                type: 'POST',
                data: {
                    group_id: group_id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $('#category').empty().append(
                        '<option value="">-- Select --</option>');
                    $.each(data.categorys, function(key, value) {
                        $('#category').append('<option value="' + value
                            .category_id + '">' + value.category_name +
                            '</option>');
                    });
                }
            });
        }

        var room = 1;

        function education_fields() {
            if (room < 5) {
                room++;
                let dynamicForm = $('#dynamic-form');
                var divtest = document.createElement("div");
                divtest.setAttribute("class", "form-group removeclass" + room);
                var rdiv = 'removeclass' + room;
                divtest.innerHTML = '<div class="row g-2 ">' +
                    '<div class="col">' +
                    '<label for="field_' + room + '">ภาพ ' + room + '</label>' +
                    '<div class="input-group mb-3">' +
                    '<input type="file" class="form-control" name="fields[]" accept="image/*" id="field_' + room +
                    '"required>' +
                    '<button type="button" class="remove-field btn btn-danger" onclick="remove_education_fields(' + room +
                    ');">Remove</button>' +
                    '</div></div></div>';
                $(dynamicForm).append(divtest);
            }

        }

        function remove_education_fields(rid) {
            $('.removeclass' + rid).remove();
            room--;
        }
       
    </script>
@endpush
