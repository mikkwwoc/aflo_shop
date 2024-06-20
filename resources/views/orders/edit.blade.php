@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edytowanie statusu') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('orders.update', $order->id) }}">
                            @csrf
                            @method('POST')
                                <div class="row mb-3">
                                    <label for="is_delivered" class="col-md-4 col-form-label text-md-end">{{ __('Czy dostarczono') }}</label>

                                    <div class="col-md-6">
                                        <select id="is_delivered" class="form-control @error('is_delivered') is-invalid @enderror" name="is_delivered">
                                            <option value="nie">nie</option>
                                            <option value="tak">tak</option>
                                        </select>

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
