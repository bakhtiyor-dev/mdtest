<body class="vertical-layout vertical-menu-modern 2-columns" data-menu="vertical-menu-modern" data-col="2-columns">
{{-- Include Sidebar --}}
@include('client.panels.sidebar')

<!-- BEGIN: Content-->
<div class="app-content content">
    <!-- BEGIN: Header-->
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>

    {{-- Include Navbar --}}
    @include('client.panels.navbar')

    <div class="content-wrapper">
        <div class="content-body">
            <div id="app">
                @yield('content')
            </div>
            {{-- Include Page Content --}}
        </div>
    </div>

</div>
<!-- End: Content-->

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

{{-- include footer --}}
@include('client/panels/footer')

{{-- include default scripts --}}
@include('client/panels/scripts')
@yield('scripts')
</body>
</html>
