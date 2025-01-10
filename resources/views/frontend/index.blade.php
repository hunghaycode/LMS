@extends('frontend.layouts.master')
@section('frontend')
    <!-- Banner Starts Here -->
@include('frontend.home.banner')

    <!-- Featured Categories Starts Here -->
    @include('frontend.home.category')

    <!-- Featured Categories Ends Here -->

    <!--  Popular Courses Starts Here -->
    @include('frontend.home.popular-courses')
 
    {{-- areas-book.blade--}}

    <!--  Learning Rules Starts Here -->
    @include('frontend.home.learning-rules')


    <!--  About Services Starts Here -->
    @include('frontend.home.about')
  

    <!-- Best Instructors Starts Here -->
    @include('frontend.home.team')


    <!--  Latest Events Featured Starts Here -->
    @include('frontend.home.even')


    <!--  Main Become Instructor Starts Here -->
    @include('frontend.home.instructor-business')


    <!-- News Letter Starts Here -->
    @include('frontend.home.news-letter')

    <!-- =======================
    Reviews END -->

    {{-- <!--TOP SECTION-->
    <!--Check Availability SECTION-->
    @include('frontend.home.carousel')
    <!--End Check Availability SECTION-->
    <!--HOTEL ROOMS SECTION-->
    @include('frontend.home.room')

    @include('frontend.home.areas-book')
    @include('frontend.home.team')
    @include('frontend.home.photo-gallery')

    @include('frontend.home.even') --}}
@endsection
