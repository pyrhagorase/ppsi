@extends('user.master')

@section('konten')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2 class="fw-bold">Service Tracking</h2>
            <p class="text-muted">Track your service request status here</p>
        </div>
        <div class="col-md-6">
            <div class="d-flex justify-content-end">
                <div class="input-group" style="max-width: 300px;">
                    <input type="text" class="form-control" placeholder="Search by ID..." aria-label="Search by ID">
                    <button class="btn btn-primary" type="button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        @for ($i = 1; $i <= 8; $i++)
        <div class="col-md-6 col-lg-3">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="text-muted small mb-2">ID Tracking</h5>
                    <h3 class="card-title fw-bold mb-3">2dW13</h3>
                    <ul class="list-unstyled mb-3">
                        <li class="mb-2">
                            <i class="fas fa-user-circle text-primary me-2"></i> Arlene McCoy
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-calendar-alt text-primary me-2"></i> August 2, 2023
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-laptop text-primary me-2"></i> Laptop
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-clock text-primary me-2"></i> Status: 
                            <span class="badge bg-{{ $i % 4 == 0 ? 'success' : ($i % 3 == 0 ? 'warning' : ($i % 2 == 0 ? 'info' : 'danger')) }}">
                                {{ $i % 4 == 0 ? 'Completed' : ($i % 3 == 0 ? 'In Progress' : ($i % 2 == 0 ? 'Received' : 'Pending')) }}
                            </span>
                        </li>
                    </ul>
                    <div class="d-grid gap-2">
                        <a href="{{route('user.detailservice')}}" class="btn btn-dark">Details</a>
                        <button class="btn btn-danger">Hapus</button>
                    </div>
                </div>
            </div>
        </div>
        @endfor
    </div>
    
    <div class="row mt-5">
        <div class="col-12">
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <i class="fas fa-chevron-left"></i> Previous
                        </a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <span class="page-link">...</span>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">67</a></li>
                    <li class="page-item"><a class="page-link" href="#">68</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            Next <i class="fas fa-chevron-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
@endsection