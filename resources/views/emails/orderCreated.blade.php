<h1>
    Уважаемый {{$data['user']['name']}}!
</h1>

Ваш заказ успешно оформлен.

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Наименование</th>
            <th>Цена</th>
            <th>Количество</th>
            <th>Сумма</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data['products'] as $product)
        <tr>
            <td>{{$product['name']}}</td>                    
            <td>{{$product['price']}}</td>                    
            <td>{{$product['quantity']}}</td>                    
            <td>{{$product['quantity'] * $product['price']}}</td>                    
        </tr>
        @endforeach
        <tr>
            <td style="text-align: right;" colspan=3>
                Итого:
            </td>
            <td>
                <strong>
                    {{ $data['products']->map(function ($product) {
                            return $product['price'] * $product['quantity'];
                })->sum(); }}
                </strong>
            </td>
        </tr>
    </tbody>
</table>