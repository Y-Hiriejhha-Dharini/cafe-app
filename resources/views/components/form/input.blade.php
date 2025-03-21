@props(['id'=>'', 'name', 'type' => 'text', 'placeholder' => ''])

<div class="mt-3">
    <input {{ $attributes->merge([
        'class' => 'block w-full rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm ',
        'id' => $id ?: $name,
        'name' => $name,
        'type' => $type,
        'placeholder' => $placeholder,
        'value' => old($name),
    ]) }} />
</div>
<x-form.error :error="$errors->first($name)" />



