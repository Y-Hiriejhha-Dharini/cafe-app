@props(['type'=>'submit'])

<button {{ $attributes(["class"=>"block w-full rounded-full bg-black px-4 py-2 text-sm font-medium text-white shadow-sm focus:outline-none focus:ring-2"])}}>
    {{ $slot }}
</button>
