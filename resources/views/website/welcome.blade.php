@extends('layouts.website')

@section('head')
<title>Vainkho | Online Grocery Store - Shop and Earn Money</title>
<meta name="description" content="Earn more Vainkho!! Buy Grocery online on Vainkho E-commerce. Vainkho is an online grocery Store that offers lowest price on all household shopping. Vainkho deals in daily staples like dal, pulses, grains, flours, spices, oil, noodles, pickles, snacks, packed food, personal care, baby care and so on. We are giving you an opportunity to earn with us through your shopping. We provide free home delivery. So, shop more and earn more with us.">
<meta name="keywords" content="grocery delivery near me,grocery delivery apps near me,buy grocery online near me,grocery delivery app,grocery delivery service,grocery delivery company,grocery delivery,grocery delivery in 24 hours,buy your grocery online,buy grocery online at lowest price,buy grocery online daily needs supermarket - Vainkho,buy grocery online vainkho,buy fresh grocery online,buy home grocery online,buy grocery online india,online buy grocery,online grocery shopping,grocery delivery [location],online grocery shopping [location],online grocery in [location],grocery online in [location],online grocery delivery in [location],buy grocery online [location],grocery delivery in [location],grocery delivery apps [location]">
@endsection

@section('content')

<div class="container-fluid px-0">

    <div class="image image-s image-hd-md image-header-lg">
        <img class="image-cover d-none d-md-block" src="/images/hero.jpg" alt="Vainkho Ecommerce private limited">
        <img class="image-cover d-block d-md-none" src="/images/hero-mob.jpg" alt="Vainkho Ecommerce private limited">
    </div>

</div>


<div class="jumbotron text-center">
    <div class="container">
        <h1 class="display-4">Vainkho?</h1>
        <p class="lead">Vainkho is Ecommerce website and deals in groceries and all kinds of home products. We have designed a special business plan for our customers, who are willing to grow and become successful in their life. Start purchasing discounted products from us. By doing so, you will become eligible to earn passive income.</p>
        <hr>
        <p>To start with, you need to enroll yourself on our website.</p>
        <a class="btn btn-lg btn-primary mr-3" href="/register">Register Now!</a>
        <a class="btn btn-lg btn-dark" href="/category/3">Shop Now!</a>
    </div>

</div>

<div class="container">

    <website-products id="{{$id}}" what="{{$what}}" warehouse_id="{{$warehouse_id}}" cols="col-6 col-lg-4 col-xl-3"></website-products>

    <div class="text-center my-5">
        <a href="/available" class="btn btn-primary btn-lg">Go to all available products</a>
    </div>

</div>

<div class="container py-5">

    <!-- <div class="row align-items-center">
        <div class="col-12 col-lg-6 mb-5">
            <iframe style="width:100%;" height="315" src="https://www.youtube.com/embed/abcd" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <div class="col-12 col-lg-6 mb-5">
            <h4 class="mb-3 h4 font-weight-bold">Why to choose us?</h4>
            <p class="lead">Do you often shop online? <br> Do you get anything back from the website? <br> Your answer is No. But if you will join us, you will certainly get something in return from us, and that would be your extra passive income.</p>
        </div>
    </div> -->

    <div class="row align-items-center">
        <div class="col-12 mb-5">
            <h4 class="mb-3 h4 font-weight-bold">Why to choose us?</h4>
            <p class="lead">Do you often shop online? <br> Do you get anything back from the website? <br> Your answer is No. But if you will join us, you will certainly get something in return from us, and that would be your extra passive income.</p>
        </div>
    </div>

</div>

<div class="container mb-5">
    <div class="row align-items-center">
        <div class="col-auto">
            <p class="title-lg"><i class="fas fa-rupee-sign"></i> 1000</p>
        </div>
        <div class="col">
            <p class="para-lg font-weight-bold">Add Rs 1000/- in your wallet right now!!!</p>
            <p class="para-lg">Now after adding Rs 1000/- in your wallet you don't need to tell anyone about us. all those who join without referance can be added in your downline.</p>
            <p class="para-lg">Get benifit of unlimited free downline.</p>
        </div>
    </div>
</div>

@endsection
