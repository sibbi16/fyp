@props(['type' => 'free', 'name' => 'cil-user'])

<svg {{ $attributes->merge(['class' => 'c-icon']) }}>
    <use xlink:href="{{asset('vendor/@coreui/icons/svg/'.$type.'.svg#'. $name)}}"></use>
</svg>
