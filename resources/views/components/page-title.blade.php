<!-- Page Title -->
<div class="page-title dark-background" data-aos="fade" style="background-image: url(/img/worldmap.webp);">
    <div class="container position-relative">
        <h1>{{ __($pageTitle) }}</h1>
        @if(isset($pageDescription))
        <p>{{ __($pageDescription) }}</p>
        @endif
        <nav class="breadcrumbs">
            <ol>
                <li><a href="{{ route('home', ['locale' => app()->getLocale()]) }}">{{ __('messages.nav.home') }}</a></li>
                <li class="current">{{ __($pageTitle) }}</li>
            </ol>
        </nav>
    </div>
</div>
<!-- End Page Title -->
