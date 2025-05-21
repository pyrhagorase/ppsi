@extends('user.master')

@section('konten')
<div class="container-fluid py-4">
    <div class="row">
        <!-- Left side - ID Tracking Card (aligned with logo) -->
        <div class="col-md-3 ms-5">
            <div class="card shadow-sm mb-4" style="border-radius: 10px; border: none;">
                <div class="card-body p-4">
                    <h5 class="text-secondary mb-2">ID Tracking</h5>
                    <h1 class="display-5 fw-bold mb-4">2dW13</h1>
                    
                    <ul class="list-unstyled mb-4">
                        <li class="mb-3">
                            <i class="fas fa-user text-secondary me-2"></i> Arlene McCoy
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-calendar text-secondary me-2"></i> August 2, 2013
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-laptop text-secondary me-2"></i> Laptop
                        </li>
                    </ul>
                    
                    <div class="d-grid gap-2">
                        <button class="btn btn-dark py-2" type="button">Details</button>
                        <button class="btn btn-primary py-2" type="button">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Center spacing area -->
        <div class="col-md-5"></div>
        
        <!-- Right side - Search bar (aligned with user profile) -->
        <div class="col-md-3 me-5 d-flex justify-content-end align-items-start">
            <div class="input-group shadow-sm" style="border-radius: 8px; overflow: hidden; max-width: 350px;">
                <span class="input-group-text bg-white border-end-0">
                    <i class="fas fa-bars"></i>
                </span>
                <input type="text" class="form-control border-start-0 border-end-0" placeholder="2dW13" value="2dW13">
                <button class="btn btn-white border border-start-0" type="button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection