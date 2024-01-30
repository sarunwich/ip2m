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
                <h2>{{ __('messages.General_information') }}</h2>

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
                <form action="{{ route('work.create.step.two.post') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-2">
                        <div class="col">

                            <label for="title">{{ __('messages.product_name') }}:</label>
                            <input type="text" value="{{ $product->name ?? old('name') ??'' }}" class="form-control" id="taskTitle"
                                name="name" required>

                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col">

                            <label for="title">{{ __('messages.highlight') }}:</label>
                            <input type="text" value="{{ $product->highlight ?? old('highlight') ?? '' }}" class="form-control"
                                id="highlight" name="highlight" required>

                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col">
                            <label for="product_detail" class="form-label">{{ __('messages.product_detail') }}:</label>
                            <textarea class="form-control" id="product_detail" name="product_detail" rows="3" required>{{ $product->product_detail ?? old('product_detail') ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col">
                            <label for="title">{{ __('messages.price') }}:</label>
                            <input type="number" min="0.00" step="0.05" value="{{old('highlight') ?? 0}}" id="price" name="price"
                                class="form-control" required placeholder="Price">
                        </div>
                        <div class="col">
                            <label for="title">{{ __('messages.display') }}:</label>
                            <div class="form-check">
                                <input class="form-check-input" value="1" type="radio" name="display" id="display1"
                                  @if(old('display')==1) checked @endif  checked>
                                <label class="form-check-label" for="display1">
                                    ร่าง (Draft)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" value="2" type="radio" name="display" id="display2" @if(old('display')==2) checked @endif >
                                <label class="form-check-label" for="display2">
                                    แสดงผล (Publish)
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col">
                            <label for="title">{{ __('messages.keyword') }}:</label>
                            <input type="text" value="{{ $product->keyword ?? old('keyword') ??'' }}" class="form-control" id="keyword"
                                name="keyword" required>
                        </div>

                    </div>

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
                                name="category" title="เลือก" disabled data-validation="required">
                                <option id=""> -- Select --</option>


                            </select>
                        </div>

                    </div>


                    <div id="dynamic-form">
                        <div class="row g-2">
                            <div class="col">
                                <label for="field_1">ภาพที่ 1 :</label>
                                <div class="input-group mb-3">
                                    <input type="file" name="fields[]" id="field_1" accept="image/*" class="form-control"
                                        placeholder="Recipient's username" aria-label="Recipient's username"
                                        aria-describedby="button-addon2" required>
                                    {{-- <button class="btn btn-danger" type="button" id="button-addon2">Remove</button> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-success" type="button" onclick="education_fields();" id="add-field">Add
                        Field</button>
                    <br>
                    <div class="row g-3">
                        <div class="col-md-6 text-left">
                            <a href="{{ route('works.create') }}" class="btn btn-danger pull-right">Previous</a>
                        </div>
                        <div class="col-md-6 text-right">
                            <button type="submit" class="btn btn-primary">Submit</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        //     $(document).ready(function () {
        //         let dynamicForm = $('#dynamic-form');
        //         let addButton = $('#add-field');
        //         var room = 1;
        //         $(addButton).click(function () {
        //             room++;
        //             // let fieldNumber = dynamicForm.children().length + 1;

        //             // let newField = `
        //             var divtest = document.createElement("div");
        // 	divtest.setAttribute("class", "form-group removeclass"+room);
        // 	var rdiv = 'removeclass'+room;
        //     divtest.innerHTML = '<div class="row g-2 ">'
        //         +'<div class="col">'
        //             +'<label for="field_'+room+'">ภาพ '+room+'</label>'
        //                     +'<div class="input-group mb-3">'
        //                         +'<input type="file" class="form-control" name="fields[]" id="field_'+room+'">'
        //                         +'<button type="button" class="remove-field btn btn-danger" onclick="remove_education_fields('+ room +');">Remove</button>'
        //                         +'</div></div></div>';

        //     //         var divtest = document.createElement("div");
        // 	// divtest.setAttribute("class", "form-group removeclass"+room); 
        // 	// var rdiv = 'removeclass'+room;
        //     // divtest.innerHTML = '<div class="col-sm-3 nopadding"><div class="form-group"> <input type="text" class="form-control" id="Schoolname" name="Schoolname[]" value="" placeholder="School name"></div></div><div class="col-sm-3 nopadding"><div class="form-group"> <input type="text" class="form-control" id="Major" name="Major[]" value="" placeholder="Major"></div></div><div class="col-sm-3 nopadding"><div class="form-group"> <input type="text" class="form-control" id="Degree" name="Degree[]" value="" placeholder="Degree"></div></div><div class="col-sm-3 nopadding"><div class="form-group"><div class="input-group"> <select class="form-control" id="educationDate" name="educationDate[]"><option value="">Date</option><option value="2015">2015</option><option value="2016">2016</option><option value="2017">2017</option><option value="2018">2018</option> </select><div class="input-group-btn"> <button class="btn btn-danger" type="button" onclick="remove_education_fields('+ room +');"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </button></div></div></div></div><div class="clear"></div>';


        //             $(dynamicForm).append(divtest);
        //         });

        //         $(dynamicForm).on('click', '.remove-field', function () {
        //             $(this).parent().remove();
        //         });
        //         function remove_education_fields(rid) {
        // 	   $('.removeclass'+rid).remove();
        // 	   room --;
        //    }
        //     });
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
                    '<input type="file" class="form-control" name="fields[]" accept="image/*" id="field_' + room + '"required>' +
                    '<button type="button" class="remove-field btn btn-danger" onclick="remove_education_fields(' + room +
                    ');">Remove</button>' +
                    '</div></div></div>';
                $(dynamicForm).append(divtest);
            }

        }
        function remove_education_fields(rid) {
	   $('.removeclass'+rid).remove();
	   room --;
   }
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
                        '<option value="">หมวดหมู่ธุรกิจ</option>');
                    $.each(data.categorys, function(key, value) {
                        $('#category').append('<option value="' + value
                            .category_id + '">' + value.category_name +
                            '</option>');
                    });
                }
            });
        }
    </script>
@endpush
