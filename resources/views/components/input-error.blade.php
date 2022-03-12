@props(['for'])

@error($for)
    <span {{ $attributes->merge(['class' => 'text-danger h6 mb-1']) }} role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
