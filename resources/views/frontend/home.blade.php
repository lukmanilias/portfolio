@extends('frontend.layouts.layout')

@section('content')
    <!-- Header-Area-Start -->
    @include('frontend.section.hero')
    <!-- Header-Area-End -->

    <!-- Service-Area-Start -->
    @include('frontend.section.service')
    <!-- Service-Area-End -->

    <!-- About-Area-Start -->
    @include('frontend.section.about')
    <!-- About-Area-End -->

    <!-- Portfolio-Area-Start -->
    @include('frontend.section.portfolio')
    <!-- Portfolio-Area-End -->

    <!-- Skills-Area-Start -->
    @include('frontend.section.skill')
    <!-- Skills-Area-End -->

    <!-- Experience-Area-Start -->
    @include('frontend.section.experience')
    <!-- Experience-Area-End -->

    <!-- Testimonial-Area-Start -->
    @include('frontend.section.testimonial')
    <!-- Testimonial-Area-End -->

    <!-- Blog-Area-Start -->
    @include('frontend.section.blog')
    <!-- Blog-Area-End -->

    <!-- Contact-Area-Start -->
    @include('frontend.section.contact')
    <!-- Contact-Area-End -->
@endsection
