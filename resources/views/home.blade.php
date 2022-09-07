@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Ejemplo de Pago con Paypal    
                </div>

                <div class="card-body">
                    

                    <form action="{{ route('pay_paypal') }}" method="POST">
                        @csrf
                        <button class=" bg bg-red-900">PAY NOW</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
