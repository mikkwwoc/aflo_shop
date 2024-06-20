@extends('layouts.app')

@section('content')

    <!-- Header-->
    <section class="h-100 h-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12">
                    <form action="{{route('orders.store')}}" method="POST" id="order-form">
                        @csrf
                    <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                        <div class="card-body p-0">
                            <div class="row g-0">
                                <div class="col-lg-8">
                                    <div class="p-5">
                                        <div class="d-flex justify-content-between align-items-center mb-5">
                                            <h1 class="fw-bold mb-0 text-black">Koszyk zakupów</h1>
                                            <h6 class="mb-0 text-muted">Ilość rzeczy: {{$cart->getItems()->count()}}</h6>
                                        </div>
                                        <hr class="my-4">
                                        @foreach($cart->getItems() as $item)
                                            <div class="row mb-4 d-flex justify-content-between align-items-center">
                                                <div class="col-md-2 col-lg-2 col-xl-2">
                                                    <img
                                                        src="{{$item->getImage()}}"
                                                        class="img-fluid rounded-3" alt="img-{{$item->getName()}}">
                                                </div>
                                                <div class="col-md-3 col-lg-3 col-xl-3">
{{--                                                    <h6 class="text-muted"></h6>--}}
                                                    <h6 class="text-black mb-0">{{$item->getName()}}</h6>
                                                </div>
                                                <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                                    <h6 class="text-black mb-0">Ilość: {{$item->getQuantity()}}</h6>
                                                </div>
                                                <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                                    <h6 class="mb-0">PLN {{$item->getTotalPrice()}}</h6>
                                                </div>
                                                <div class="col-md-2 col-lg-1 col-xl-2 text-end">
                                                    <button type="button" class="btn btn-danger btn-sm delete" data-id="{{$item->getProductId()}}">X</button>
                                                </div>
                                            </div>
                                        <hr class="my-4">
                                        @endforeach


                                        <div class="pt-5">
                                            <h6 class="mb-0"><a href="/" class="text-body"><i
                                                        class="fas fa-long-arrow-alt-left me-2"></i>Wróć do sklepu</a></h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 bg-grey">
                                    <div class="p-5">
                                        <h3 class="fw-bold mb-5 mt-2 pt-1">Podsumowanie</h3>
                                        <hr class="my-4">

                                        <div class="d-flex justify-content-between mb-4">
                                            <h5 class="text-uppercase">Rzeczy: {{$cart->getItems()->count()}}</h5>
                                            <h5>PLN {{$cart->getTotalPrice()}}</h5>
                                        </div>

{{--                                        <h5 class="text-uppercase mb-3">Dostawa</h5>--}}

{{--                                        <div class="mb-4 pb-2">--}}
{{--                                            <select data-mdb-select-init>--}}
{{--                                                <option value="1">Standardowa dostawa - PLN 20</option>--}}
{{--                                            </select>--}}
{{--                                        </div>--}}

                                        <h5 class="text-uppercase mb-3">Metoda płatności</h5>

                                        <div class="mb-4 pb-2">
                                            <select data-mdb-select-init>
                                                <option value="1">Gotówka</option>
                                            </select>
                                        </div>

{{--                                        <h5 class="text-uppercase mb-3">Give code</h5>--}}

{{--                                        <div class="mb-5">--}}
{{--                                            <div data-mdb-input-init class="form-outline">--}}
{{--                                                <input type="text" id="form3Examplea2" class="form-control form-control-lg" />--}}
{{--                                                <label class="form-label" for="form3Examplea2">Enter your code</label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

                                        <hr class="my-4">

                                        <div class="d-flex justify-content-between mb-5">
                                            <h5 class="text-uppercase">Łączna kwota</h5>
                                            <h5>PLN {{$cart->getTotalPrice()}}</h5>
                                        </div>

                                        <button  type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-dark btn-block btn-lg"
                                                 data-mdb-ripple-color="dark ">Przejdź do płatności</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container"><p class="m-0 text-center text-white">| SKLEP INTERNETOWY - AFlo shop |</p></div>
    </footer>

@endsection
@section('javascript')
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') //?przekazanie tokenu csfr do zainicjowania ajax? bez tego nie dziala usuwanie
        }
    });

    $(function(){
        $('.delete').click(function (){
            Swal.fire({
                title: "Czy na pewno chcesz usunąć produkt?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Tak",
                cancelButtonText: "Nie"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            method:"DELETE",
                            url: "{{url('cart')}}/" + $(this).data("id")
                        })
                        .done(function(response){
                            window.location.reload(); //po prawidlowym usunieciu reload
                        })
                        .fail(function(response){
                            Swal.fire("Błąd", response.responseJSON.message, response.responseJSON.status);
                        })
                    }
                });
            });
        });
@endsection
