<form {{ $attributes(["class"=>"px-8 pt-12 pb-18 rounded-3xl border-4 border-black shadow-md w-full max-w-md", "method"=>"GET"]) }}>
    @if ($attributes->get('method','GET')!== 'GET')
        @csrf
        @method($attributes->get('method'))
    @endif
    {{ $slot }}
</form>
