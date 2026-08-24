<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/landing.css') }}">
    <title>FixDesk</title>

    @vite([
        'resources/css/app.css', 
        'resources/js/app.js'
    ])
</head>
<body>
    <x-header
        title="FixDesk"
        subtitle="Internal IT Support Portal"
        logo="{{ asset('assets/images/it.png') }}"
        background="rgba(9, 22, 40, 0.3)"
        textColor="#ffffff"
    >
        <a href="#home" class="nav-link">Home</a>
        <a href="#services" class="nav-link">Services</a>
        <a href="#features" class="nav-link">Features</a>
        <a href="#how-it-works" class="nav-link">How it works</a>
        <a href="#track-ticket" class="nav-link">Track Ticket</a>
    </x-header>

    <main class="landing-page">
        
        <section id="home" class="hero-section">
            <div class="hero-badge">INTERNAL IT SUPPORT PORTAL</div>
            <h1>GET IT SUPPORT WITHOUT HASSLE</h1>
            <p>
                Report technical issues, track your support requests, and communicate with
                the IT team all in one centralized portal.
            </p>

            <div class="cta-row">
                <button type="button" class="cta-button secondary">
                    Submit a ticket
                    <i class="ti ti-send-2"></i>
                </button>
                <a href="{{ route('login') }}" class="cta-button">
                    Login
                    <i class="ti ti-shield-lock"></i>
                </a>
            </div>

            <div class="feature-list">
                <span class="feature-item">
                    <i class="ti ti-circle-check"></i>
                    <span>Fast issue Reporting</span>
                </span>

                <span class="feature-item">
                    <i class="ti ti-circle-check"></i>
                    <span>Real-Time Ticket Tracking</span>
                </span>

                <span class="feature-item">
                    <i class="ti ti-circle-check"></i>
                    <span>Organized Support History</span>
                </span>
            </div>
        </section>

    </main>
    
    <section id="services" class="services-section">
        <div class="animated-divider"></div>
        <div class="mx-auto max-w-6xl">
            <h2 class="feature-title text-center">Our Services</h2>
            <p class="text-center text-sm font-light opacity-75 leading-relaxed max-w-2xl mx-auto">
                Comprehensive IT support solutions tailored to your needs.
            </p>

            <div class="services-cards mt-12 grid grid-cols-2 md:grid-cols-2 gap-6">

                <div class="service-card">
                    <div class="service-icon">
                        <i class="ti ti-devices-2"></i>
                    </div>
                    <h3>Hardware Support</h3>
                    <p>Troubleshoot and resolve hardware issues, including desktop computers, laptops, printers, and peripherals.</p>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <i class="ti ti-apps"></i>
                    </div>
                    <h3>Software Support</h3>
                    <p>Get assistance with software installation, updates, compatibility issues, and application troubleshooting.</p>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <i class="ti ti-network"></i>
                    </div>
                    <h3>Network Support</h3>
                    <p>Resolve connectivity issues, network configuration, and ensure stable internet access.</p>
                </div>

            </div>
        </div>
    </section>

    
    <section id="features" class="features-section">

        <div class="animated-divider"></div>

        <div class="mx-auto max-w-6xl">
            <h2 class="feature-title text-center">Core Features</h2>

            <p class="text-center text-sm font-light opacity-75 leading-relaxed max-w-2xl mx-auto">
                Give employees an easy way to request help while giving IT staff the tools
                to manage every support issue efficiently.
            </p>

            <div class="feature-cards mt-10 grid grid-cols-2 gap-6">

                <x-feature_card
                    title="Easy Ticketing"
                    description="Employees can report IT problems by providing
                                the issue, category, and supporting details."
                    icon="ti ti-ticket"
                />

                <x-feature_card
                    title="IT Support Management"
                    description="IT staff can review, assign, update, and
                                resolve employee support tickets."
                    icon="ti ti-headset"
                />

                <x-feature_card
                    title="Ticket Tracking"
                    description="Employees can monitor their ticket status from
                                Open → In progress → Resolved → Closed."
                    icon="ti ti-git-merge"
                />

                <x-feature_card
                    title="Reports & Ticket History"
                    description="Keep a complete history of support requests and
                                generate reports on ticket volume, issue types,
                                and resolution performance."
                    icon="ti ti-history-toggle"
                />

            </div>
        </div>

        
    </section>

    <section id="how-it-works" class="how-it-works-section">

        <div class="animated-divider"></div>

        <h2 class="feature-title text-center font-light mx-auto">
             How it works?
        </h2>
        <p class="text-center text-sm font-light opacity-75 leading-relaxed max-w-2xl mx-auto">
            SIMPLE SUPPORT PROCESS.
        </p>

        <div class="timeline-container mt-12">
            <div class="timeline-step step-1">
                <div class="timeline-icon">
                    <i class="ti ti-send"></i>
                </div>
                <div class="timeline-content">
                    <h3>Submit a Ticket</h3>
                    <p class="font-bold text-white">Tell us what's wrong.</p>
                    <p class="text-xs">Describe your IT problem, select the appropriate category and priority, and provide any necessary details or attachments.</p>
                </div>
            </div>

            <div class="timeline-step step-2">
                <div class="timeline-icon">
                    <i class="ti ti-analyze"></i>
                </div>
                <div class="timeline-content">
                    <h3>IT Reviews Your Request</h3>
                    <p class="font-bold text-white">Your request gets to the right people.</p>
                    <p class="text-xs">The IT support team reviews your ticket, checks the issue details, and assigns it for proper handling.</p>
                </div>
            </div>

            <div class="timeline-step step-3">
                <div class="timeline-icon">
                    <i class="ti ti-device-imac-cog"></i>
                </div>
                <div class="timeline-content">
                    <h3>Issue Gets Resolved</h3>
                    <p class="font-bold text-white">Get the technical help you need.</p>
                    <p class="text-xs">IT staff investigates the problem, and updates the ticket as the issue is being resolved.</p>
                </div>
            </div>

            <div class="timeline-step step-4">
                <div class="timeline-icon">
                    <i class="ti ti-device-ipad-horizontal-check"></i>
                </div>
                <div class="timeline-content">
                    <h3>Confirm & Close</h3>
                    <p class="font-bold text-white">Keep the record complete.</p>
                    <p class="text-xs">Once the issue is resolved, the ticket is closed and it's details remain available in admin support history.</p>
                </div>
            </div>
        </div>

    
    </section>

    <div class="animated-divider"></div>

    <section id="track-ticket" class="track-ticket-section">


        <h2 class="track-title text-center font-light mx-auto">
             Track Your Ticket
        </h2>
        <p class="text-center text-sm font-light opacity-75 leading-relaxed max-w-2xl mx-auto">
            Check the latest status and updates of your ticket.
        </p>

        <div class="mt-10 flex w-full max-w-xl items-center justify-center">
            <x-input
                name="email"
                type="text"
                label="Enter ticket number"
                placeholder="Enter ticket number"
                leftIcon="ti ti-ticket"
                backgroundColor="#071F45"
                strokeColor="#475569"
                focusColor="#00DDFF"
                iconColor="#64748b"
                class="flex-1"
            />

            <button type="button" class="track-btn">
                <span>Track</span>
                <i class="ti ti-search"></i>
            </button>
        </div>

    </section>

    <div class="animated-divider"></div>
    
    <p class="text-center mx-auto font-sm p-5">© 2026 Help Desk — Internal IT Support. All Rights Reserved</p>

    <script>
        const navLinks = document.querySelectorAll('.nav-link');
        const sections = document.querySelectorAll('section[id]');
        const headerButtons = document.querySelector('.header-buttons');

        let lastSection = null;

        /*
        |--------------------------------------------------------------------------
        | Smooth Scroll
        |--------------------------------------------------------------------------
        */

        navLinks.forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();

                const targetId = this.getAttribute('href').substring(1);
                const targetSection = document.getElementById(targetId);

                if (!targetSection) return;

                const headerOffset = 80;

                const targetPosition =
                    targetSection.getBoundingClientRect().top +
                    window.scrollY -
                    headerOffset;

                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            });
        });


        /*
        |--------------------------------------------------------------------------
        | Active Navigation
        |--------------------------------------------------------------------------
        */

        function updateActiveNavLink() {

            const scrollPosition = window.scrollY + 120;

            let currentSection = null;

            /*
            |--------------------------------------------------------------------------
            | Detect Current Section
            |--------------------------------------------------------------------------
            */

            sections.forEach(section => {

                const sectionTop = section.offsetTop;
                const sectionBottom = sectionTop + section.offsetHeight;

                if (
                    scrollPosition >= sectionTop &&
                    scrollPosition < sectionBottom
                ) {
                    currentSection = section;
                }

            });


            /*
            |--------------------------------------------------------------------------
            | Keep Last Section While Crossing Dividers
            |--------------------------------------------------------------------------
            |
            | Dividers live between sections, so the scroll position can fall
            | inside none of them. Reuse the last known section so the header
            | buttons don't flicker off while scrolling past a divider.
            |
            */

            if (!currentSection) {
                currentSection = lastSection;
            }


            /*
            |--------------------------------------------------------------------------
            | Detect Track Ticket at Bottom
            |--------------------------------------------------------------------------
            |
            | This makes sure Track Ticket becomes active when the user
            | reaches the bottom of the page.
            |
            */

            const scrollBottom =
                window.scrollY + window.innerHeight;

            const documentBottom =
                document.documentElement.scrollHeight;

            if (scrollBottom >= documentBottom - 10) {

                currentSection =
                    document.getElementById('track-ticket');

            }

            lastSection = currentSection;


            /*
            |--------------------------------------------------------------------------
            | Update Active Navigation
            |--------------------------------------------------------------------------
            */

            navLinks.forEach(link => {

                link.classList.remove('active');

                if (
                    currentSection &&
                    link.getAttribute('href') === `#${currentSection.id}`
                ) {
                    link.classList.add('active');
                }

            });


            /*
            |--------------------------------------------------------------------------
            | Show / Hide Header Buttons
            |--------------------------------------------------------------------------
            |
            | Home     = hidden
            | Others   = visible
            |
            */

            if (headerButtons) {

                if (
                    currentSection &&
                    currentSection.id !== 'home'
                ) {

                    headerButtons.style.display = 'flex';

                } else {

                    headerButtons.style.display = 'none';

                }

            }

        }


        /*
        |--------------------------------------------------------------------------
        | Scroll Event
        |--------------------------------------------------------------------------
        */

        window.addEventListener(
            'scroll',
            updateActiveNavLink,
            { passive: true }
        );


        /*
        |--------------------------------------------------------------------------
        | Initial State
        |--------------------------------------------------------------------------
        */

        updateActiveNavLink();
    </script>
</body>
</html>