<div>
    <label for="{{ $id }}" class="block text-sm font-medium leading-6 text-gray-900">{{ $label }}</label>
    <div @class(['mt-2', 'relative rounded-md shadow-sm' => $errors->has($name) && $type !== 'file'])>
        <input
            id="{{ $id }}"
            name="{{ $name }}"
            type="{{ $type }}"
            @if ($type !== 'file')
            value="{{ old($name) ?? $value }}"
            @class([
                'form-input block w-full rounded-md border-0 py-1.5 ring-1 ring-inset focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6',
                'pr-10 text-red-900 ring-red-300 placeholder:text-red-300 focus:ring-red-500' => $errors->has($name),
                'text-gray-900 shadow-sm ring-gray-300 placeholder:text-gray-400 focus:ring-indigo-600' => ! $errors->has($name),
            ])
            @endif
        >
        @error($name && $type !== 'file')
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
            <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
            </svg>
        </div>
        @enderror
    </div>

    @error($name)
    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror

    @if ($help)
    <p class="mt-2 text-sm text-gray-500">{{ $help }}</p>
    @endif

    @if ($type === 'file' && $value)
    <p class="mt-3 text-sm text-gray-500">Fichier actuel : {{ $value }}</p>
    @if ($isImage())
    <img class="mt-2 max-w-full max-h-48" src="{{ asset('storage/' . $value) }}" alt="Image {{ $value }}">
    @endif
    @endif
</div>
