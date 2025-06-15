@extends('guest.master')

@section('konten')
<!-- Hero Section -->
<div class="hero-section" style="background-color: #e6f3fb; margin-top: -20px; padding-top: 4rem; padding-bottom: 4rem;">
    <div class="container text-center">
        <h1>Sentra Computer</h1>
        <p>"Sentra Computer – Cepat, Tepat, dan Terpercaya!"</p>
        <a href="{{route('guest.tracking')}}" class="btn btn-primary">Start Tracking</a>
    </div>
</div>

<!-- Circuit Board Image Section -->
<div class="w-100">
    <img src="{{ asset('img/banner.jpg') }}" alt="Circuit Board" class="img-fluid w-100" style="object-fit: cover; height: 400px;">
</div>

<!-- Testimonial Section -->
<div class="container my-5">
    <h2 class="fw-bold mb-3">Testimoni</h2>
    <p class="text-secondary">Ulasan & Rating dari Pelanggan Kami</p>

    <div class="row g-4 mt-4">
        @forelse($ulasan as $review)
        <div class="col-md-4">
            <div class="p-4 bg-light rounded shadow-sm h-100">
                <div class="mb-2">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="fa{{ $i <= $review->rating ? 's' : 'r' }} fa-star {{ $i <= $review->rating ? 'text-warning' : 'text-muted' }}"></i>
                    @endfor
                    <span class="ms-1 text-muted">({{ $review->rating }}/5)</span>
                </div>
                <blockquote class="blockquote">
                    <p class="mb-2">"{{ Str::limit($review->ulasan, 100) }}"</p>
                </blockquote>
                <div class="d-flex align-items-center mt-3">
                    <img src="{{ asset('img/avatar.png') }}" alt="Avatar" class="rounded-circle me-3" style="width: 50px; height: 50px;">
                    <div>
                        <h6 class="mb-0">{{ $review->nama_pelanggan }}</h6>
                        <small class="text-muted">Service {{ $review->servis->tipe_barang ?? 'Komputer' }}</small><br>
                        <small class="text-muted">{{ $review->created_at->format('d M Y') }}</small>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-md-12 text-center">
            <p class="text-muted">Belum ada testimoni tersedia.</p>
        </div>
        @endforelse
    </div>

    @if($ulasan->count() > 0)
    <div class="text-center mt-4">
        <p class="text-muted">
            <i class="fas fa-heart text-danger me-1"></i> Terima kasih atas kepercayaan {{ $ulasan->count() }}+ pelanggan kami
        </p>
    </div>
    @endif
</div>
@endsection
