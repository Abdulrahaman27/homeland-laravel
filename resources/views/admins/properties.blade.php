@extends('layouts.admin')
@section('content')
       <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
            <div class="container">
                    @if (session('success'))
                        <div class="alert alert-success text-center">
                            {{ session('success') }}
                        </div>
                    @endif
            </div>
              <h5 class="card-title mb-4 d-inline">Properties</h5>
              <a href="{{ route('admins.properties') }}" class="btn btn-primary mb-4 text-center float-right ">Create Properties</a>
              <a href="{{ route('gallery.create') }}" class="btn btn-primary mb-4 text-center float-right mr-5">Create Gallery</a>

              <table class="table mt-4">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">name</th>
                    <th scope="col">price</th>
                    <th scope="col">home type</th>
                    <th scope="col">delete</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    @foreach ($allProperties as $property)
                        
                    <th scope="row">{{ $property->id }}</th>
                    <td>{{ $property->location }}</td>
                    <td>{{ $property->price }}</td>
                    <td>{{ $property->home_type }}</td>
                     <td><a href="{{ route('delete.props', $property->id) }}" class="btn btn-danger  text-center ">delete</a></td>
                  </tr>
                    @endforeach
                </tbody>
              </table> 
            </div>
          </div>
        </div>
      </div>

@endsection