@props(['size' => 'md', 'class' => ''])

@php
$sizes = [
    'sm' => 'w-24 h-8',
    'md' => 'w-32 h-12', 
    'lg' => 'w-48 h-16',
    'xl' => 'w-64 h-20'
];
$sizeClass = $sizes[$size] ?? $sizes['md'];
@endphp

<div class="{{ $sizeClass }} {{ $class }}">
    <svg width="200" height="80" viewBox="0 0 200 80" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
        <!-- Hamburger Icon -->
        <g transform="translate(10, 10)">
            <!-- Bun top -->
            <path d="M5 25C5 20 10 15 20 15C30 15 35 20 35 25H35C35 27 33 29 30 29H5C5 29 5 27 5 25Z" fill="#F4A261"/>
            <!-- Lettuce -->
            <path d="M7 29H33C33 31 31 33 28 33H12C9 33 7 31 7 29Z" fill="#2A9D8F"/>
            <!-- Meat -->
            <path d="M8 33H32C32 35 30 37 27 37H13C10 37 8 35 8 33Z" fill="#C1272D"/>
            <!-- Cheese -->
            <path d="M9 37H31C31 39 29 41 26 41H14C11 41 9 39 9 37Z" fill="#F4A261"/>
            <!-- Bun bottom -->
            <path d="M10 41H30C30 43 28 45 25 45H15C12 45 10 43 10 41Z" fill="#F4A261"/>
        </g>
        <!-- Text -->
        <g transform="translate(60, 15)">
            <text x="0" y="20" font-family="Arial, sans-serif" font-weight="bold" font-size="18" fill="#C1272D">FAST</text>
            <text x="0" y="40" font-family="Arial, sans-serif" font-weight="bold" font-size="18" fill="#E63946">BITE</text>
        </g>
        <!-- Speed lines -->
        <g transform="translate(140, 25)">
            <line x1="0" y1="5" x2="15" y2="5" stroke="#F4A261" stroke-width="2" stroke-linecap="round"/>
            <line x1="5" y1="15" x2="20" y2="15" stroke="#F4A261" stroke-width="2" stroke-linecap="round"/>
            <line x1="0" y1="25" x2="15" y2="25" stroke="#F4A261" stroke-width="2" stroke-linecap="round"/>
        </g>
    </svg>
</div> 