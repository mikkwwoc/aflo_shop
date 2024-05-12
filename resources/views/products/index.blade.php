@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Produkty</h2>


            @foreach($products as $product)
            <div class="row">
                <div class="col">
                    1 of 2
                </div>
                <div class="col">
                    2 of 2
                </div>
            </div>
            @endforeach


        <div class="d-flex">
            {!! $products->links() !!}
        </div>
    </div>
@endsection
