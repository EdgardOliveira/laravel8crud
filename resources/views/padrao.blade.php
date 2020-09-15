<!DOCTYPE html>
<html lang="pt-br">
<head>
    @include('head')
</head>
<body>
<div class="wrapper">
    <!-- Navbar -->
    <div class="main-header">
        @include('navbar')
    </div>
    <!-- End Navbar -->

    <!-- Sidebar -->
    <div class="sidebar sidebar-style-2">
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
            <div class="sidebar-content">
                @include('sidebar')
            </div>
        </div>
    </div>
    <!-- End Sidebar -->

    <!-- Conteúdo -->
    <div class="main-panel">
        <div class="content">
            @yield('content')
        </div>

        <!-- Rodapé -->
        <footer class="footer">
            @include('footer')
        </footer>
        <!-- Fim do rodapé -->

    </div>
    <!-- Fim do conteúdo -->
</div>
</body>
</html>
