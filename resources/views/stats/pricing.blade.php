@extends('layouts.app_stats')
@section('content')

        @include('layouts.sidebar')
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Pricing</h3>
                            <p class="text-subtitle text-muted">For user to check they list</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Pricing</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

                <section class="section">
                    <div class="row">
                        <div class="col-12 col-md-8 offset-md-2">
                            <div class="pricing">
                                <div class="row align-items-center">
                                    @foreach($plans as $plan)
                                        @if($plan->name=='Basic')
                                    <div class="col-md-4 px-0">
                                        <div class="card">
                                            <div class="card-header text-center">
                                                <h4 class="card-title">{{ $plan->name }}</h4>
                                                <p class="text-center">{{ $plan->description }}</p>
                                            </div>
                                            <h1 class="price">{{ number_format($plan->cost) }} XAF</h1>
                                            <ul>
                                                <li><i class="bi bi-check-circle"></i>{{ $plan->description }}</li>
                                            </ul>
                                            <div class="card-footer">
                                                <a href="{{ route('plans.show', $plan->slug) }}" class="btn btn-primary btn-block">Order Now</a>
                                            </div>
                                        </div>
                                    </div>
                                        @endif
                                    @if($plan->name=='Premium')
                                    <div class="col-md-4 px-0">
                                        <div class="card card-highlighted">
                                            <div class="card-header text-center">
                                                <h4 class="card-title">{{ $plan->name }}</h4>
                                                <p></p>
                                            </div>
                                            <h1 class="price text-white">{{ number_format($plan->cost) }} XAF</h1>
                                            <ul>
                                                <li><i class="bi bi-check-circle"></i>{{ $plan->description }}</li>
                                            </ul>
                                            <div class="card-footer">
                                                <a href="{{ route('plans.show', $plan->slug) }}" class="btn btn-outline-white btn-block">Order Now</a>
                                            </div>
                                        </div>
                                    </div>
                                        @endif
                                        @if($plan->name=='Classic')
                                        <div class="col-md-4 px-0">
                                            <div class="card">
                                                <div class="card-header text-center">
                                                    <h4 class="card-title">{{ $plan->name }}</h4>
                                                    <p class="text-center">{{ $plan->description }}</p>
                                                </div>
                                                <h1 class="price">{{ number_format($plan->cost) }} XAF</h1>
                                                <ul>
                                                    <li><i class="bi bi-check-circle"></i>{{ $plan->description }}</li>
                                                </ul>
                                                <div class="card-footer">
                                                    <a href="{{ route('plans.show', $plan->slug) }}" class="btn btn-primary btn-block">Order Now</a>
                                                </div>
                                            </div>
                                        </div>
                                            @endif
                                                @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
        </div>

            @include('layouts.footer')
        </div>
@endsection
