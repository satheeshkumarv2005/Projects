<x-mail::message>
    Hello From satheesh


Welcome to our Cool Application

<p>Dear customer {{ $data['name'] }} {{ $data['type'] }} by Rs {{ $data['amount'] }} available balance {{ $data['balance'] }}.</p>






Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
