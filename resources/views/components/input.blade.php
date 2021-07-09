@props(['name'])

<input name="{{ $name }}"
    {!! $attributes->merge(['class' => 'appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500']) !!}
/>
@error($name)
    <span class="text-red-500 text-sm font-semibold"> {{ $message }}</span>
@enderror
