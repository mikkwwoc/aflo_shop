@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edytowanie produktu') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nazwa produktu') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{$product->name}}" required autocomplete="name" autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Opis') }}</label>

                                <div class="col-md-6">
                                    <textarea id="description" class="form-control" name="description" autofocus>{{$product->description}}
                                    </textarea>

                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="price" class="col-md-4 col-form-label text-md-end">{{ __('Kwota') }}</label>

                                <div class="col-md-6">
                                    <input id="price" type="number" class="form-control" step="0.01" name="price" required autocomplete="price" value="{{$product->price}}">

                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="quantity" class="col-md-4 col-form-label text-md-end">{{ __('Ilość') }}</label>

                                <div class="col-md-6">
                                    <input id="quantity" type="number" class="form-control" step="1" name="quantity" required autocomplete="quantity" value="{{$product->quantity}}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="image" class="col-md-4 col-form-label text-md-end">{{ __('Grafika') }}</label>

                                <div class="col-md-6">
                                    <input id="image" type="file" class="form-control" name="image">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Edytuj') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
