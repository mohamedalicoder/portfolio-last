@php
    $locale = app()->getLocale();
    $isRtl = $locale === 'ar';
@endphp
<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $isRtl ? 'rtl' : 'ltr' }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Mohamed Ali — {{ __('portfolio.hero_badge') }}. {{ __('portfolio.hero_title') }}">

    <title>Mohamed Ali — {{ __('portfolio.hero_badge') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800|montserrat:600,700,800" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <style>
        /* Hero video: works even when Tailwind CSS is not loaded */
        #hero .hero-video-wrap {
            position: absolute;
            inset: 0;
            z-index: 0;
            overflow: hidden;
            pointer-events: none;
        }
        #hero .hero-video-el {
            position: absolute;
            top: 50%;
            left: 50%;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            transform: translate(-50%, -50%);
            object-fit: cover;
            opacity: 0.65;
        }
        #hero .hero-video-scrim {
            position: absolute;
            inset: 0;
            z-index: 1;
            pointer-events: none;
            background: linear-gradient(
                to bottom,
                rgba(15, 15, 15, 0.72) 0%,
                rgba(15, 15, 15, 0.82) 45%,
                rgba(10, 10, 10, 0.92) 100%
            );
        }
        #hero .hero-glow {
            position: absolute;
            z-index: 2;
            pointer-events: none;
            top: 5rem;
            right: 0;
            width: 16rem;
            height: 16rem;
            border-radius: 9999px;
            background: rgba(59, 130, 246, 0.12);
            filter: blur(48px);
        }
        @media (min-width: 640px) {
            #hero .hero-glow { width: 24rem; height: 24rem; filter: blur(64px); }
        }
        #hero .hero-inner {
            position: relative;
            z-index: 3;
        }
        @media (prefers-reduced-motion: reduce) {
            #hero .hero-video-el { opacity: 0.25; }
        }
    </style>
</head>

