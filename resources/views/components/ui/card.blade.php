@props([
'variant' => 'glass', // glass, solid
'padding' => 'p-6',
'hover' => false,
])

@php
$baseClasses = 'relative rounded-2xl overflow-hidden transition-all duration-300';

$variants = [
'glass' => 'card-premium-glass text-zinc-100',
'solid' => 'bg-zinc-900 border border-zinc-800',
];

$hoverEffects = $hover ? 'hover:-translate-y-2 hover:shadow-[0_20px_40px_rgba(0,0,0,0.5)] hover:border-white/20' : '';

$classes = $baseClasses . ' ' . $variants[$variant] . ' ' . $padding . ' ' . $hoverEffects;
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</div>