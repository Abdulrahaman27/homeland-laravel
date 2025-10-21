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
                    <h5 class="card-title mb-5 d-inline">Create Gallery</h5>
                    <form method="POST" action="{{ route('gallery.store') }}" enctype="multipart/form-data">
                      @csrf
                        <div class="mb-3">
                            <label for="formFileMultiple" class="form-label">Property Images</label>
                            <input name="images[]" class="form-control" type="file" id="formFileMultiple" multiple>
                               @error('images')
                                    <small class="text-danger"><strong>{{ $message }}</strong></small>
                                  @enderror
                        </div>
                        <select name="prop_id" class="form-control mt-3 mb-4 form-select" aria-label="Default select example">
                            <option selected>Select Property</option>
                            <option value="3">871 Crenshaw Blvd</option>
                            <option value="4">Brooklyn</option>
                            <option value="5">853 S Lucerne Blvd</option>
                        </select>  
                        <!-- Submit button -->
                        <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>
                    </form>

            </div>
          </div>
        </div>
      </div>

@endsection