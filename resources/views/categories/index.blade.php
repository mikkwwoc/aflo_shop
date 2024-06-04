@extends('layouts.app')

@section('content')
    <div class="card text-center container">
        <div class="card-body">
            <h5 class="card-title">LISTA KATEGORII</h5>
            <p class="card-text">Zarządzanie kategoriami</p>
            <a href="{{route('categories.create')}}" class="btn btn-primary">Dodaj kategorie</a>
        </div>

    </div>
    <div class="container">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Nazwa</th>
                <th scope="col">Akcje</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <th scope="row">{{$category->id}}</th>
                    <td>{{$category->name}}</td>
                    <td>

                        <a href="{{route('categories.edit', $category->id)}}">
                            <button class="btn btn-success btn-sm edit">
                                Edit
                            </button>
                        </a>
                        <button class="btn btn-danger btn-sm delete" data-id="{{$category->id}}">X</button>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
        <div class="d-flex">
            {!! $categories->links() !!}
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
            url: "{{url('categories')}}/" + $(this).data("id")
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
