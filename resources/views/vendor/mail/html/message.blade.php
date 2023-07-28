@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <img src="data:image/png;base64,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"
                 height="50px;" alt="logo">
        @endcomponent
    @endslot

    {{-- Body --}}
    {{ $slot }}

    {{-- Subcopy --}}
    @isset($subcopy)
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endisset

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }}
        @endcomponent
    @endslot
@endcomponent
