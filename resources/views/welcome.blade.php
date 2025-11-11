<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>UNITRA - Multi-Tenant Management System</title>
    <link rel="icon" href="/favicon.ico" sizes="any" />
    <link rel="icon" href="/favicon.svg" type="image/svg+xml" />
    <link rel="apple-touch-icon" href="/apple-touch-icon.png" />

    <!-- Bootstrap CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    />

    <style>
        /* Navbar */
        .navbar-brand {
            font-weight: 700;
            color: white !important;
        }
        .nav-link {
            color: white !important;
            font-weight: 600;
        }
        .nav-link:hover {
            color: #f8c146 !important;
        }

        /* Hero Section */
        .hero-section {
            position: relative;
            background: url('https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1350&q=80') no-repeat center center;
            background-size: cover;
            height: 90vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
        }
        .hero-overlay {
            position: absolute;
            inset: 0;
            background-color: rgba(0, 0, 0, 0.6);
        }
        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 800px;
        }
        .hero-content h1 {
            font-weight: 900;
            font-size: 3.5rem;
            letter-spacing: 2px;
            text-transform: uppercase;
        }
        .hero-subtitle {
            font-size: 1.4rem;
            margin-top: 0.5rem;
            font-weight: 500;
        }

        /* Section Titles */
        h2.section-title {
            font-weight: 700;
            text-align: center;
            margin: 3rem 0 2rem;
        }

        /* Testimonials */
        .testimonial-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 12px rgb(0 0 0 / 0.1);
            padding: 1.5rem;
            text-align: center;
            color: #333;
        }
        .testimonial-card img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            object-fit: cover;
            margin-bottom: 1rem;
        }
        .testimonial-text {
            font-style: italic;
            margin-bottom: 0.8rem;
        }
        .testimonial-author {
            color: #666;
            font-weight: 600;
        }

        /* Pricing Plans */
        .plan-card {
            background-color: #3e1914;
            color: white;
            padding: 2rem 1.5rem;
            border-radius: 0.5rem;
            text-align: center;
            box-shadow: 0 0 20px rgb(62 25 20 / 0.3);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .plan-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 40px rgb(62 25 20 / 0.7);
        }
        .plan-title {
            font-weight: 700;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
        .plan-price {
            font-size: 2rem;
            margin-bottom: 1rem;
        }
        .plan-price small {
            font-size: 1rem;
            color: #f8c146;
        }
        .plan-features {
            text-align: left;
            margin-bottom: 1.5rem;
            list-style: none;
            padding: 0;
        }
        .plan-features li {
            margin-bottom: 0.5rem;
        }
        .plan-features li::before {
            content: '✔';
            color: #f8c146;
            margin-right: 0.5rem;
        }
        .btn-plan {
            background-color: #f8c146;
            color: #3e1914;
            font-weight: 700;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 2rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-transform: uppercase;
        }
        .btn-plan:hover {
            background-color: #d1a133;
            color: white;
        }

        /* Properties Cards */
        .property-card {
            box-shadow: 0 0 12px rgb(0 0 0 / 0.1);
            border-radius: 8px;
            overflow: hidden;
            transition: transform 0.3s ease;
            background: white;
        }
        .property-card:hover {
            transform: translateY(-8px);
        }
        .property-img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }
        .property-info {
            padding: 1rem;
        }
        .property-title {
            font-weight: 600;
            font-size: 1.1rem;
        }
        .property-price {
            font-size: 0.9rem;
            color: #666;
        }

        /* Responsive tweaks */
        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 2.5rem;
            }
            .hero-subtitle {
                font-size: 1.1rem;
            }
        }
    </style>
