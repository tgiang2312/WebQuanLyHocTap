<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LearnHub - Nền tảng học tập trực tuyến')</title>
    <meta name="description" content="Nền tảng học tập trực tuyến hiện đại dành cho giới trẻ">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <!-- Animate.css for animations -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    
    <!-- Common CSS -->
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    
    <!-- Component CSS -->
    <link rel="stylesheet" href="{{ asset('css/components/course-card.css') }}">
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Page-specific CSS -->
    @if(Route::is('home'))
    <link rel="stylesheet" href="{{ asset('css/pages/home.css') }}">
    @endif
    
    @yield('styles')
</head>
<body>
    <div class="d-flex flex-column min-vh-100">
        @include('layouts.navigation')
        
        <main class="flex-grow-1">
            @yield('content')
        </main>
        
        @include('layouts.footer')
    </div>
    
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- jQuery (required for some Bootstrap components) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- GSAP Animation Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollToPlugin.min.js"></script>
    
    <!-- Particles.js -->
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    
    <!-- Common JS -->
    <script src="{{ asset('js/common.js') }}"></script>
    
    <!-- Page-specific JS -->
    @if(Route::is('home'))
    <script src="{{ asset('js/pages/home.js') }}"></script>
    @endif
    
    @yield('scripts')
</body>
</html>
