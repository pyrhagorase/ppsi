@extends('user.master')

@section('konten')
<!-- Hero Section -->
<div class="hero-section" style="background-color: #e6f3fb;">
    <div class="container text-center">
        <h1>Sentra Computer</h1>
        <p>"Sentra Computer – Cepat, Tepat, dan Terpercaya!"</p>
        <a href="{{route('user.tracking')}}" class="btn btn-primary">Start Tracking</a>
    </div>
</div>

<!-- Circuit Board Image Section -->
<div class="w-100">
    <img src="{{ asset('img/banner.jpg') }}" alt="Circuit Board" class="img-fluid w-100" style="object-fit: cover; height: 400px;">
</div>

<!-- Testimonial Section -->
<div class="container mt-5">
    <h2 class="fw-bold">Testimoni</h2>
    <p class="text-secondary">Ulasan & Rating</p>
    
    <div class="row g-4 mt-3">
        <!-- Testimoni 1 -->
        <div class="col-md-4">
            <div class="testimonial-card">
                <h4 class="fw-bold">"Quote"</h4>
                <div class="testimonial-author">
                    <img src="{{ asset('img/avatar.png') }}" alt="Avatar">
                    <div class="testimonial-author-info">
                        <h5>Title</h5>
                        <p>Description</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Testimoni 2 -->
        <div class="col-md-4">
            <div class="testimonial-card">
                <h4 class="fw-bold">"Quote"</h4>
                <div class="testimonial-author">
                    <img src="{{ asset('img/avatar.png') }}" alt="Avatar">
                    <div class="testimonial-author-info">
                        <h5>Title</h5>
                        <p>Description</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Testimoni 3 -->
        <div class="col-md-4">
            <div class="testimonial-card">
                <h4 class="fw-bold">"Quote"</h4>
                <div class="testimonial-author">
                    <img src="{{ asset('img/avatar.png') }}" alt="Avatar">
                    <div class="testimonial-author-info">
                        <h5>Title</h5>
                        <p>Description</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Testimoni 4 -->
        <div class="col-md-4">
            <div class="testimonial-card">
                <h4 class="fw-bold">"Quote"</h4>
                <div class="testimonial-author">
                    <img src="{{ asset('img/avatar.png') }}" alt="Avatar">
                    <div class="testimonial-author-info">
                        <h5>Title</h5>
                        <p>Description</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Testimoni 5 -->
        <div class="col-md-4">
            <div class="testimonial-card">
                <h4 class="fw-bold">"Quote"</h4>
                <div class="testimonial-author">
                    <img src="{{ asset('img/avatar.png') }}" alt="Avatar">
                    <div class="testimonial-author-info">
                        <h5>Title</h5>
                        <p>Description</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Testimoni 6 -->
        <div class="col-md-4">
            <div class="testimonial-card">
                <h4 class="fw-bold">"Quote"</h4>
                <div class="testimonial-author">
                    <img src="{{ asset('img/avatar.png') }}" alt="Avatar">
                    <div class="testimonial-author-info">
                        <h5>Title</h5>
                        <p>Description</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
