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
                                <th scope="col">catagory name</th>
                                <th scope="col">action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($allCatagory as $key=>$catagory) 
                                    <tr>
                                        <th scope="row">{{ $allCatagory->firstItem()+$key }}</th>
                                        <td>{{ $catagory->catagory_name }}</td>
                                        <td class="d-flex">
                                            <a href="{{ Route('catagory.edit',$catagory->slug) }}" class="btn btn-sm btn-primary">edit</a>

                                            <form action="{{ Route('catagory.delete',$catagory->id) }}" method="POST">
                                                @csrf
                                                @method("Delete")
                                                <button class="btn btn-sm btn-danger">delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $allCatagory->links() }}
                    </div>
                    <div class="card p-3 col-lg-5">
                        <div class="intro-y d-flex align-items-center h-10">
                            <h2 class="fs-lg fw-medium truncate me-5">
                                {{ isset($editData) ? "Update Catagory":"Add Catagory" }}
                            </h2>
                        </div>
                        <div class="card-body">
                            <form action="{{ isset($editData)? route('catagory.update',$editData->slug):route('catagory.addCatagory') }}" method="POST">
                                @csrf
                                @if (isset($editData))
                                    @method('PUT')
                                @endif
                                <input type="text" value="{{ isset($editData)? $editData->catagory_name : old('catagory_name') }}" placeholder="catagory name" class="form-control p-3" name="catagory_name">
                                @error('catagory_name')
                                    <span class="alert alert-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <button class="btn btn-primary mt-3 d-block" type="submit">{{ isset($editData)? "Update Catagory":"Add Catagory" }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: catagory -->
    </div>
    <!-- END: Content -->
@endsection
