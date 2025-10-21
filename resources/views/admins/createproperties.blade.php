@extends('layouts.admin')
@section('content')

    <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">

       
                    <h5 class="card-title mb-5 d-inline">Create Properties</h5>
                    <form method="POST" action="{{ route('properties.store') }}" enctype="multipart/form-data">
                        @csrf
                        <!-- Email input -->
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="title" value="{{ old('title') }}" id="form2Example1" class="form-control" placeholder="title" />
                                @error('title')
                                    <small class="text-danger"><strong>{{ $message }}</strong></small>
                                  @enderror
                        </div>  
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="price" value="{{ old('price') }}" id="form2Example1" class="form-control" placeholder="price" />
                             @error('price')
                                    <small class="text-danger"><strong>{{ $message }}</strong></small>
                                @enderror
                        </div> 
                        <div class="mb-3">
                          <label for="formFile" class="form-label">Property image</label>
                            <input name="image" value="{{ old('image') }}" class="form-control" type="file" id="formFile">
                             @error('image')
                                    <small class="text-danger"><strong>{{ $message }}</strong></small>
                                  @enderror
                        </div> 
                     
                        
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="bed" value="{{ old('bed') }}" id="form2Example1" class="form-control" placeholder="beds" />
                                @error('bed')
                                    <small class="text-danger"><strong>{{ $message }}</strong></small>
                                  @enderror
                        </div>
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="baths" value="{{ old('baths') }}" id="form2Example1" class="form-control" placeholder="baths" />
                         @error('baths')
                                    <small class="text-danger"><strong>{{ $message }}</strong></small>
                                  @enderror
                        </div>
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="sq_ft" value="{{ old('sq_ft') }}" id="form2Example1" class="form-control" placeholder="SQ/FT" />
                                @error('sq_ft')
                                    <small class="text-danger"><strong>{{ $message }}</strong></small>
                                  @enderror
                        </div>   
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="year_built" value="{{ old('year_built') }}" id="form2Example1" class="form-control" placeholder="Year Build" />
                                @error('year_built')
                                    <small class="text-danger"><strong>{{ $message }}</strong></small>
                                @enderror
                        </div> 
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="price_sqft" value="{{ old('price_sqft') }}" id="form2Example1" class="form-control" placeholder="Price Per SQ FT" />
                             @error('price_sqft')
                                    <small class="text-danger"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div> 
                        <div class="form-outline mb-4 mt-4">
                          <input type="text" name="location"value="{{ old('location') }}" id="form2Example1" class="form-control" placeholder="location" />
                            @error('location')
                                    <small class="text-danger"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div> 
                        
                        <select name="home_type" value="{{ old('home_type') }}" class="form-control form-select" aria-label="Default select example">
                            <option selected>Select Home Type</option>
                            <option value="Condo">Condo</option>
                            <option value="Commercial">Commercial</option>
                            <option value="Land">Land</option>
                        </select>   
                         @error('home_type')
                                    <small class="text-danger"><strong>{{ $message }}</strong></small>
                        @enderror
                        <select name="type" value="{{ old('type') }}" class="form-control mt-3 mb-4 form-select" aria-label="Default select example">
                            <option selected>Select Type</option>
                            <option value="Buy">For Buy</option>
                            <option value="Rent">For Rent</option>
                        </select> 
                            @error('type')
                                    <small class="text-danger"><strong>{{ $message }}</strong></small>
                            @enderror
                        <select name="city" value="{{ old('city') }}" class="form-control mt-3 mb-4 form-select" aria-label="Default select example">
                          <option selected>Select City</option>
                          <option value="New York">New York</option>
                          <option value="Brooklyn">Brooklyn</option>
                          <option value="London">London</option>
                          <option value="Tokyo">Tokyo</option>
                          <option value="Cairo">Cairo</option>
                      </select>   
                            @error('city')
                                        <small class="text-danger"><strong>{{ $message }}</strong></small>
                            @enderror
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">More Info</label>
                            <textarea placeholder="More Info" name="more_info" value="{{ old('more_info') }}" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                         @error('more_infor')
                                    <small class="text-danger"><strong>{{ $message }}</strong></small>
                                  @enderror
                        </div>
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" value="{{ old('agent_name') }}" name="agent_name" id="form2Example1" class="form-control" placeholder="agent name" />
                         @error('agent_name')
                                    <small class="text-danger"><strong>{{ $message }}</strong></small>
                                  @enderror
                        </div> 
                        
                        
                        <!-- Submit button -->
                        <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>
                
                    </form>

            </div>
          </div>
        </div>
      </div>
@endsection