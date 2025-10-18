@extends('layouts.app')

@section('content')

<div class="site-blocks-cover inner-page-cover overlay" 
     style="background-image: url('{{ asset('assets/images/' . $singleProp->image) }}');" 
     data-aos="fade">
  <div class="container">
    <div class="row align-items-center justify-content-center text-center">
      <div class="col-md-10">
        <span class="d-inline-block text-white px-3 mb-3 property-offer-type rounded">
          Property Details of
        </span>
        <h1 class="mb-2">{{ $singleProp->title }}</h1>
        <p class="mb-5">
          <strong class="h2 text-success font-weight-bold">${{ $singleProp->price }}</strong>
        </p>
      </div>
    </div>
  </div>
</div>

<div class="site-section site-section-sm">
  <div class="container">
    <div class="row">
      <!-- LEFT COLUMN -->
      <div class="col-lg-8">
        <!-- Property Image Slider -->
        <div class="mb-4">
          <div class="slide-one-item home-slider owl-carousel">
            @foreach ($propImages as $propImage)
              <div>
                <img src="{{ asset('assets/images/' . $propImage->image) }}" alt="Image" class="img-fluid rounded">
              </div>
            @endforeach
          </div>
        </div>

        <!-- Property Details -->
        <div class="bg-white property-body border p-4 rounded">
          <div class="row mb-4">
            <div class="col-md-6">
              <strong class="text-success h1">${{ $singleProp->price }}</strong>
            </div>
            <div class="col-md-6">
              <ul class="property-specs-wrap mb-0 float-lg-right">
                <li>
                  <span class="property-specs">Beds</span>
                  <span class="property-specs-number">{{ $singleProp->bed }} <sup>+</sup></span>
                </li>
                <li>
                  <span class="property-specs">Baths</span>
                  <span class="property-specs-number">{{ $singleProp->baths }}</span>
                </li>
                <li>
                  <span class="property-specs">SQ FT</span>
                  <span class="property-specs-number">{{ $singleProp->sq_ft }}</span>
                </li>
              </ul>
            </div>
          </div>

          <div class="row mb-5 text-center">
            <div class="col-md-4 border-top border-bottom py-3">
              <span class="d-block text-black mb-0 caption-text">Home Type</span>
              <strong>{{ $singleProp->home_type }}</strong>
            </div>
            <div class="col-md-4 border-top border-bottom py-3">
              <span class="d-block text-black mb-0 caption-text">Year Built</span>
              <strong>{{ $singleProp->year_built }}</strong>
            </div>
            <div class="col-md-4 border-top border-bottom py-3">
              <span class="d-block text-black mb-0 caption-text">Price/Sqft</span>
              <strong>${{ $singleProp->price_sqft }}</strong>
            </div>
          </div>

          <h2 class="h4 text-black mb-3">More Info</h2>
          <p>{{ $singleProp->more_info }}</p>

          <!-- Gallery -->
          <div class="mt-5">
            <h2 class="h4 text-black mb-3">Gallery</h2>
            <div class="row no-gutters">
              @foreach ($propImages as $propImage)
                <div class="col-6 col-md-4 col-lg-3 mb-3">
                  <a href="{{ asset('assets/images/' . $propImage->image) }}" class="image-popup gal-item">
                    <img src="{{ asset('assets/images/' . $propImage->image) }}" alt="Image" class="img-fluid rounded">
                  </a>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>

      <!-- RIGHT COLUMN -->
      <div class="col-lg-4">
        <!-- Contact Agent -->
        <div class="bg-white widget border rounded p-4 mb-4">
          <h3 class="h4 text-black mb-3">Contact Agent</h3>
          <form action="{{ route('insert.request', $singleProp->id) }}" method="POST" class="form-contact-agent">
            @csrf
            <div class="form-group">
              <input type="hidden" name="prop_id" value="{{ $singleProp->id }}" id="name" class="form-control">
            </div>
            <div class="form-group">
              <input type="hidden" name="agent_name" value="{{ $singleProp->agent_name }}" id="name" class="form-control">
            </div>
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" name="name" id="name" class="form-control">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" name="email" id="email" class="form-control">
            </div>
            <div class="form-group">
              <label for="phone">Phone</label>
              <input type="text" name="phone" id="phone" class="form-control">
            </div>
            <div class="form-group mb-0">
              <input type="submit" name="submit" class="btn btn-primary w-100" value="Send Request">
            </div>
          </form>
        </div>

        <!-- Share Widget -->
        <div class="bg-white widget border rounded p-4">
          <h3 class="h4 text-black mb-3">Share</h3>
          <div>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('single.prop', $singleProp->id) }}&quote={{ $singleProp->title }}" class="pr-3"><span class="icon-facebook"></span></a>
            <a href="https://twitter.com/intent/tweet?url={{ route('single.prop', $singleProp->id) }}&text={{ $singleProp->title }}" class="pr-3"><span class="icon-twitter"></span></a>
            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ route('single.prop', $singleProp->id) }}"><span class="icon-linkedin"></span></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Related Properties -->
<div class="site-section site-section-sm bg-light">
  <div class="container">
    <div class="site-section-title mb-5">
      <h2>Related Properties</h2>
    </div>
    <div class="row">
      @if ($relatedProps->count() > 0)
         @foreach ($relatedProps as $relatedProp)
          <div class="col-md-6 col-lg-4 mb-4">
          <div class="property-entry h-100">
            <a href="{{ route('single.prop', $relatedProp->id) }}" class="property-thumbnail d-block">
              <div class="offer-type-wrap">
                <span class="offer-type bg-success">{{ $relatedProp->type }}</span>
              </div>
              <img src="{{ asset('assets/images/' . $relatedProp->image) }}" alt="Image" class="img-fluid rounded">
            </a>
            <div class="p-4 property-body">
              <a href="#" class="property-favorite"><span class="icon-heart-o"></span></a>
              <h2 class="property-title">
                <a href="{{ route('single.prop', $relatedProp->id) }}">{{ $relatedProp->title }}</a>
              </h2>
              <span class="property-location d-block mb-3">
                <span class="property-icon icon-room"></span> {{ $relatedProp->location }}
              </span>
              <strong class="property-price text-success mb-3 d-block">${{ $relatedProp->price }}</strong>
              <ul class="property-specs-wrap mb-0">
                <li>
                  <span class="property-specs">Beds</span>
                  <span class="property-specs-number">{{ $relatedProp->bed }} <sup>+</sup></span>
                </li>
                <li>
                  <span class="property-specs">Baths</span>
                  <span class="property-specs-number">{{ $relatedProp->baths }}</span>
                </li>
                <li>
                  <span class="property-specs">SQ FT</span>
                  <span class="property-specs-number">{{ $relatedProp->sq_ft }}</span>
                </li>
              </ul>
            </div>
          </div>
        </div>
        @endforeach

      @else
        
        <h3 class="alert-success py-2">No related properties found.</h3>
      
      @endif
     
    </div>
  </div>
</div>

@endsection
