@extends('layouts.app')

@section('title', 'Products')

@section('content')

<div class="page-wrapper products-page">
    <div class="container">

        {{-- Hero Header --}}
        <div class="hero-card products-hero">
            <div class="hero-content">
                <div class="hero-left">
                    <!-- <div class="logo-icon">&lt;/&gt;</div> -->
                    <h1 class="hero-titlee">Products</h1>
                    <p class="hero-subtitle">Products fetched from the Laravel REST API.</p>
                    <a href="{{ url('/') }}" class="back-link">← Enter Another API</a>
                </div>
            </div>
        </div>

        {{-- Main White Card --}}
        <div class="content-card products-content">

            {{-- API Endpoint Bar --}}
            <div class="endpoint-bar">
                <div class="endpoint-left">
                    <div class="endpoint-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/>
                            <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/>
                        </svg>
                    </div>
                    <div>
                        <div class="endpoint-label">API Endpoint</div>
                        <div class="endpoint-url">
                            {{ request('api_url') ?? 'http://127.0.0.1:8000/api/v1/products' }}
                            <button type="button" class="copy-btn" title="Copy">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="9" y="9" width="13" height="13" rx="2" ry="2"/>
                                    <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <form action="/fetch-products" method="GET">
                    <input type="hidden" name="api_url" value="{{ request('api_url') }}">
                    <button type="submit" class="btn-refresh">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path d="M23 4v6h-6"/>
                            <path d="M1 20v-6h6"/>
                            <path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"/>
                        </svg>
                        Refresh Products
                    </button>
                </form>
            </div>

            {{-- Stats Cards --}}
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon red">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <ellipse cx="12" cy="5" rx="9" ry="3"/>
                            <path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"/>
                            <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"/>
                        </svg>
                    </div>
                    <div>
                        <div class="stat-label">Products Found</div>
                        <div class="stat-value">{{ count($products ?? []) }}</div>
                        <div class="stat-sub">Total products</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon green">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                            <polyline points="22 4 12 14.01 9 11.01"/>
                        </svg>
                    </div>
                    <div>
                        <div class="stat-label">Active Products</div>
                        <div class="stat-value green">{{ collect($products ?? [])->where('is_active', true)->count() }}</div>
                        <div class="stat-sub">100% of total</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon blue">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/>
                            <line x1="7" y1="7" x2="7.01" y2="7"/>
                        </svg>
                    </div>
                    <div>
                        <div class="stat-label">Categories</div>
                        <div class="stat-value blue">{{ collect($products ?? [])->pluck('category')->unique()->count() }}</div>
                        <div class="stat-sub">Total categories</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon purple">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"/>
                            <polyline points="12 6 12 12 16 14"/>
                        </svg>
                    </div>
                    <div>
                        <div class="stat-label">Last Updated</div>
                        <div class="stat-value purple">Just now</div>
                        <div class="stat-sub">Real-time data</div>
                    </div>
                </div>
            </div>

            {{-- Products List --}}
            <div class="products-list-card">
                <div class="list-header">
                    <div class="list-title-wrap">
                        <div class="list-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
                                <line x1="3" y1="6" x2="21" y2="6"/>
                                <path d="M16 10a4 4 0 0 1-8 0"/>
                            </svg>
                        </div>
                        <div>
                            <div class="list-title">Products List</div>
                            <div class="list-subtitle">All products fetched from your Laravel REST API.</div>
                        </div>
                    </div>
                    <select class="sort-select">
                        <option>Sort by: ID (Newest)</option>
                        <option>Sort by: Price (High to Low)</option>
                        <option>Sort by: Name</option>
                    </select>
                </div>

                <div class="table-wrap">
                    <table class="products-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>DESCRIPTION</th>
                                <th>CATEGORY</th>
                                <th>PRICE</th>
                                <th>STATUS</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products ?? [] as $product)
                                <tr>
                                    <td>
                                        <div class="id-cell">
                                            <div class="id-icon">
                                                @if(($product['id'] ?? 0) % 3 == 1)
                                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                                                @elseif(($product['id'] ?? 0) % 3 == 2)
                                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>
                                                @else
                                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 10h-1.26A8 8 0 1 0 9 20h9a5 5 0 0 0 0-10z"/></svg>
                                                @endif
                                            </div>
                                            <span>#{{ $product['id'] ?? '-' }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="desc-title">{{ $product['name'] ?? 'N/A' }}</div>
                                        <div class="desc-sub">{{ Str::limit($product['description'] ?? '', 50) }}</div>
                                    </td>
                                    <td>
                                        <span class="category-badge">{{ $product['category'] ?? 'General' }}</span>
                                    </td>
                                    <td class="price-cell">${{ number_format($product['price'] ?? 0, 2) }}</td>
                                    <td>
                                        @if($product['is_active'] ?? true)
                                            <span class="status-badge active">● Active</span>
                                        @else
                                            <span class="status-badge inactive">● Inactive</span>
                                        @endif
                                    </td>
                                   
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="empty-row">
                                        No products found. Try another API endpoint.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="table-footer">
                    Showing {{ count($products ?? []) }} of {{ count($products ?? []) }} products
                </div>
            </div>

            {{-- Data Source Bar --}}
            <div class="datasource-bar">
                <div class="datasource-left">
                    <div class="datasource-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <ellipse cx="12" cy="5" rx="9" ry="3"/>
                            <path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"/>
                            <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"/>
                        </svg>
                    </div>
                    <div>
                        <div class="datasource-title">Data Source</div>
                        <div class="datasource-text">All products are fetched in real-time from your Laravel REST API.</div>
                    </div>
                </div>
                <div class="datasource-code">{…}</div>
            </div>

        </div>

        <div class="page-footer">
            Laravel API Consumer • Product Client
        </div>

    </div>
</div>

@endsection