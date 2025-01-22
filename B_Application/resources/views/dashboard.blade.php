@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="row">
        <div class="col-md-6">
            <div class="small-box bg-info card-custom">
                <div class="inner p-3">
                    <h3 class="display-4">{{ $totalDocuments }}</h3>
                    <p class="lead">Total Documents</p>
                </div>
                <div class="icon">
                    <i class="fas fa-file fa-3x"></i>
                </div>
                <a href="{{ route('documents.index') }}" class="small-box-footer">
                    View Documents <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="small-box bg-success card-custom">
                <div class="inner p-3">
                    <h3 class="display-4">{{ $totalCategories }}</h3>
                    <p class="lead">Total Categories</p>
                </div>
                <div class="icon">
                    <i class="fas fa-list fa-3x"></i>
                </div>
                <a href="{{ route('categories.index') }}" class="small-box-footer">
                    View Categories <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
