@extends('layouts.app')

@section('content')
    <div class="card text-center container">
        <div class="card-body">
            <h5 class="card-title">LISTA PRODUKTÓW</h5>
            <p class="card-text">Zarządzanie produktami</p>
            <a href="{{route('products.create')}}" class="btn btn-primary">Dodaj produkt</a>
        </div>

    </div>
    <div class="container">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Nazwa</th>
                <th scope="col">Opis</th>
                <th scope="col">Cena</th>
                <th scope="col">Ilość</th>
                <th scope="col">Akcje</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <th scope="row">{{$product->id}}</th>
                    <td>{{$product->name}}</td>
                    <td>{{$product->description}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->quantity}}</td>
                    <td>
                        <a href="{{route('products.edit', $product->id)}}">
                            edit</a>
                        <button class="btn btn-danger btn-sm delete" data-id="{{$product->id}}">x</button>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
        <div class="d-flex">
            {!! $products->links() !!}
        </div>
    </div>
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
                text: "Nie będziesz już mógł go przywrócić",
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
            url: "{{url('products')}}/" + $(this).data("id")
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
