@extends('layouts.app')

@section('content')

<!-- Header-->
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">AFlo Shop</h1>
            <p class="lead fw-normal text-white-50 mb-0">Customowe ubrania, obrazy itp</p>
        </div>
    </div>

</header>

<!-- Section-->
<section class="py-5">
    <div class="container row-cols-auto text-center text-black">
        <row>
            <a href="#">
                Kategorie
            </a>
        </row>
    </div>
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            @foreach($products as $product)
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Product image-->
                        @if(!is_null($product->image_path))
                            <img src="{{asset('storage/'.$product->image_path)}}" class=card-img-top"/>
                        @else
                            <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="Grafika produktu" />
                        @endif
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder">{{$product->name}}</h5>
                                <!-- Product price-->
                                {{$product->price}} zł
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="{{route('products.show', $product->id)}}">Zobacz więcej</a></div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


</section>
<!-- Footer-->
<footer class="py-5 bg-dark">
    <div class="container"><p class="m-0 text-center text-white">| SKLEP INTERNETOWY - AFlo shop |</p></div>
</footer>
<!-- Bootstrap core JS-->

@endsection
