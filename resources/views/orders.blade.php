@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach (Auth::user()->orders as $order)
            <p>
                <a class="btn btn-link" data-bs-toggle="collapse" href="#collapseExample{{$order->id}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                    #{{$order->id}}
                </a>
                {{ date('d.m.Y H:i:s', strtotime($order->created_at)) }}
            </p>
            <div class="collapse mb-4" id="collapseExample{{$order->id}}">
                <div class="card card-body">
                    <ul>
                        @foreach ($order->products as $product)
                            <li>
                                {{$product->name}}, {{$product->pivot->quantity}}, {{$product->pivot->price}}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
@endsection