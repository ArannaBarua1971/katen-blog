@extends('include.BackendIncluder')

@section('mainContent')

            <!-- BEGIN: catagory  -->
            <div class="profile mt-5">
                <div class="row">
                    <div class="card col-lg-7">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Subcatagory name</th>
                                <th scope="col">Catagory name</th>
                                <th scope="col">action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($allSubcatagory as $key=>$Subcatagory) 
                                    <tr>
                                        <th scope="row">{{ ++$key }}</th>
                                        <td>{{ $Subcatagory->subcatagory_name }}</td>
                                        <td>{{ $Subcatagory->catagory->catagory_name }}</td>
                                        <td class="d-flex">
                                            <a href="{{ Route('subCatagory.edit',$Subcatagory->slug) }}" class="btn btn-sm btn-primary">edit</a>
                                            <form action="{{ Route('subCatagory.delete',$Subcatagory->id) }}" method="POST">
                                                @csrf
                                                @method("Delete")
                                                <button class="btn btn-sm btn-danger">delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- {{ $allCatagory->links() }} --}}
                    </div>
                    <div class="card p-3 col-lg-5">
                        <div class="intro-y d-flex align-items-center h-10">
                            <h2 class="fs-lg fw-medium truncate me-5">
                                {{ isset($editData)? "Update Sub Catagory":"Add Sub Catagory" }}
                            </h2>
                        </div>
                        <div class="card-body">
                            <form action="{{ isset($editData)? route('subCatagory.update',$editData->slug):route('subCatagory.addSubCatagory') }}" method="POST">
                                @csrf

                                @if (isset($editData))
                                    @method('PUT')
                                @endif

                                <input type="text" value="{{ isset($editData)? $editData->subcatagory_name : old('subcatagory_name') }}" placeholder="catagory name" class="form-control p-3" name="subcatagory_name">
                                @error('subcatagory_name')
                                    <span class="alert alert-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <select name="catagory_id" id="" class="form-control mt-3">
                                        <option value="" disabled selected >Select ctagory</option>
                                    @foreach ($allcatagory as $catagory)
                                        @if (isset($editData))
                                        {
                                            @if ($editData->catagory_id==$catagory->id){
                                                <option value="{{ $catagory->id }}" selected>{{ $catagory->catagory_name }}</option>
                                            }
                                            @else{
                                                <option value="{{ $catagory->id }}">{{ $catagory->catagory_name }}</option>
                                            }
                                            @endif
                                        }
                                        @else
                                        {
                                            <option value="{{ $catagory->id }}">{{ $catagory->catagory_name }}</option>
                                        }
                                        @endif
                                        
                                    @endforeach
                                </select>
                                @error('catagory_id')
                                    <span class="alert alert-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <button class="btn btn-primary mt-3 d-block" type="submit">{{ isset($editData)? "Update Sub Catagory":"Add Sub Catagory" }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: catagory -->
    </div>
    <!-- END: Content -->
@endsection
