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
    <p class="text-secondary">Ulasan & Rating dari Pelanggan Kami</p>
    
    <div class="row g-4 mt-3">
        @forelse($ulasan as $review)
        <div class="col-md-4">
            <div class="testimonial-card" style="background: #f8f9fa; border-radius: 15px; padding: 25px; height: 100%; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                <!-- Rating Stars -->
                <div class="mb-3">
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= $review->rating)
                            <i class="fas fa-star text-warning"></i>
                        @else
                            <i class="far fa-star text-muted"></i>
                        @endif
                    @endfor
                    <span class="ms-2 text-muted">({{ $review->rating }}/5)</span>
                </div>
                
                <!-- Quote -->
                <h4 class="fw-bold mb-3" style="font-size: 1.1rem; line-height: 1.5;">
                    "{{ Str::limit($review->ulasan, 100) }}"
                </h4>
                
                <!-- Author Info -->
                <div class="testimonial-author d-flex align-items-center">
                    <img src="{{ asset('img/avatar.png') }}" alt="Avatar" 
                         style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                    <div class="testimonial-author-info ms-3">
                        <h5 class="mb-1" style="font-size: 1rem;">{{ $review->nama_pelanggan }}</h5>
                        <p class="mb-0 text-muted" style="font-size: 0.9rem;">
                            Service {{ $review->servis->tipe_barang ?? 'Komputer' }}
                        </p>
                        <small class="text-muted">{{ $review->created_at->format('d M Y') }}</small>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <!-- Default testimonials jika belum ada ulasan -->
        <div class="col-md-4">
            <div class="testimonial-card" style="background: #f8f9fa; border-radius: 15px; padding: 25px; height: 100%; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                <div class="mb-3">
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <span class="ms-2 text-muted">(5/5)</span>
                </div>
                <h4 class="fw-bold mb-3">
                    "Pelayanan sangat memuaskan dan profesional!"
                </h4>
                <div class="testimonial-author d-flex align-items-center">
                    <img src="{{ asset('img/avatar.png') }}" alt="Avatar" 
                         style="width: 50px; height: 50px; border-radius: 50%;">
                    <div class="testimonial-author-info ms-3">
                        <h5 class="mb-1">Customer</h5>
                        <p class="mb-0 text-muted">Service Laptop</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="testimonial-card" style="background: #f8f9fa; border-radius: 15px; padding: 25px; height: 100%; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                <div class="mb-3">
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <span class="ms-2 text-muted">(5/5)</span>
                </div>
                <h4 class="fw-bold mb-3">
                    "Harga terjangkau dan hasilnya berkualitas"
                </h4>
                <div class="testimonial-author d-flex align-items-center">
                    <img src="{{ asset('img/avatar.png') }}" alt="Avatar" 
                         style="width: 50px; height: 50px; border-radius: 50%;">
                    <div class="testimonial-author-info ms-3">
                        <h5 class="mb-1">Customer</h5>
                        <p class="mb-0 text-muted">Service PC</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="testimonial-card" style="background: #f8f9fa; border-radius: 15px; padding: 25px; height: 100%; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                <div class="mb-3">
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <span class="ms-2 text-muted">(5/5)</span>
                </div>
                <h4 class="fw-bold mb-3">
                    "Teknisi berpengalaman dan ramah"
                </h4>
                <div class="testimonial-author d-flex align-items-center">
                    <img src="{{ asset('img/avatar.png') }}" alt="Avatar" 
                         style="width: 50px; height: 50px; border-radius: 50%;">
                    <div class="testimonial-author-info ms-3">
                        <h5 class="mb-1">Customer</h5>
                        <p class="mb-0 text-muted">Service Printer</p>
                    </div>
                </div>
            </div>
        </div>
        @endforelse
    </div>
    
    @if($ulasan->count() > 0)
    <div class="text-center mt-4">
        <p class="text-muted">
            <i class="fas fa-heart text-danger me-2"></i>
            Terima kasih atas kepercayaan {{ $ulasan->count() }}+ pelanggan kami
        </p>
    </div>
    @endif
</div>

@endsection