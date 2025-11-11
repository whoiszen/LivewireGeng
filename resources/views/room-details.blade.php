<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <a href="{{ route('rooms.index') }}" class="btn btn-outline-secondary me-3">
                    <svg class="bi me-1" width="16" height="16" fill="currentColor">
                        <use xlink:href="#arrow-left"/>
                    </svg>
                    Back to Rooms
                </a>
                <div class="d-flex align-items-center px-3 py-2 bg-dark text-white rounded shadow-sm">
                    <span class="fw-bold">UNITRA</span>
                </div>
            </div>
            <div class="d-flex align-items-center">
                <span class="badge bg-primary fs-6 px-3 py-2 me-3">Room {{ $room->room_number }}</span>
                <span class="badge {{ $room->renter ? 'bg-danger' : 'bg-success' }} fs-6 px-3 py-2">
                    {{ $room->renter ? 'Occupied' : 'Available' }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="container-fluid py-5">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Hero Image Carousel -->
                <div class="card mb-4 shadow">
                    <div class="card-body p-0">
                        <div id="roomImageCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @for($i = 0; $i < 4; $i++)
                                <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
                                    <img src="{{ asset('images/rooms/pic' . ($i + 1) . '.jpeg') }}"
                                         class="d-block w-100" alt="Room {{ $room->room_number }} - Image {{ $i + 1 }}"
                                         style="height: 400px; object-fit: cover;">
                                </div>
                                @endfor
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#roomImageCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#roomImageCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Room Overview -->
                <div class="card mb-4 shadow">
                    <div class="card-header bg-white">
                        <h3 class="card-title mb-0 fw-bold">Room Overview</h3>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h4 class="h5 fw-semibold mb-3">Room Specifications</h4>
                                <div class="row g-3">
                                    <div class="col-6">
                                        <div class="p-3 bg-light rounded text-center">
                                            <div class="fw-bold text-primary fs-4">{{ $room->room_number }}</div>
                                            <small class="text-muted">Room Number</small>
