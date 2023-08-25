@extends('backend.admin.layouts.app')

@section('styles')
    <!-- searchable selector -->
    <link href="{{ asset('backend/vendor/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" />
@endsection

@section('content')

    <div class="row justify-content-between">
        <div class="col-9">
            <h1 class="h3 mb-2 text-gray-800">Taxes</h1>
            <p class="mb-4">This page lists all Taxes records that saved in the database country wise.</p>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row bg-white pt-4 pl-3 pr-3 pb-4">
        <div class="col-12">

            <div class="row">
                <div class="col-12 col-md-10">

                    <div class="row">
                        <div class="col-12">

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr class="bg-info text-white">
                                        <th>City Name</th>
                                        <th>PST</th>
                                        <th>GST</th>
                                        <th>HST</th>
                                        <th>Total Tax</th>
                                        <th>{{ __('backend.shared.action') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($taxes as $taxes_key => $tax)
                                        <tr>
                                            <td>{{ $tax->city_name }}</td>
                                            <td>{{ $tax->pst }}%</td>
                                            <td>{{ $tax->gst }}%</td>
                                            <td>{{ $tax->hst }}%</td>
                                            <td>{{($tax->pst) + ($tax->gst) + ($tax->hst) }}%</td>
                                            <td>
                                                <a href="{{ url('/admin/tax/edit', ['tax' => $tax]) }}" class="btn btn-primary btn-circle">
                                                    <i class="fas fa-cog"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <!-- searchable selector -->
    <script src="{{ asset('backend/vendor/bootstrap-select/bootstrap-select.min.js') }}"></script>
    @include('backend.admin.partials.bootstrap-select-locale')

    <script>
        $(document).ready(function() {
            // "use strict";
        });
    </script>
@endsection
