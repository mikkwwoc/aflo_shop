@extends('layouts.app')

@section('content')
<!-- Product section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            @if(!is_null($product->image_path))
                <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="{{asset('storage/'.$product->image_path)}}" alt="Grafika produktu" /></div>
            @else
                <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="https://dummyimage.com/600x700/dee2e6/6c757d.jpg" alt="Grafika produktu" /></div>
            @endif
                <div class="col-md-6">
                <div class="small mb-1">ID: {{$product->id}}</div>
                <h1 class="display-5 fw-bolder">{{$product->name}}</h1>
                <div class="fs-5 mb-5">
                    <span class="text-decoration-line-through">{{($product->price) * 5}} zł</span>
                    <span>{{$product->price}} zł</span>
                </div>
                <p class="lead">{{$product->description}}</p>
                <div class="d-flex">
                    <input class="form-control text-center me-3" id="inputQuantity" type="num" value="1" step = "1" max="{{$product->quantity}}" style="max-width: 3rem" />
                    <button class="btn btn-outline-dark flex-shrink-0 add-to-cart-btn" type="button" data-id="{{$product->id}}" @guest disabled @endguest>
                        Dodaj do koszyka
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Related items section-->
<section class="py-5 bg-light">
    <div class="container px-4 px-lg-5 mt-5">
        <h2 class="fw-bolder mb-4">Inne produkty</h2>
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
    <div class="row gx-4 gx-lg-5 row-cols-md-3justify-content-center">
        {!! $products->links() !!}
    </div>

</section>
<footer class="py-5 bg-dark">
<div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p></div>
</footer>

@endsection
@section('javascript')
    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') //?przekazanie tokenu csfr do zainicjowania ajax? bez tego nie dziala usuwanie
    }
    });

    $('button.add-to-cart-btn').click(function(event) {
        event.preventDefault();
        $.ajax({
            method: "POST",
            url: "{{url('cart')}}/" + $(this).data('id')
        })
            .done(function() {
                Swal.fire({
                title: "Gotowe",
                text: "Produkt dodany do koszyka",
                icon: "success",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Przejdź do koszyka",
                cancelButtonText: "Kontynuuj zakupy"

                }).then((result) => {
                    if(result.isConfirmed){
                        window.location = "/cart";
                        }
                })
            })
            .fail(function(){
                Swal.fire("Nie udało się", 'Błąd', 'error');
            })
        });
@endsection
