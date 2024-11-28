@extends('layouts.app')

@section('contenido')
<div class="container mt-5">
    <h2 class="text-center mb-4">Realiza tu Pago</h2>

    {{-- Mensaje de error o éxito --}}
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @elseif(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Formulario de pago --}}
    <form action="{{ route('stripe.process') }}" method="POST" id="payment-form">
        @csrf
        <div class="form-group mb-3">
            <label for="name">Nombre del Titular</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="email">Correo Electrónico</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="postal_code">Código Postal</label>
            <input type="text" id="postal_code" name="postal_code" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="card-element">Tarjeta de Crédito/Débito</label>
            <div id="card-element" class="form-control">
                <!-- Stripe Elements se insertará aquí -->
            </div>
            <div id="card-errors" role="alert" class="text-danger mt-2"></div>
        </div>

        <input type="hidden" name="total" value="{{ $total }}">

        <button type="submit" class="btn btn-primary w-100 mt-3">
            Pagar MXN ${{ number_format($total, 2) }}
        </button>
    </form>
</div>

{{-- Carga del script de Stripe --}}
<script src="https://js.stripe.com/v3/"></script>
<script>
    // Inicialización de Stripe con tu clave pública
    var stripe = Stripe("{{ config('services.stripe.key') }}");
    var elements = stripe.elements();

    // Estilo del elemento de tarjeta
    var card = elements.create('card', {
        hidePostalCode: true,
        style: {
            base: {
                fontSize: '16px',
                color: '#32325d',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a'
            }
        }
    });

    // Montar el elemento de tarjeta en el div correspondiente
    card.mount('#card-element');

    // Manejo del envío del formulario
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        stripe.createToken(card).then(function(result) {
            if (result.error) {
                // Muestra el error al usuario
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                // Inserta el token en el formulario y envíalo
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', result.token.id);
                form.appendChild(hiddenInput);

                // Envía el formulario
                form.submit();
            }
        });
    });
</script>
@endsection
