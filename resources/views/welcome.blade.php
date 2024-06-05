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
    <div class="container p-3 my-1 border-3">
        <h3>FILTRY</h3>
        <form class="row filtering">
            <div class="col-12 col-md-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h3 class="h5 card-title">Kategorie</h3>
                        <div class="row">
                            <div class="col-6">
                                @foreach($categories as $category)
                                    <div class="form-check mb-1">
                                        <input class="form-check-input" type="checkbox" name="filter[categories][]" id="category-{{$category->id}}" value="{{$category->id}}">
                                        <label class="form-check-label" for="category-{{$category->id}}">
                                            {{$category->name}}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h3 class="h5 card-title">Zakres cen</h3>
                        <!-- Simple slider -->
                        <div class="input-slider-container">
                            <div id="input-slider-ecommerce" class="input-slider" data-range-value-min="100" data-range-value-max="500"></div>
                            <!-- Input slider values -->
                            <div class="row mt-3 d-none">
                                <div class="col-6">
                                    <span id="input-slider-value" class="range-slider-value" data-range-value-low="200"></span>
                                </div>
                            </div>
                        </div>
                        <!-- End of Slider -->
                        <div class="d-flex mb-3">
                            <div class="col-md-6 me-2">
                                <label for="priceRangeMin1">Min</label>
                                <input type="number" class="form-control" id="price-min" placeholder="50" name="filter[price_min]">
                            </div>
                            <div class="col-md-6 text-right">
                                <label for="priceRangeMax1">Max</label>
                                <input type="number" class="form-control" id="price-max" placeholder="250" name="filter[price_max]">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="g-grid">
                <a href="#" class="btn btn-primary" id="filter-button">Zastosuj</a>
            </div>
        </form>
        </div>
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center" id="products-container">
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

@endsection
@section('javascript')
    const storagePath = '{{asset('storage')}}/';
$(function(){
    $('a#filter-button').click(function() {
        const form = $('form.filtering').serialize();
        $.ajax({
            method:"GET",
            url: "/",
            data: form
        })
        .done(function (response) {
            $('div#products-container').empty();
            $.each(response.data, function (index, product) {
                let photoHtml;
                if(product.image_path !==null){
                    photoHtml = '<img src="' + storagePath + product.image_path + '" class=card-img-top"/>';}
                else{
                    photoHtml = '<img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="Grafika produktu" />';
                }
                const html = '<div class="col mb-5">'+
                               ' <div class="card h-100">'+
                                    <!-- Product image-->
                                         photoHtml +
                                    <!-- Product details-->
                                    '<div class="card-body p-4">'+
                                        '<div class="text-center">'+
                                            <!-- Product name-->
                                            '<h5 class="fw-bolder">'+product.name + '</h5>'+
                                            <!-- Product price-->
                                            product.price + 'zł' +
                                        '</div>'+
                                    '</div>'+
                                    <!-- Product actions-->
                                    '<div class="card-footer p-4 pt-0 border-top-0 bg-transparent">'+
                                        '<div class="text-center"><a class="btn btn-outline-dark mt-auto" href="/products/'+ product.id +'">Zobacz więcej</a></div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>';
                    //console.log(photoHtml);
                $('div#products-container').append(html);
            });
        })
        .fail(function (data) {
            alert("źle");
        })
    });
});

@endsection
