@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Hometypes</h5>
              <a href="create-hometype.html" class="btn btn-primary mb-4 text-center float-right">Create Hometypes</a>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">name</th>
                    <th scope="col">update</th>
                    <th scope="col">delete</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($allHomeTypes as $allHomeType )
                        
                    <tr>
                        <th scope="row">{{ $allHomeType->id }}</th>
                        <td>{{ $allHomeType->home_types }}</td>
                        <td><a  href="{{ route('', ) }}" class="btn btn-warning text-white text-center ">Update</a></td>
                        <td><a href="{{ route('') }}" class="btn btn-danger  text-center ">Delete</a></td>
                    </tr>
                    @endforeach
                </tbody>
              </table> 
            </div>
          </div>
        </div>
      </div>
      @endsection