@extends('dashboard.layout.app')
@section('title' , 'All Users')
@section('content')
  <div class="row">
            <div class="col-xl-12">
            <section class="hk-sec-wrapper">
                            <h5 class="hk-sec-title">Striped Table</h5>
                            <p class="mb-40">Add class <code>.table-striped</code> in table tag.</p>
                            <a class="btn btn-primary" href="{{ route('dash.users.create') }}" > Add User </a>
                            <div class="row">
                                <div class="col-sm">
                                    <div class="table-wrap">
                                        <div class="table-responsive">
                                            <table class="table table-striped mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>role</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                        @foreach ($data as $user)
                                        <tr>
                                                        <td>{{ $loop->index +1 }}</td>
                                                        <td> {{ $user->name }} </td>
                                                        <td>{{ $user->email}}</td>
                                                        <td> 
                                                        @if($user->hasRole(['user' , 'admin' , 'superadmin']))
                                                            @foreach($user->roles as $role)
                                                            {{ $role->display_name }}
                                                            @endforeach
                                                        @else
                                                            {{$user->role}}
                                                        @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('dash.users.edit' ,$user->id) }}" class="mr-25" data-toggle="tooltip" data-original-title="Edit"> <i class="icon-pencil"></i> </a>
                                                            <form method="post" action="{{route('dash.users.destroy' , $user->id)}}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn-danger"> <i class="icon-trash txt-danger"></i> </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                            
                                        @endforeach
                                                    
                                                   
                                                </tbody>
                                            </table>
                                            {{$data->links('pagination::bootstrap-4')}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

            </div>
     </div>           


@endsection