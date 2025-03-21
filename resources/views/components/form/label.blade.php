@props(['name'])
<label {{ $attributes->merge(["class"=>"block text-sm font-medium text-gray-700", "for"=>$name]) }}>
    {{ $slot }}
</label>

