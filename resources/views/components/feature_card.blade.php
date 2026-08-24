@props([
    'icon' => 'ti ti-ticket',
    'title' => 'Feature',
    'description' => 'Add a helpful description for this feature.',
])

<div class="feature-card">
    <div class="feature-icon">
        <i class="{{ $icon }}"></i>
    </div>
    <h3>{{ $title }}</h3>
    <p>{{ $description }}</p>
</div>