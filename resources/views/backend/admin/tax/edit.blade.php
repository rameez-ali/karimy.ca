@extends('backend.admin.layouts.app')

@section('styles')
    <!-- Image Crop Css -->
    <link href="{{ asset('backend/vendor/croppie/croppie.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/vendor/spectrum/spectrum.min.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="row justify-content-between">
        <div class="col-9">
            <h1 class="h3 mb-2 text-gray-800">Edit Tax</h1>
            <p class="mb-4">Edit the Tax Value of {{$tax->city_name}}</p>
        </div>
        <div class="col-3 text-right">
            <a href="{{ route('admin.tax.index') }}" class="btn btn-info btn-icon-split">
                <span class="icon text-white-50">
                  <i class="fas fa-backspace"></i>
                </span>
                <span class="text">{{ __('backend.shared.back') }}</span>
            </a>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row bg-white pt-4 pl-3 pr-3 pb-4">
        <div class="col-12">

            <div class="row">
                <div class="col-12">
                    <form method="POST" action="{{ route('admin.tax.update', ['id' => $tax->id]) }}" class="">
                        @csrf
                        @method('PUT')

                        <div class="row border-left-primary mb-4">
                            <div class="col-12">
                                <div class="form-row mb-4 bg-primary pl-1 pt-1 pb-1">
                                    <div class="col-md-12">
                                        <span class="text-lg text-white">
                                             <i class="fa-solid fa-layer-group"></i>
                                             Tax Information
                                        </span>
                                        <!--<small class="form-text text-white">-->
                                        <!--    Fill out the basic information of the category.-->
                                        <!--</small>-->
                                    </div>
                                </div>

                                <div class="form-row mb-3">
                                    
                                    <div class="col-md-4">
                                        <label for="pst" class="text-black">PST</label>
                                        <input id="pst" type="number" min="0" class="form-control @error('pst') is-invalid @enderror" name="pst" value="{{ old('pst') ? old('pst') : $tax->pst }}">
                                        @error('pst')
                                        <span class="invalid-tooltip">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label for="gst" class="text-black">GST</label>
                                        <input id="gst" type="number" min="0" class="form-control @error('gst') is-invalid @enderror" name="gst" value="{{ old('gst') ? old('gst') : $tax->gst }}">
                                        @error('gst')
                                        <span class="invalid-tooltip">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label for="hst" class="text-black">HST</label>
                                        <input id="hst" type="number" min="0" class="form-control @error('hst') is-invalid @enderror" name="hst" value="{{ old('hst') ? old('hst') : $tax->hst }}">
                                        @error('hst')
                                        <span class="invalid-tooltip">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-8">
                                <button type="submit" class="btn btn-success text-white">
                                    {{ __('backend.shared.update') }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
