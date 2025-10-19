@extends('layouts.app')

@section('content')

<div class="site-blocks-cover inner-page-cover overlay" style="background-image: url('{{ asset('assets/images/hero_bg_2.jpg') }}');" data-aos="fade">
  <div class="container">
    <div class="row align-items-center justify-content-center text-center">
      <div class="col-md-10">
        <h1 class="mb-2">Saved properties</h1>
      </div>
    </div>
  </div>
</div>

<div class="site-section site-section-sm bg-light">
  <div class="container">
    <div class="site-section-title mb-5">
      <h2>All Saved Requests</h2>
    </div>
    <div class="row">
      @if ($savedProps->count() > 0)
      @foreach ($savedProps as $saved)
  @if ($saved->property)
    <div class="col-md-6 col-lg-4 mb-4">
      <div class="property-entry h-100">
        <a href="{{ route('single.prop', $saved->property->id) }}" class="property-thumbnail d-block">
          <div class="offer-type-wrap">
            <span class="offer-type bg-success">{{ $saved->property->type }}</span>
          </div>
          <img src="{{ asset('assets/images/' . $saved->property->image) }}" alt="Image" class="img-fluid rounded">
        </a>
        <div class="p-4 property-body">
          <h2 class="property-title">
            <a href="{{ route('single.prop', $saved->property->id) }}">{{ $saved->property->title }}</a>
          </h2>
          <span class="property-location d-block mb-3">
            <span class="property-icon icon-room"></span> {{ $saved->property->location }}
          </span>
          <strong class="property-price text-success mb-3 d-block">
            ${{ $saved->property->price }}
          </strong>
          <ul class="property-specs-wrap mb-0">
            <li><span class="property-specs">Beds</span>
              <span class="property-specs-number">{{ $saved->property->bed }} <sup>+</sup></span></li>
            <li><span class="property-specs">Baths</span>
              <span class="property-specs-number">{{ $saved->property->baths }}</span></li>
            <li><span class="property-specs">SQ FT</span>
              <span class="property-specs-number">{{ $saved->property->sq_ft }}</span></li>
          </ul>
        </div>
      </div>
    </div>
  @endif
@endforeach


      @else
        
        <h3 class="alert-success py-2">There's no requested properties for now.</h3>
      
      @endif
     
    </div>
  </div>
</div>

@endsection