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
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>
                                        Изображение
                                    </th>
                                    <th>
                                        Наименование
                                    </th>
                                    <th>
                                        Количество
                                    </th>
                                    <th>
                                        Цена за ед, руб
                                    </th>
                                </tr>
                                @foreach ($order->products as $product)
                                <tr>
                                    <td> <img src="{{asset('storage/img/products/')}}/{{$product->picture}}"
                                              height="40px"> </td>
                                        <td> {{$product->name}}</td>
                                        <td> {{$product->pivot->quantity}}</td>
                                        <td> {{$product->pivot->price}}</td>
                                     </tr>
                                @endforeach
                            </tbody>
                        </table>


{{--                        @foreach ($order->products as $product)--}}
{{--                            <li>--}}
{{--                                {{$product->name}}, {{$product->pivot->quantity}}, {{$product->pivot->price}}--}}
{{--                            </li>--}}
{{--                        @endforeach--}}
{{--                    </ul>--}}


                     <a class="btn btn-outline-dark" type="submit" href="{{route('orderCopyPaste', $order->id),}}" >Повторить заказ<a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
