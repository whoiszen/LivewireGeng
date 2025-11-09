<div class="container-fluid py-5">
    <div class="row justify-content-center mb-5">
        <div class="col-12">
            <div class="d-flex justify-content-center align-items-center gap-4">
                <h2 class="display-5 fw-semibold text-dark mb-0">Available Rooms</h2>
                <div class="input-group" style="width: 300px;">
                    <span class="input-group-text" id="search-addon">
                        <svg class="bi" width="16" height="16" fill="currentColor">
                            <use xlink:href="#search"/>
                        </svg>
                    </span>
                    <input wire:model.live="searchQuery" type="search" class="form-control" placeholder="Search rooms..." aria-label="Search rooms" aria-describedby="search-addon">
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-12">
            <!-- Filter State Indicator -->
            @if($filterType !== 'all')
                <div class="text-center mb-3">
                    <span class="badge bg-primary fs-6 px-3 py-2">Showing {{ $this->getFilterLabel() }}</span>
                </div>
            @endif

            <!-- Filter Tabs -->
            <ul class="nav nav-tabs justify-content-center mb-4" id="roomFilterTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button wire:click="$set('filterType', 'all')" class="nav-link {{ $filterType === 'all' ? 'active' : '' }}" id="all-tab" type="button" role="tab" aria-controls="all" aria-selected="{{ $filterType === 'all' ? 'true' : 'false' }}">All Rooms</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button wire:click="$set('filterType', 'shared')" class="nav-link {{ $filterType === 'shared' ? 'active' : '' }}" id="shared-tab" type="button" role="tab" aria-controls="shared" aria-selected="{{ $filterType === 'shared' ? 'true' : 'false' }}">Shared</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button wire:click="$set('filterType', 'private')" class="nav-link {{ $filterType === 'private' ? 'active' : '' }}" id="private-tab" type="button" role="tab" aria-controls="private" aria-selected="{{ $filterType === 'private' ? 'true' : 'false' }}">Private</button>
                </li>
            </ul>

            <!-- Room Grid -->
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
                @foreach($rooms as $room)
                <div class="col">
                    <div class="card h-100 shadow-sm transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                        <!-- Room Image -->
                        <div class="position-relative">
                            <img src="{{ asset('images/rooms/' . $this->getRoomImage($loop->index)) }}"
                                 class="card-img-top" alt="Room {{ $room->room_number }}" style="height: 200px; object-fit: cover;">
                            <button wire:click="toggleFavorite({{ $room->id }})"
                                    class="btn btn-light btn-sm position-absolute top-0 end-0 m-2 rounded-circle transition-all duration-200 {{ in_array($room->id, $favorites) ? 'text-danger' : 'text-muted' }} hover:scale-110">
                                <svg class="bi" width="16" height="16" fill="{{ in_array($room->id, $favorites) ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="2">
                                    <use xlink:href="#heart"/>
                                </svg>
                            </button>
                        </div>

                        <!-- Room Details -->
                        <div class="card-body d-flex flex-column" style="min-height: 220px;">
                            <!-- Room Name and Rating -->
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="flex-grow-1">
                                    <h5 class="card-title mb-2 fw-bold">Room {{ $room->room_number }}</h5>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex align-items-center me-3">
                                            <svg class="bi text-warning me-1" width="16" height="16" fill="currentColor">
                                                <use xlink:href="#star-fill"/>
                                            </svg>
                                            <span class="fw-semibold text-dark">4.7</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Prominent Price -->
                            <div class="mb-3">
                                <div class="d-flex align-items-baseline">
                                    <span class="display-6 fw-bold text-primary me-2">₱{{ number_format($room->price, 0) }}</span>
                                    <span class="text-muted fw-medium">per month</span>
                                </div>
                                <small class="text-muted">Capacity: {{ $room->capacity }}</small>
                            </div>

                            <!-- Amenities -->
                            <div class="mb-3">
                                <span class="badge bg-light text-dark me-1 border">{{ $room->capacity > 1 ? 'Shared Room' : 'Private Room' }}</span>
                                <span class="badge bg-light text-dark me-1 border">WiFi</span>
                                <span class="badge bg-light text-dark border">Air Conditioning</span>
                            </div>

                            <!-- Action Button -->
                            <button wire:click="viewDetails({{ $room->id }})" class="btn btn-primary w-100 mt-auto fw-semibold">View Details</button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($rooms->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $rooms->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Room Details Modal -->
    @if($showModal && $selectedRoom)
    <div class="modal fade show d-block" tabindex="-1" style="background-color: rgba(0,0,0,0.5);" wire:ignore.self>
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Room {{ $selectedRoom->room_number }} Details</h5>
                    <button type="button" class="btn-close" wire:click="closeModal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Room Image Gallery -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div id="roomImageCarousel" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @for($i = 0; $i < 4; $i++)
                                    <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
                                        <img src="{{ asset('images/rooms/' . $this->getRoomImage($i)) }}"
                                             class="d-block w-100 rounded" alt="Room {{ $selectedRoom->room_number }} - Image {{ $i + 1 }}"
                                             style="height: 300px; object-fit: cover;">
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

                    <!-- Room Information -->
                    <div class="row">
                        <div class="col-md-8">
                            <!-- Room Specs -->
                            <div class="mb-4">
                                <h6 class="fw-bold text-primary mb-3">Room Specifications</h6>
                                <div class="row g-3">
                                    <div class="col-sm-6">
                                        <div class="p-3 bg-light rounded">
                                            <small class="text-muted d-block">Room Number</small>
                                            <span class="fw-semibold">{{ $selectedRoom->room_number }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="p-3 bg-light rounded">
                                            <small class="text-muted d-block">Capacity</small>
                                            <span class="fw-semibold">{{ $selectedRoom->capacity }} {{ $selectedRoom->capacity > 1 ? 'People' : 'Person' }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="p-3 bg-light rounded">
                                            <small class="text-muted d-block">Type</small>
                                            <span class="fw-semibold">{{ $selectedRoom->capacity > 1 ? 'Shared Room' : 'Private Room' }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="p-3 bg-light rounded">
                                            <small class="text-muted d-block">Status</small>
                                            <span class="fw-semibold">{{ $selectedRoom->renter ? 'Occupied' : 'Available' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Amenities -->
                            <div class="mb-4">
                                <h6 class="fw-bold text-primary mb-3">Amenities & Features</h6>
                                <div class="row g-2">
                                    <div class="col-auto">
                                        <span class="badge bg-success fs-6 px-3 py-2">
                                            <svg class="bi me-1" width="16" height="16" fill="currentColor">
                                                <use xlink:href="#wifi"/>
                                            </svg>
                                            WiFi
                                        </span>
                                    </div>
                                    <div class="col-auto">
                                        <span class="badge bg-info fs-6 px-3 py-2">
                                            <svg class="bi me-1" width="16" height="16" fill="currentColor">
                                                <use xlink:href="#snow"/>
                                            </svg>
                                            Air Conditioning
                                        </span>
                                    </div>
                                    <div class="col-auto">
                                        <span class="badge bg-warning fs-6 px-3 py-2">
                                            <svg class="bi me-1" width="16" height="16" fill="currentColor">
                                                <use xlink:href="#lightning"/>
                                            </svg>
                                            Electricity
                                        </span>
                                    </div>
                                    <div class="col-auto">
                                        <span class="badge bg-secondary fs-6 px-3 py-2">
                                            <svg class="bi me-1" width="16" height="16" fill="currentColor">
                                                <use xlink:href="#droplet"/>
                                            </svg>
                                            Water Supply
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="mb-4">
                                <h6 class="fw-bold text-primary mb-3">Description</h6>
                                <p class="text-muted mb-0">
                                    This {{ $selectedRoom->capacity > 1 ? 'shared' : 'private' }} room offers comfortable living space with modern amenities.
                                    {{ $selectedRoom->capacity > 1 ? 'Perfect for students or young professionals looking to share expenses.' : 'Ideal for those seeking privacy and personal space.' }}
                                    All rooms include essential utilities and are located in a secure, well-maintained property.
                                </p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <!-- Pricing Card -->
                            <div class="card border-primary">
                                <div class="card-body text-center">
                                    <div class="mb-3">
                                        <span class="display-4 fw-bold text-primary">₱{{ number_format($selectedRoom->price, 0) }}</span>
                                        <div class="text-muted">per month</div>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="d-grid gap-2">
                                        <button class="btn btn-primary btn-lg fw-semibold">
                                            <svg class="bi me-2" width="16" height="16" fill="currentColor">
                                                <use xlink:href="#calendar"/>
                                            </svg>
                                            Book Now
                                        </button>
                                        <button wire:click="toggleFavorite({{ $selectedRoom->id }})"
                                                class="btn btn-outline-danger fw-semibold">
                                            <svg class="bi me-2" width="16" height="16" fill="{{ in_array($selectedRoom->id, $favorites) ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="2">
                                                <use xlink:href="#heart"/>
                                            </svg>
                                            {{ in_array($selectedRoom->id, $favorites) ? 'Remove from Favorites' : 'Add to Favorites' }}
                                        </button>
                                        <button class="btn btn-outline-secondary fw-semibold">
                                            <svg class="bi me-2" width="16" height="16" fill="currentColor">
                                                <use xlink:href="#telephone"/>
                                            </svg>
                                            Contact Owner
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Rating -->
                            <div class="text-center mt-3">
                                <div class="d-flex align-items-center justify-content-center mb-2">
                                    <div class="me-2">
                                        @for($i = 1; $i <= 5; $i++)
                                        <svg class="bi text-warning" width="16" height="16" fill="currentColor">
                                            <use xlink:href="#star-fill"/>
                                        </svg>
                                        @endfor
                                    </div>
                                    <span class="fw-semibold">4.7 (24 reviews)</span>
                                </div>
                                <small class="text-muted">Based on recent tenant feedback</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Custom CSS for hover effects -->
    <style>
        .transition-all {
            transition: all 0.3s ease;
        }
        .duration-300 {
            transition-duration: 300ms;
        }
        .duration-200 {
            transition-duration: 200ms;
        }
        .hover\:shadow-lg:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05) !important;
        }
        .hover\:-translate-y-1:hover {
            transform: translateY(-4px);
        }
        .hover\:scale-110:hover {
            transform: scale(1.1);
        }
        .text-danger {
            color: #dc3545 !important;
        }
    </style>

    <!-- Bootstrap Icons SVG symbols for icons -->
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
        </symbol>
        <symbol id="heart" viewBox="0 0 16 16">
            <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
        </symbol>
        <symbol id="star-fill" viewBox="0 0 16 16">
            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
        </symbol>
        <symbol id="wifi" viewBox="0 0 16 16">
            <path d="M15.384 6.115a.485.485 0 0 0-.047-.736A.515.515 0 0 0 14.525 5c-.595 0-1.169.05-1.72.143-.525.115-1.122.361-1.216.867a3.144 3.144 0 0 0-.049.645c.016.42.158.886.598 1.284.106.114.22.223.34.327.68.501 1.578.962 2.591.962a.485.485 0 0 0 .342-.131.486.486 0 0 0 .171-.342c.03-.306-.031-.59-.171-.822z"/>
            <path d="M13.683 10.066c-.695 0-1.337.135-1.89.404-.577.286-1.029.806-1.172 1.297a.486.486 0 0 0 .342.598c.106.03.212.05.32.05.306 0 .59-.031.822-.171.286-.135.54-.378.711-.674.286-.42.43-.893.43-1.37a.485.485 0 0 0-.485-.485z"/>
            <path d="M8.5 6.939a.5.5 0 0 0-.5.5v.5c0 1.525-.584 2.976-1.648 4.076a.5.5 0 1 0 .704.704c1.2-1.2 1.944-2.82 1.944-4.78V7.5a.5.5 0 0 0-.5-.5z"/>
            <path d="M7.5 6.939a.5.5 0 0 0-.5.5v.5c0 1.525-.584 2.976-1.648 4.076a.5.5 0 1 0 .704.704c1.2-1.2 1.944-2.82 1.944-4.78V7.5a.5.5 0 0 0-.5-.5z"/>
            <path d="M6.5 6.939a.5.5 0 0 0-.5.5v.5c0 1.525-.584 2.976-1.648 4.076a.5.5 0 1 0 .704.704c1.2-1.2 1.944-2.82 1.944-4.78V7.5a.5.5 0 0 0-.5-.5z"/>
            <path d="M5.5 6.939a.5.5 0 0 0-.5.5v.5c0 1.525-.584 2.976-1.648 4.076a.5.5 0 1 0 .704.704c1.2-1.2 1.944-2.82 1.944-4.78V7.5a.5.5 0 0 0-.5-.5z"/>
            <path d="M4.5 6.939a.5.5 0 0 0-.5.5v.5c0 1.525-.584 2.976-1.648 4.076a.5.5 0 1 0 .704.704c1.2-1.2 1.944-2.82 1.944-4.78V7.5a.5.5 0 0 0-.5-.5z"/>
            <path d="M3.5 6.939a.5.5 0 0 0-.5.5v.5c0 1.525-.584 2.976-1.648 4.076a.5.5 0 1 0 .704.704c1.2-1.2 1.944-2.82 1.944-4.78V7.5a.5.5 0 0 0-.5-.5z"/>
            <path d="M2.5 6.939a.5.5 0 0 0-.5.5v.5c0 1.525-.584 2.976-1.648 4.076a.5.5 0 1 0 .704.704c1.2-1.2 1.944-2.82 1.944-4.78V7.5a.5.5 0 0 0-.5-.5z"/>
            <path d="M1.5 6.939a.5.5 0 0 0-.5.5v.5c0 1.525-.584 2.976-1.648 4.076a.5.5 0 1 0 .704.704c1.2-1.2 1.944-2.82 1.944-4.78V7.5a.5.5 0 0 0-.5-.5z"/>
        </symbol>
        <symbol id="snow" viewBox="0 0 16 16">
            <path d="M8 16a.5.5 0 0 1-.5-.5v-1.293l-.646.647a.5.5 0 0 1-.707-.708L7.5 12.793V8.866l-3.4 1.963-.496 1.85a.5.5 0 1 1-.966-.26l.237-.882-1.12.646a.5.5 0 0 1-.5-.866l1.12-.646-.884-.237a.5.5 0 1 1 .26-.966l1.848.495L7 8 3.6 5.037l-1.85.495a.5.5 0 0 1-.258-.966l.883-.237-1.12-.646a.5.5 0 0 1 .5-.866l1.12.646.237-.883a.5.5 0 1 1 .966.258L3.401 5.64 7 3.866V.5a.5.5 0 0 1 1 0v3.707l3.6 2.063.496-1.85a.5.5 0 1 1 .966.26l-.236.882 1.12-.646a.5.5 0 0 1 .5.866l-1.12.646.883.237a.5.5 0 0 1-.26.966l-1.848-.495L9 8l3.4 1.963 1.85-.495a.5.5 0 0 1 .258.966l-.883.237 1.12.646a.5.5 0 0 1-.5.866l-1.12-.646-.236.883a.5.5 0 1 1-.966-.258l.495-1.848L9 11.134v3.293a.5.5 0 0 1-.5.5z"/>
        </symbol>
        <symbol id="lightning" viewBox="0 0 16 16">
            <path d="M5.52.359A.5.5 0 0 1 6 0h4a.5.5 0 0 1 .474.658L8.694 6H12.5a.5.5 0 0 1 .395.807l-7 9a.5.5 0 0 1-.873-.454L6.823 9.5H3.5a.5.5 0 0 1-.48-.641l2.5-8.5z"/>
        </symbol>
        <symbol id="droplet" viewBox="0 0 16 16">
            <path d="M7.21.8C7.69.48 8 0 8 0c.109.363.234.708.371 1.038.812 1.946 2.073 3.35 3.197 4.6C12.878 7.096 14 8.345 14 10c0 1.657-1.343 3-3 3s-3-1.343-3-3c0-1.197.524-2.252 1.31-2.947l-.14-.227c-.734-1.19-1.753-2.385-2.67-3.415C6.068 3.094 5.017 2.114 4.5 1.5 4.203 1.19 4 1 4 1c0 .109.203.191.5.5C5.017 2.114 6.068 3.094 6.802 4.284c.917 1.03 1.936 2.225 2.67 3.415l.14.227C8.524 7.748 8 8.803 8 10c0 1.657 1.343 3 3 3s3-1.343 3-3c0-1.655-1.122-2.904-2.5-4.276C10.394 4.917 9.25 3.58 8.438 1.634 8.302.708 8.177.363 8 0c0 0-.31.48-.79.8z"/>
        </symbol>
        <symbol id="calendar" viewBox="0 0 16 16">
            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
        </symbol>
        <symbol id="telephone" viewBox="0 0 16 16">
            <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
        </symbol>
    </svg>
</div>
