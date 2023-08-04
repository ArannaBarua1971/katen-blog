@extends('include.BackendIncluder');

@section('mainContent')

    <form action="{{ route('Post.storePost') }}" class="form-control" enctype="multipart/form-data" method="POST">
        @csrf
        <h1 class="fs-2">Add post</h1>
        
        <input type="text" name="title" class="form-control mt-3" placeholder="Enter the title">
        @error('title')
            <span class="alert alert-danger">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <div class="d-flex mt-4">
            <div class="col-lg-6">
                <select name="catagory_id" id="catagory" class="form-control">
                    <option selected disabled> select catagory</option>
                    @foreach ($allCatagory as $catagory)
                    <option value="{{ $catagory->id }}"> {{ $catagory->catagory_name }}</option>                        
                    @endforeach
                </select>
                @error('catagory_id')
                    <span class="alert alert-danger">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-lg-6">
                <select name="subcatagory_id" id="subcatagory" class="form-control">
                    <option selected disabled> select sub catagory</option>
                </select>
                @error('subcatagory_id')
                    <span class="alert alert-danger">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="d-flex mt-4 align-items-center ">
            <div class="col-lg-4 me-3">
                <input type="file" name="featured_img" class="form-control">
            </div>
            <div class="col-lg-4 me-3">
                <select name="type" id="type" class="form-control">
                    <option selected disabled> select type</option>
                    <option value="inspiration"> inspiration</option>
                    <option value="populer"> populer</option>
                    <option value="rare"> rare</option>
                </select>
            </div>
            <div class="col-lg-4 text-center">
                <input type="checkbox" value="{{ true }}" name="isbanner" id="isbanner" class="isbanner"  class="form-control">
                <label for="isbanner">yes for banner</label>
            </div>
        </div>
        
        <div class="mt-3" >
            <h1>details:</h1>
            <textarea name="details" id="summernote"></textarea>
        </div>

        <button class="btn btn-primary mx-auto mt-4 mb-4" type="submit">Publish Post</button>
    </form>


@push('customCssforPost')
    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endpush
@push('customjsForPost')
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" ></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- include summernote css/js -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            height: 300,
        });

        $('#catagory').on('change',function(e){
            $.ajax({
                url:"{{ route('Post.getDataforForm') }}",
                method:'get',
                data:{
                    'catagory_id' : $(this).val(),
                },
                success:function($datas){
                    let optionArray=[];
                    optionArray.push('<option selected disabled> select sub catagory</option>');
                    $datas.forEach(data => {
                        let newOption=`<option value="${data.id}">${data.subcatagory_name}</option>`;
                        optionArray.push(newOption);
                    });
                    $('#subcatagory').html(optionArray);
                }
            })
        })
        
    });
</script>
@endpush

@endsection