</head>
<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top px-4">
        <a class="navbar-brand" href="#">UNITRA</a>
        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarMenu"
            aria-controls="navbarMenu"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav ms-auto gap-3">
                <li class="nav-item">
                    <a class="nav-link" href="#">BECOME A HOST</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('rooms.index') }}">BECOME A RENTER</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">SIGN UP</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>UNITRA<br />YOUR TRUSTED UNIT<br />MANAGEMENT SITE.</h1>
            <p class="hero-subtitle mt-3">Manage your properties with confidence and ease</p>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="container my-5">
        <h2 class="section-title">We Satisfy people wants</h2>
        <div class="row g-4 justify-content-center">
            <div class="col-md-4">
                <div class="testimonial-card">
                    <img src="https://images.unsplash.com/photo-1524504388940-b1c1722653e1?auto=format&fit=crop&w=100&q=80" alt="User 1" />
                    <p class="testimonial-text">
                        “Unitra gives me peace of mind. I’m confident my tenant payments are accurate and timely.”
                    </p>
                    <p class="testimonial-author">– Mark H.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="testimonial-card">
                    <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=100&q=80" alt="User 2" />
                    <p class="testimonial-text">
                        “Working through Unitra has streamlined our tenant management. Highly recommended!”
                    </p>
                    <p class="testimonial-author">– Daniel R.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="testimonial-card">
                    <img src="https://images.unsplash.com/photo-1508214751196-bcfd4ca60f91?auto=format&fit=crop&w=100&q=80" alt="User 3" />
                    <p class="testimonial-text">
                        “Great experience! Unitra simplifies almost everything about my rental properties.”
                    </p>
                    <p class="testimonial-author">– Amanda L.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Plans Section -->
    <section class="container my-5">
        <h2 class="section-title">CHOOSE YOUR DESIRED PLAN</h2>
        <div class="row g-4 justify-content-center">
            <div class="col-md-3">
                <div class="plan-card">
                    <div>
                        <h3 class="plan-title">BASIC PLAN</h3>
                        <p class="plan-price">$100 <small> / month</small></p>
                        <ul class="plan-features">
                            <li>✔ Up to 5 Properties</li>
                            <li>✔ 10 Users Access</li>
                            <li>✔ Basic Support</li>
                            <li>✔ Secure Payments</li>
                            <li>✔ Mobile Access</li>
                        </ul>
                    </div>
                    <button class="btn-plan">Check plans</button>
                </div>
            </div>
            <div class="col-md-3">
                <div class="plan-card">
                    <div>
                        <h3 class="plan-title">BUSINESS PLAN</h3>
                        <p class="plan-price">$350 <small> / month</small></p>
                        <ul class="plan-features">
                            <li>✔ Up to 20 Properties</li>
                            <li>✔ 50 Users Access</li>
                            <li>✔ Priority Support</li>
                            <li>✔ Secure Payments</li>
                            <li>✔ Mobile & Desktop Access</li>
                            <li>✔ Custom Reports</li>
                        </ul>
                    </div>
                    <button class="btn-plan">Check plans</button>
                </div>
            </div>
            <div class="col-md-3">
                <div class="plan-card">
                    <div>
                        <h3 class="plan-title">ENTERPRISE PLAN</h3>
                        <p class="plan-price">$700 <small> / month</small></p>
                        <ul class="plan-features">
                            <li>✔ Unlimited Properties</li>
                            <li>✔ Unlimited Users Access</li>
                            <li>✔ 24/7 Support</li>
                            <li>✔ Secure Payments</li>
                            <li>✔ Mobile/Desktop Access</li>
                            <li>✔ Custom Reports</li>
                            <li>✔ Dedicated Manager</li>
                        </ul>
                    </div>
                    <button class="btn-plan">Show plans</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Property Listings Section -->
    <section class="container mb-5">
        <h2 class="section-title">Check some of stunning properties</h2>
        <div class="row g-4 justify-content-center">
            <div class="col-md-3">
                <div class="property-card">
                    <img class="property-img" src="https://images.unsplash.com/photo-1560448070-972f49f5e12e?auto=format&fit=crop&w=400&q=80" alt="Hotel Hotel" />
                    <div class="property-info">
                        <p class="property-title">Hotel Hotel</p>
                        <p class="property-price">PKR 3000 per night</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="property-card">
                    <img class="property-img" src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=400&q=80" alt="Hotel Hotel" />
                    <div class="property-info">
                        <p class="property-title">Hotel Hotel</p>
                        <p class="property-price">PKR 3000 per night</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="property-card">
                    <img class="property-img" src="https://images.unsplash.com/photo-1572120360610-d971b9b2fd19?auto=format&fit=crop&w=400&q=80" alt="Hotel Hotel" />
                    <div class="property-info">
                        <p class="property-title">Hotel Hotel</p>
                        <p class="property-price">PKR 3000 per night</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
