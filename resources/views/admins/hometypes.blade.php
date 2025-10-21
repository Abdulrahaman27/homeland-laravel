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
              <h5 class="card-title mb-4 d-inline">Hometypes</h5>
              <a href="{{ route('hometypes.create') }}" class="btn btn-primary mb-4 text-center float-right">Create Hometypes</a>
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
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $allHomeType->home_types }}</td>
                        <td><a  href="{{ route('hometypes.edit', $allHomeType->id ) }}" class="btn btn-warning text-white text-center ">Update</a></td>
                        <td>
                          <form action="{{ route('hometypes.delete', $allHomeType->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this hometype?');">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger text-center">Delete</button>
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
      @endsection