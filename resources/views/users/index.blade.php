@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Nazwa</th>
                <th scope="col">E-mail</th>
                <th scope="col">Akcje</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <th scope="row">{{$user->id}}</th>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        <button class="btn btn-danger btn-sm delete" data-id="{{$user->id}}">x</button>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
        <div class="d-flex">
            {!! $users->links() !!}
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
                title: "Czy na pewno chcesz usunąć użytkownika?",
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
            url: "http://127.0.0.1:8000/users/" + $(this).data("id")
            })
                .done(function(response){
                    window.location.reload(); //po prawidlowym usunieciu reload
                })
                .fail(function(response){
                    Swal.fire("Błąd - coś poszło nie tak");
                })
                }
            });
        });
    });
@endsection

