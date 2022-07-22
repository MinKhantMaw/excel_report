@extends('user.layouts.app')
@section('title','Create Page')
@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @if ($errors->any())
                        <div class="alert alert-danger mt-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                   <div class="card mt-4">
                        <div class="card-header">
                            <span>Create User</span>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('user.store') }}" method="POST">
                                @csrf
                                <div class="">
                                    <div class="form-grop">
                                        <label for="">Name</label>
                                        <input type="text" class="form-control" name="name" placeholder="Enter Name">
                                    </div>
                                    <div class="form-grop">
                                        <label for="">Email</label>
                                        <input type="email" class="form-control" name="email" placeholder="Enter Email">
                                    </div>
                                    <div class="form-grop">
                                        <label for="">Phone</label>
                                        <input type="text" class="form-control" name="phone" placeholder="Enter Phone">
                                    </div>
                                    <div class="form-grop">
                                        <label for="">Address</label>
                                        <input type="text" class="form-control" name="address" placeholder="Enter Address   ">
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-success mt-2">Create</button>
                               </div>
                            </form>
                        </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
@endsection
