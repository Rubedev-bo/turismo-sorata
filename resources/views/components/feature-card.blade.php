@props(['icon' => '🏔️','title' => 'Titulo','text' => 'Descripción'])

<div class="feature-card" data-aos="zoom-in">
    <div class="feature-icon">{{ $icon }}</div>
    <h4 class="feature-title">{{ $title }}</h4>
    <p class="feature-text">{{ $text }}</p>
</div>