<body class="bg-charcoal text-zinc-200 font-sans antialiased min-h-screen overflow-x-hidden">
    <div class="min-h-screen flex flex-col overflow-x-hidden">
        {{-- Navigation --}}
        <header class="fixed top-0 left-0 right-0 z-50 border-b border-zinc-800/80 bg-charcoal/90 backdrop-blur-md">
            <nav
                class="container mx-auto px-4 sm:px-6 lg:px-8 h-14 sm:h-16 flex items-center justify-between gap-4 safe-area-pad">
                <a href="#hero" class="font-heading font-bold text-lg text-white tracking-tight shrink-0">MA</a>

                {{-- Desktop nav --}}
                <div class="hidden md:flex items-center gap-4 lg:gap-6 text-sm">
                    <a href="#projects"
                        class="text-zinc-400 hover:text-accent transition-colors">{{ __('portfolio.nav_projects') }}</a>
                    <a href="#skills"
                        class="text-zinc-400 hover:text-accent transition-colors">{{ __('portfolio.nav_skills') }}</a>
                    <a href="#why-hire"
                        class="text-zinc-400 hover:text-accent transition-colors">{{ __('portfolio.nav_why_hire') }}</a>
                    <a href="#contact"
                        class="text-accent font-medium hover:underline underline-offset-4">{{ __('portfolio.nav_contact') }}</a>
                    <div class="flex items-center gap-1 border border-zinc-600 rounded-lg p-0.5">
                        <a href="{{ route('locale.switch', 'en') }}"
                            class="px-2.5 py-1 rounded-md text-xs font-medium {{ $locale === 'en' ? 'bg-accent text-charcoal' : 'text-zinc-400 hover:text-white' }} transition-colors">EN</a>
                        <a href="{{ route('locale.switch', 'ar') }}"
                            class="px-2.5 py-1 rounded-md text-xs font-medium {{ $locale === 'ar' ? 'bg-accent text-charcoal' : 'text-zinc-400 hover:text-white' }} transition-colors">العربية</a>
                    </div>
                </div>

                {{-- Mobile: hamburger + overlay menu --}}
                <input type="checkbox" id="nav-toggle" class="peer sr-only">
                <label for="nav-toggle"
                    class="nav-hamburger md:hidden flex flex-col justify-center w-10 h-10 rounded-lg border border-zinc-600 text-zinc-400 hover:text-white cursor-pointer touch-manipulation shrink-0"
                    aria-label="{{ $locale === 'ar' ? 'القائمة' : 'Menu' }}">
                    <span
                        class="nav-hamburger-line block w-5 h-0.5 bg-current rounded mb-1.5 transition-transform origin-center"></span>
                    <span
                        class="nav-hamburger-line block w-5 h-0.5 bg-current rounded mb-1.5 transition-opacity"></span>
                    <span
                        class="nav-hamburger-line block w-5 h-0.5 bg-current rounded transition-transform origin-center"></span>
                </label>
                <div
                    class="fixed inset-0 top-14 sm:top-16 z-40 bg-charcoal border-t border-zinc-800 md:hidden opacity-0 invisible pointer-events-none peer-checked:opacity-100 peer-checked:visible peer-checked:pointer-events-auto transition-all duration-200 overflow-y-auto">
                    <div class="flex flex-col gap-1 p-4 pt-6 max-w-sm">
                        <p class="text-zinc-500 text-xs uppercase tracking-wider px-4 mb-1">
                            {{ $locale === 'ar' ? 'القائمة' : 'Menu' }}</p>
                        <a href="#projects"
                            class="py-3 px-4 rounded-lg text-zinc-300 hover:bg-zinc-800 hover:text-white text-base"
                            onclick="document.getElementById('nav-toggle').checked = false">{{ __('portfolio.nav_projects') }}</a>
                        <a href="#skills"
                            class="py-3 px-4 rounded-lg text-zinc-300 hover:bg-zinc-800 hover:text-white text-base"
                            onclick="document.getElementById('nav-toggle').checked = false">{{ __('portfolio.nav_skills') }}</a>
                        <a href="#why-hire"
                            class="py-3 px-4 rounded-lg text-zinc-300 hover:bg-zinc-800 hover:text-white text-base"
                            onclick="document.getElementById('nav-toggle').checked = false">{{ __('portfolio.nav_why_hire') }}</a>
                        <a href="#contact" class="py-3 px-4 rounded-lg text-accent font-medium text-base"
                            onclick="document.getElementById('nav-toggle').checked = false">{{ __('portfolio.nav_contact') }}</a>
                        <div class="flex items-center gap-2 mt-6 pt-4 border-t border-zinc-700">
                            <span class="text-zinc-500 text-sm">{{ $locale === 'ar' ? 'اللغة' : 'Language' }}</span>
                            <a href="{{ route('locale.switch', 'en') }}"
                                class="px-3 py-2 rounded-lg text-sm font-medium {{ $locale === 'en' ? 'bg-accent text-charcoal' : 'text-zinc-400 bg-zinc-800' }}">EN</a>
                            <a href="{{ route('locale.switch', 'ar') }}"
                                class="px-3 py-2 rounded-lg text-sm font-medium {{ $locale === 'ar' ? 'bg-accent text-charcoal' : 'text-zinc-400 bg-zinc-800' }}">العربية</a>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <main class="flex-1 pt-14 sm:pt-16">
            {{-- Hero Section --}}
            <section id="hero" class="relative overflow-hidden py-12 sm:py-20 lg:py-28 xl:py-36">
                <div class="hero-video-wrap" aria-hidden="true">
                    <video id="hero-video" class="hero-video-el" autoplay muted loop playsinline preload="auto"
                        aria-hidden="true" tabindex="-1">
                        <source src="{{ url('assets/esso-video.mp4') }}" type="video/mp4">
                        <track kind="captions" src="{{ url('assets/esso-video.vtt') }}" srclang="en" label="English" default>
                    </video>
                </div>
                <div class="hero-video-scrim" aria-hidden="true"></div>
                <div class="hero-glow" aria-hidden="true"></div>
                <div class="hero-inner container mx-auto px-4 sm:px-6 lg:px-8 max-w-5xl w-full box-border">
                    <p class="text-accent font-semibold text-xs sm:text-sm uppercase tracking-widest mb-3 sm:mb-4">
                        {{ __('portfolio.hero_badge') }}</p>
                    <h1
                        class="font-heading font-bold text-2xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl text-white leading-tight tracking-tight max-w-4xl break-words">
                        {{ __('portfolio.hero_title') }}
                    </h1>
                    <p class="mt-4 sm:mt-6 text-base sm:text-lg lg:text-xl text-zinc-400 max-w-2xl leading-relaxed">
                        {{ __('portfolio.hero_subtitle') }}
                    </p>
                    <div class="mt-8 sm:mt-10 flex flex-col sm:flex-row flex-wrap gap-3 sm:gap-4">
                        <a href="#contact"
                            class="inline-flex items-center justify-center gap-2 min-h-[44px] px-5 sm:px-6 py-3 bg-accent text-charcoal font-semibold rounded-lg hover:bg-accent-hover transition-colors touch-manipulation w-full sm:w-auto">
                            {{ __('portfolio.cta_primary') }}
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </a>
                        <a href="#contact"
                            class="inline-flex items-center justify-center gap-2 min-h-[44px] px-5 sm:px-6 py-3 border border-zinc-600 text-zinc-300 font-medium rounded-lg hover:border-accent hover:text-accent transition-colors touch-manipulation w-full sm:w-auto">
                            {{ __('portfolio.cta_secondary') }}
                        </a>
                    </div>
                </div>
                <script>
                    (function () {
                        var v = document.getElementById('hero-video');
                        if (!v) return;
                        v.muted = true;
                        v.setAttribute('muted', '');
                        v.play().catch(function () {
                            document.addEventListener('click', function once() {
                                v.play().catch(function () {});
                                document.removeEventListener('click', once);
                            }, { once: true });
                        });
                    })();
                </script>
            </section>

            {{-- Featured Projects (Bento Grid) --}}
            <section id="projects" class="py-12 sm:py-20 lg:py-28 border-t border-zinc-800/50">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-6xl w-full box-border">
                    <h2 class="font-heading font-bold text-2xl sm:text-3xl lg:text-4xl text-white mb-2">
                        {{ __('portfolio.projects_title') }}</h2>
                    <p class="text-zinc-400 text-base sm:text-lg max-w-2xl mb-8 sm:mb-12">
                        {{ __('portfolio.projects_subtitle') }}</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                        {{-- ASSAB - spans 2 cols on lg --}}
                        <article
                            class="lg:col-span-2 rounded-xl sm:rounded-2xl border border-zinc-800 bg-zinc-900/50 p-4 sm:p-6 lg:p-8 hover:border-accent/50 transition-colors group min-w-0">
                            <div class="flex flex-wrap items-start justify-between gap-2 sm:gap-4 mb-3 sm:mb-4">
                                <h3
                                    class="font-heading font-bold text-lg sm:text-xl lg:text-2xl text-white group-hover:text-accent transition-colors break-words min-w-0">
                                    ASSAB</h3>
                                <span
                                    class="text-xs font-medium text-accent bg-accent/10 px-2.5 py-1 rounded-full shrink-0">{{ __('portfolio.assab_badge') }}</span>
                            </div>
                            <p class="text-zinc-400 text-sm sm:text-base leading-relaxed mb-2 break-words">
                                {{ __('portfolio.assab_desc') }}
                            </p>
                            <p class="text-zinc-300 text-sm font-medium mb-4 sm:mb-5">{{ __('portfolio.assab_vat') }}
                            </p>
                            <ul class="flex flex-wrap gap-2 mb-4 sm:mb-5">
                                <li class="text-xs text-zinc-500 bg-zinc-800/80 px-2.5 py-1 rounded-md">Laravel</li>
                                <li class="text-xs text-zinc-500 bg-zinc-800/80 px-2.5 py-1 rounded-md">Multi-role</li>
                                <li class="text-xs text-zinc-500 bg-zinc-800/80 px-2.5 py-1 rounded-md">AI Forecasting
                                </li>
                                <li class="text-xs text-zinc-500 bg-zinc-800/80 px-2.5 py-1 rounded-md">VAT</li>
                                <li class="text-xs text-zinc-500 bg-zinc-800/80 px-2.5 py-1 rounded-md">Supply Chain
                                </li>
                            </ul>
                            <a href="#" target="_blank" rel="noopener noreferrer"
                                class="inline-flex items-center justify-center gap-2 min-h-[44px] px-4 py-3 rounded-lg bg-accent text-charcoal font-semibold text-sm hover:bg-accent-hover transition-colors touch-manipulation">
                                <span>{{ __('portfolio.visit_project') }}</span>
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                            </a>
                        </article>

                        {{-- Saudi Real Estate ERP --}}
                        <article
                            class="rounded-xl sm:rounded-2xl border border-zinc-800 bg-zinc-900/50 p-4 sm:p-6 lg:p-8 hover:border-accent/50 transition-colors group min-w-0">
                            <div class="flex flex-wrap items-start justify-between gap-2 sm:gap-4 mb-3 sm:mb-4">
                                <h3
                                    class="font-heading font-bold text-lg sm:text-xl lg:text-2xl text-white group-hover:text-accent transition-colors break-words min-w-0">
                                    Saudi Real Estate ERP</h3>
                            </div>
                            <p class="text-zinc-400 text-sm sm:text-base leading-relaxed mb-4 sm:mb-5 break-words">
                                {{ __('portfolio.saudi_desc') }}
                            </p>
                            <ul class="flex flex-wrap gap-2 mb-5">
                                <li class="text-xs text-zinc-500 bg-zinc-800/80 px-2.5 py-1 rounded-md">Laravel</li>
                                <li class="text-xs text-zinc-500 bg-zinc-800/80 px-2.5 py-1 rounded-md">KSA</li>
                                <li class="text-xs text-zinc-500 bg-zinc-800/80 px-2.5 py-1 rounded-md">Contracts</li>
                            </ul>
                            <a href="https://teal-camel-501086.hostingersite.com/" target="_blank"
                                rel="noopener noreferrer"
                                class="inline-flex items-center justify-center gap-2 min-h-[44px] px-4 py-3 rounded-lg bg-accent text-charcoal font-semibold text-sm hover:bg-accent-hover transition-colors touch-manipulation">
                                <span>{{ __('portfolio.visit_project') }}</span>
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                            </a>
                        </article>

                        {{-- Sporty Mate --}}
                        <article
                            class="rounded-xl sm:rounded-2xl border border-zinc-800 bg-zinc-900/50 p-4 sm:p-6 lg:p-8 hover:border-accent/50 transition-colors group min-w-0">
                            <div class="flex flex-wrap items-start justify-between gap-2 sm:gap-4 mb-3 sm:mb-4">
                                <h3
                                    class="font-heading font-bold text-lg sm:text-xl lg:text-2xl text-white group-hover:text-accent transition-colors break-words min-w-0">
                                    Sporty Mate</h3>
                                <span
                                    class="text-xs font-medium text-emerald-400 bg-emerald-500/10 px-2.5 py-1 rounded-full shrink-0">{{ __('portfolio.sporty_badge') }}</span>
                            </div>
                            <p class="text-zinc-400 text-sm sm:text-base leading-relaxed mb-4 sm:mb-5 break-words">
                                {{ __('portfolio.sporty_desc') }}
                            </p>
                            <ul class="flex flex-wrap gap-2 mb-5">
                                <li class="text-xs text-zinc-500 bg-zinc-800/80 px-2.5 py-1 rounded-md">Marketplace
                                </li>
                                <li class="text-xs text-zinc-500 bg-zinc-800/80 px-2.5 py-1 rounded-md">Bookings</li>
                                <li class="text-xs text-zinc-500 bg-zinc-800/80 px-2.5 py-1 rounded-md">Payments</li>
                            </ul>
                            <a href="https://seagreen-stork-442565.hostingersite.com/" target="_blank"
                                rel="noopener noreferrer"
                                class="inline-flex items-center justify-center gap-2 min-h-[44px] px-4 py-3 rounded-lg bg-accent text-charcoal font-semibold text-sm hover:bg-accent-hover transition-colors touch-manipulation">
                                <span>{{ __('portfolio.visit_project') }}</span>
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                            </a>
                        </article>

                        {{-- Al-Baraka & Al-Zukhruf - spans 2 cols on lg --}}
                        <article
                            class="lg:col-span-2 rounded-xl sm:rounded-2xl border border-zinc-800 bg-zinc-900/50 p-4 sm:p-6 lg:p-8 hover:border-accent/50 transition-colors group min-w-0">
                            <div class="flex flex-wrap items-start justify-between gap-2 sm:gap-4 mb-3 sm:mb-4">
                                <h3
                                    class="font-heading font-bold text-lg sm:text-xl lg:text-2xl text-white group-hover:text-accent transition-colors break-words min-w-0">
                                    Al-Baraka & Al-Zukhruf</h3>
                            </div>
                            <div
                                class="space-y-3 sm:space-y-4 text-zinc-400 text-sm sm:text-base leading-relaxed break-words">
                                <p>
                                    <strong class="text-zinc-300">{{ __('portfolio.albaraka_label') }}</strong>
                                    {{ __('portfolio.albaraka_desc') }}
                                </p>
                                <p>
                                    <strong class="text-zinc-300">{{ __('portfolio.alzukhruf_label') }}</strong>
                                    {{ __('portfolio.alzukhruf_desc') }}
                                </p>
                            </div>
                            <ul class="flex flex-wrap gap-2 mt-5 mb-5">
                                <li class="text-xs text-zinc-500 bg-zinc-800/80 px-2.5 py-1 rounded-md">E-commerce</li>
                                <li class="text-xs text-zinc-500 bg-zinc-800/80 px-2.5 py-1 rounded-md">Warehouse</li>
                                <li class="text-xs text-zinc-500 bg-zinc-800/80 px-2.5 py-1 rounded-md">Document Mgmt
                                </li>
                            </ul>
                            <a href="https://lightgoldenrodyellow-hummingbird-955282.hostingersite.com/"
                                target="_blank" rel="noopener noreferrer"
                                class="inline-flex items-center justify-center gap-2 min-h-[44px] px-4 py-3 rounded-lg bg-accent text-charcoal font-semibold text-sm hover:bg-accent-hover transition-colors touch-manipulation">
                                <span>{{ __('portfolio.visit_project') }}</span>
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                            </a>
                        </article>

                        {{-- HAYAI --}}
                        <article
                            class="rounded-xl sm:rounded-2xl border border-zinc-800 bg-zinc-900/50 p-4 sm:p-6 lg:p-8 hover:border-accent/50 transition-colors group min-w-0">
                            <div class="flex flex-wrap items-start justify-between gap-2 sm:gap-4 mb-3 sm:mb-4">
                                <h3
                                    class="font-heading font-bold text-lg sm:text-xl lg:text-2xl text-white group-hover:text-accent transition-colors break-words min-w-0">
                                    HAYAI</h3>
                                <span
                                    class="text-xs font-medium text-accent bg-accent/10 px-2.5 py-1 rounded-full shrink-0">{{ __('portfolio.hayai_badge') }}</span>
                            </div>
                            <p class="text-zinc-400 text-sm sm:text-base leading-relaxed mb-2 break-words">
                                {{ __('portfolio.hayai_desc') }}
                            </p>
                            <p class="text-zinc-300 text-sm font-medium mb-5">{{ __('portfolio.hayai_tech') }}</p>
                            <ul class="flex flex-wrap gap-2 mb-5">
                                <li class="text-xs text-zinc-500 bg-zinc-800/80 px-2.5 py-1 rounded-md">HealthKit</li>
                                <li class="text-xs text-zinc-500 bg-zinc-800/80 px-2.5 py-1 rounded-md">Google Fit</li>
                                <li class="text-xs text-zinc-500 bg-zinc-800/80 px-2.5 py-1 rounded-md">Multi-role</li>
                                <li class="text-xs text-zinc-500 bg-zinc-800/80 px-2.5 py-1 rounded-md">Emergency</li>
                            </ul>
                            <a href="https://azzukhruff.com/" target="_blank" rel="noopener noreferrer"
                                class="inline-flex items-center justify-center gap-2 min-h-[44px] px-4 py-3 rounded-lg bg-accent text-charcoal font-semibold text-sm hover:bg-accent-hover transition-colors touch-manipulation">
                                <span>{{ __('portfolio.visit_project') }}</span>
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                            </a>
                        </article>
                    </div>
                </div>
            </section>

            {{-- Technical Skill Matrix --}}
            <section id="skills" class="py-12 sm:py-20 lg:py-28 border-t border-zinc-800/50">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-6xl w-full box-border">
                    <h2 class="font-heading font-bold text-2xl sm:text-3xl lg:text-4xl text-white mb-2">
                        {{ __('portfolio.skills_title') }}</h2>
                    <p class="text-zinc-400 text-base sm:text-lg max-w-2xl mb-8 sm:mb-12">
                        {{ __('portfolio.skills_subtitle') }}</p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 sm:gap-6">
                        <div class="rounded-xl sm:rounded-2xl border border-zinc-800 bg-zinc-900/50 p-4 sm:p-6 lg:p-8">
                            <h3 class="font-heading font-bold text-accent text-lg mb-4">
                                {{ __('portfolio.skills_backend') }}</h3>
                            <ul class="space-y-2 text-zinc-400">
                                <li>Laravel</li>
                                <li>PHP</li>
                                <li>MySQL</li>
                                <li>PostgreSQL</li>
                            </ul>
                        </div>
                        <div class="rounded-xl sm:rounded-2xl border border-zinc-800 bg-zinc-900/50 p-4 sm:p-6 lg:p-8">
                            <h3 class="font-heading font-bold text-accent text-lg mb-4">
                                {{ __('portfolio.skills_architecture') }}</h3>
                            <ul class="space-y-2 text-zinc-400">
                                <li>Microservices</li>
                                <li>ERP Logic</li>
                                <li>Multi-tenancy</li>
                            </ul>
                        </div>
                        <div class="rounded-xl sm:rounded-2xl border border-zinc-800 bg-zinc-900/50 p-4 sm:p-6 lg:p-8">
                            <h3 class="font-heading font-bold text-accent text-lg mb-4">
                                {{ __('portfolio.skills_tools') }}</h3>
                            <ul class="space-y-2 text-zinc-400">
                                <li>Cursor</li>
                                <li>Lovable</li>
                                <li>TDD</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Why Hire Me --}}
            <section id="why-hire" class="py-12 sm:py-20 lg:py-28 border-t border-zinc-800/50">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-4xl w-full box-border">
                    <h2 class="font-heading font-bold text-2xl sm:text-3xl lg:text-4xl text-white mb-4 sm:mb-6">
                        {{ __('portfolio.why_hire_title') }}</h2>
                    <blockquote
                        class="text-lg sm:text-xl lg:text-2xl text-zinc-300 leading-relaxed {{ $isRtl ? 'border-r-4 pr-4 sm:pr-6 lg:pr-8' : 'border-l-4 pl-4 sm:pl-6 lg:pl-8' }} border-accent break-words">
                        {{ __('portfolio.why_hire_quote') }}
                    </blockquote>
                </div>
            </section>

            {{-- Contact --}}
            <section id="contact" class="py-12 sm:py-20 lg:py-28 border-t border-zinc-800/50">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-2xl w-full box-border">
                    <h2 class="font-heading font-bold text-2xl sm:text-3xl lg:text-4xl text-white mb-2">
                        {{ __('portfolio.contact_title') }}</h2>
                    <p class="text-zinc-400 text-base sm:text-lg mb-8 sm:mb-10">{{ __('portfolio.contact_subtitle') }}
                    </p>

                    <div class="flex flex-wrap gap-3 sm:gap-4 mb-8 sm:mb-10">
                        <a href="https://www.linkedin.com/in/mohamedaalli/" target="_blank" rel="noopener noreferrer"
                            class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg border border-zinc-600 text-zinc-300 hover:border-accent hover:text-accent transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                            </svg>
                            LinkedIn
                        </a>
                        <a href="https://github.com/mohamedalicoder" target="_blank" rel="noopener noreferrer"
                            class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg border border-zinc-600 text-zinc-300 hover:border-accent hover:text-accent transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
                            </svg>
                            GitHub
                        </a>
                    </div>

                    <form action="#" method="post" class="space-y-5">
                        @csrf
                        <div>
                            <label for="name"
                                class="block text-sm font-medium text-zinc-400 mb-1.5">{{ __('portfolio.contact_name') }}</label>
                            <input type="text" id="name" name="name" required
                                class="w-full px-4 py-3 rounded-lg bg-zinc-900 border border-zinc-700 text-white placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-accent focus:border-transparent"
                                placeholder="{{ __('portfolio.contact_name_placeholder') }}">
                        </div>
                        <div>
                            <label for="email"
                                class="block text-sm font-medium text-zinc-400 mb-1.5">{{ __('portfolio.contact_email') }}</label>
                            <input type="email" id="email" name="email" required
                                class="w-full px-4 py-3 rounded-lg bg-zinc-900 border border-zinc-700 text-white placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-accent focus:border-transparent"
                                placeholder="{{ __('portfolio.contact_email_placeholder') }}">
                        </div>
                        <div>
                            <label for="message"
                                class="block text-sm font-medium text-zinc-400 mb-1.5">{{ __('portfolio.contact_message') }}</label>
                            <textarea id="message" name="message" rows="4" required
                                class="w-full px-4 py-3 rounded-lg bg-zinc-900 border border-zinc-700 text-white placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-accent focus:border-transparent resize-none"
                                placeholder="{{ __('portfolio.contact_message_placeholder') }}"></textarea>
                        </div>
                        <button type="submit"
                            class="w-full sm:w-auto min-h-[44px] px-6 py-3 bg-accent text-charcoal font-semibold rounded-lg hover:bg-accent-hover transition-colors touch-manipulation">
                            {{ __('portfolio.contact_submit') }}
                        </button>
                    </form>
                </div>
            </section>
        </main>

        <footer class="border-t border-zinc-800/50 py-6 sm:py-8">
            <div
                class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-6xl w-full box-border text-center text-zinc-500 text-sm break-words">
                &copy; {{ date('Y') }} {{ __('portfolio.footer') }}
            </div>
        </footer>
    </div>
</body>

</html>
