@extends('layouts.app')

@section('title', 'Contact - DK Academy Makassar')

@section('content')
<section class="page-hero">
    <div class="site-container page-hero-grid">
        <div>
            <p class="eyebrow">Contact</p>
            <h1>Contact DK Academy Makassar.</h1>
            <p>Temukan lokasi DK Academy dan kanal resmi yang tersedia untuk konsultasi program Bahasa Inggris.</p>
        </div>
        <div class="page-hero-mark">
            <img src="{{ asset('images/contact/dk.png') }}" alt="DK Academy contact">
        </div>
    </div>
</section>

<section class="section section-soft">
    <div class="site-container contact-grid">
        <div class="contact-list" data-reveal>
            <article class="contact-card contact-card-primary">
                <div class="contact-entry">
                    <i class="bi bi-geo-alt"></i>
                    <div>
                        <h2>Address</h2>
                        <p>{{ $contact['address'] }}</p>
                        <a href="{{ $contact['mapUrl'] }}" target="_blank" rel="noopener" class="text-link">Open Google Maps</a>
                    </div>
                </div>
                <div class="contact-entry">
                    <i class="bi bi-whatsapp"></i>
                    <div>
                        <h2>WhatsApp / Phone</h2>
                        <p>{{ $contact['phone'] }}</p>
                        <a href="{{ $contact['whatsappUrl'] }}" target="_blank" rel="noopener" class="text-link">Chat via WhatsApp</a>
                    </div>
                </div>
            </article>
            <article class="contact-card">
                <div class="contact-entry">
                    <i class="bi bi-envelope"></i>
                    <div>
                        <h2>Email</h2>
                        <p><a href="mailto:{{ $contact['email'] }}">{{ $contact['email'] }}</a></p>
                    </div>
                </div>
            </article>
            <article class="contact-card">
                <div class="contact-entry">
                    <i class="bi bi-instagram"></i>
                    <div>
                        <h2>Instagram</h2>
                        <p><a href="{{ $contact['instagram'] }}" target="_blank" rel="noopener">dk.academy.id</a></p>
                    </div>
                </div>
            </article>
            <article class="contact-card">
                <div class="contact-entry">
                    <i class="bi bi-clock"></i>
                    <div>
                        <h2>Working Hours</h2>
                        <p>{{ $contact['workingHours'] }}</p>
                    </div>
                </div>
            </article>
        </div>

        <div class="map-placeholder" data-reveal>
            <iframe src="{{ $contact['mapEmbedUrl'] }}" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="DK Academy Makassar map"></iframe>
        </div>
    </div>
</section>
@endsection
