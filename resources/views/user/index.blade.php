@extends('user.layouts.app')
@section('title', 'Home Page')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-4">
                        <a href="{{ route('user.create') }}" class="btn btn-sm btn-info">
                            <i class="fas fa-plus-circle"></i> Create New User
                        </a>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="d-flex mt-4 ">
                                <form action="{{ route('user.search') }}" method="GET" id="search_form">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row ms-3">
                                                <div class="d-flex">
                                                    <div class="input-group input-group-sm mt-1 ml-3 mb-3" >
                                                        <?php $search_data = isset($_GET["search_data"])?$_GET["search_data"]:"";?>
                                                        <input type="text" name="search_data" value="{{ $search_data }}" class="form-control rounded"
                                                            placeholder="Enter Account Number">
                                                        <div class="">
                                                            <button type="submit" class="btn btn-sm ml-3 btn-primary rounded">
                                                                <i class="fa fa-search"></i>  Search
                                                            </button>
                                                        </div>

                                                        <div class="">
                                                            <a onclick="Reset()" class="btn btn-sm ml-3 btn-warning rounded">
                                                                <i class="fa fa-undo"></i> Reset
                                                            </a>
                                                        </div>
                                                       <div class="">
                                                            <button type="submit" name="action" value="user.search" class="btn btn-sm ml-3  btn-success rounded">
                                                                <i class="fa fa-download"></i>  Export
                                                            </button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-4">
                        <div class="card-header ">
                            <div class="d-flex  justify-content-between">
                                <h5>User List</h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Address</th>
                                        {{-- <th scope="col">Created Date</th>
                                    <th scope="col">Updated Date</th> --}}
                                        <th scope="col">Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user as $users)
                                        <tr>
                                            <th>{{ $users->id }}</th>
                                            <td>{{ $users->name }}</td>
                                            <td>{{ $users->email }}</td>
                                            <td>{{ $users->phone }}</td>
                                            <td>{{ $users->address }}</td>
                                            {{-- <td>{{ $users->created_at}}</td>
                                        <td>{{ $users->updated_at }}</td> --}}
                                            <td>
                                                <a href="{{ route('user.delete', $users->id) }}"
                                                    class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash-restore"></i> Delete
                                                </a>
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
