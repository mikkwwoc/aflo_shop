@extends('layouts.app')

@section('content')
    <div class="card text-center container">
        <div class="card-body">
            <h5 class="card-title">LISTA ZAMÓWIEŃ</h5>

        </div>

    </div>
    <div class="container">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Data</th>
                <th scope="col">Użytkownik</th>
                <th scope="col">Ilość</th>
                <th scope="col">Cena</th>
                <th scope="col">Czy dostarczono</th>
                <th scope="col">Produkty</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <th scope="row">{{$order->id}}</th>
                    <td>{{$order->created_at}}</td>
                    <td>{{$order->user->name}}</td>
                    <td>{{$order->quantity}}</td>
                    <td>{{$order->price}}</td>
                    <td>{{$order->is_delivered}}
                        @if(Auth::user()->role=='admin')
                            <a href="{{ route('orders.edit', $order->id) }}">
                                <button class="btn btn-success btn-sm">EDIT</button>
                            </a>
                        @endif

                    </td>
                    <td>
                        @foreach ($order->products as $product)
                        <ul>
                            <li>
                                {{$product->name}} - {{$product->description}}
                            </li>
                        </ul>
                        @endforeach
                    </td>

                </tr>
            @endforeach

            </tbody>
        </table>
        <div class="d-flex">
            {!! $orders->links() !!}
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
