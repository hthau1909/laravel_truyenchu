@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('LIST USER') }}
                </div>

                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-8">
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add_user">
                          Thêm user
                        </button>
                        </div>
                        <div class="col-4">
                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible alert-sm fade show col-12" role="alert">
                                  {{ session('status') }}
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                            @endif
                        </div>

                        @include('admin.user.create')

                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped">
                          <caption>List of users</caption>
                          <thead class="thead-dark|thead-light">
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Name</th>
                              <th scope="col">Email</th>
                              <th scope="col">Vai trò</th>
                              <th scope="col">Quyền</th>
                              <th scope="col">Phân Quyền</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($list_user as $user)
                            <tr>
                              <th scope="row">{{ $user->id}}</th>
                              <td>{{$user->name}}</td>
                              <td>{{$user->email}}</td>
                              <td>@mdo</td>
                              <td>Otto</td>
                              <td>
                                <a class="btn btn-primary btn-sm" href="">Cấp quyền</a>
                                <form action="{{ route('user.destroy', ['user' => $user->id ]) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button onclick="return confirm('Bạn có chắc muốn xóa tài khoản này không ?');" title="Xóa tài khoản" class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>
                                </form>
                              </td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
