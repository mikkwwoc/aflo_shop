@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Produkty</h2>


            @foreach($products as $product)
            <div class="row">

            </div>
            @endforeach


        <div class="d-flex">
            {!! $products->links() !!}
        </div>
    </div>
@endsection
