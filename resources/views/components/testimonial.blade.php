@props(['quote','avatar','name','from'])

<div class="testimonial" data-aos="fade-up">
    <div class="testimonial-avatar"><img src="{{ $avatar }}" alt="{{ $name }}" loading="lazy"></div>
    <blockquote class="testimonial-quote">“{{ $quote }}”</blockquote>
    <p class="testimonial-meta">{{ $name }} — <span>{{ $from }}</span></p>
</div>
