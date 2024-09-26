<div>
    <label for="{{ $id }}" class="block text-sm font-medium leading-6 text-gray-900">{{ $label }}</label>
    <div class="mt-2">
        <textarea
            id="{{ $id }}"
            name="{{ $name }}"
            rows="10"
            @class([
                'form-textarea block w-full shadow-sm rounded-md border-0 py-1.5 ring-1 ring-inset focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6',
                'text-red-900 ring-red-300 placeholder:text-red-300 focus:ring-red-500' => $errors->has($name),
                'text-gray-900 ring-gray-300 placeholder:text-gray-400 focus:ring-indigo-600' => ! $errors->has($name),
            ])
        >{{ old($name) ?? $slot }}</textarea>
    </div>

    @error($name)
    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror

    @if ($help)
    <p class="mt-2 text-sm text-gray-500">{{ $help }}</p>
    @endif
</div>
