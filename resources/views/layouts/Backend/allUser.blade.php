@extends('include.BackendIncluder')

@section('mainContent')

            <!-- BEGIN: catagory  -->
            <div class="profile mt-5">
                <div class="row">
                    <div class="card col-lg-12">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">catagory name</th>
                                <th scope="col">action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($allUser as $key=>$user) 
                                    <tr>
                                        <th scope="row">{{ ++$key }}</th>
                                        <td>{{ $user->name }}</td>
                                        <td class="d-flex">
                                            <a href="{{ $user->is_ban ?  Route('user.notban',$user->id):Route('user.ban',$user->id) }}" class="btn btn-sm {{ $user->is_ban ? 'btn-danger':'btn-primary' }}">{{ $user->is_ban ? 'banned':'ban' }}</a>         
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END: catagory -->
    </div>
    <!-- END: Content -->
@endsection
