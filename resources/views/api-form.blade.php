@extends('layouts.app')

@section('title', 'Product API Viewer')

@section('content')

<div class="page-wrapper">
    <div class="container">

        {{-- Hero / Header --}}
        <div class="hero-card">
            <div class="hero-content">
                <div class="hero-left">
                    <h1 class="hero-title">Product <span>API</span> Viewer</h1>
                    <p class="hero-subtitle">
                        Enter your Laravel REST API endpoint below.<br>
                        The API will be requested by this application and<br>
                        the product data will be displayed here.
                    </p>
                </div>
            </div>
        </div>

        {{-- Main white card --}}
        <div class="content-card">

            {{-- API Endpoint Form --}}
            <div class="section-header">
                <div class="section-icon">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/>
                        <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/>
                    </svg>
                </div>
                <h2 class="section-title">API Endpoint</h2>
            </div>
            <p class="section-desc">Paste your Laravel API endpoint to fetch products</p>

            <form action="/fetch-products" method="GET">
                <div class="input-group">
                    <div class="input-wrapper">
                        <div class="input-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/>
                                <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/>
                            </svg>
                        </div>
                        <input
                            type="url"
                            name="api_url"
                            id="api_url"
                            placeholder="http://127.0.0.1:8000/api/v1/products"
                            value="{{ request('api_url') }}"
                            required
                        >
                    </div>

                    <button type="submit" class="btn-get">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <line x1="22" y1="2" x2="11" y2="13"/>
                            <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                        </svg>
                        Get Products
                    </button>
                </div>

                <p class="example">
                    Example:
                    <code>http://127.0.0.1:8000/api/v1/products</code>
                </p>
            </form>

            {{-- API Response Area --}}
            <div class="response-card">
                <div class="response-header">
                    <div class="response-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <ellipse cx="12" cy="5" rx="9" ry="3"/>
                            <path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"/>
                            <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"/>
                        </svg>
                    </div>
                    <h3 class="response-title">API Response</h3>
                </div>
                <p class="response-desc">The product data will be shown here in JSON format.</p>

                <div class="response-placeholder" id="api-response">
                    @if(isset($products) || isset($response))
                        <pre class="response-json">{{ json_encode($products ?? $response ?? [], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</pre>
                    @else
                        <div class="placeholder-icon">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                <polyline points="14 2 14 8 20 8"/>
                                <line x1="9" y1="15" x2="15" y2="15"/>
                            </svg>
                        </div>
                        <div class="placeholder-text">Waiting for request...</div>
                        <div class="placeholder-hint">Enter an endpoint and click "Get Products" to see the response.</div>
                    @endif
                </div>
            </div>

        </div>

        <div class="page-footer">
            Laravel API Consumer &bull; Product Client
        </div>

    </div>
</div>

@endsection