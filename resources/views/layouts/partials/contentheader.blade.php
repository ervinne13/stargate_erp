<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        @yield('contentheader-title', isset($currentModuleHeader) ? $currentModuleHeader["M_Description"] : "")
        <small>@yield('contentheader-description', isset($currentModule) ? $currentModule["M_Description"] : "")</small>
    </h1>
    @yield('breadcrumb-html')   
</section>