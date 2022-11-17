<x-mail::message>

    # Olá

    O estoque de {{$product->name}} está acima do máximo permitido.

    Estoque atual: {{$product->stock}}

    Estoque máximo: {{$product::STOCK_MAX}}


    Obrigado,<br>
    {{ config('app.name') }}
</x-mail::message>
