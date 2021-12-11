@extends('layouts.app_stats')
@section('content')
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left" style="padding-top:2rem;">
                    <div class="auth-logo" style="margin-bottom:2rem;">
                        <a href="{{url('/plans')}}"><img src="{{asset('assets/images/logo/logo.png')}}" alt="Logo"></a>
                    </div>
                    <h1 class="auth-title">Checkout.</h1>
                    <p class="auth-subtitle mb-5">You will be charged {{ number_format($plan->cost) }} XAF for {{ $plan->name }} Plan.</p>

                    <form action="{{ route('subscription.create') }}" method="post" id="payment-form">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <label for="card-element">
                                Enter your credit card information
                            </label>
                        </div>
                        <input type="hidden" name="plan" value="{{ $plan->id }}" />

                        <div class="form-group position-relative has-icon-left mb-4">
                            <label for="">Name</label>
                            <input type="text" name="name" id="card-holder-name" class="form-control form-control-xl" value="" placeholder="Name on the card">
                        </div>

                        <div class="form-group position-relative has-icon-left mb-4">
                            <label for="">Card details</label>
                            <div id="card-element"></div>
                        </div>
                        <button
                            id="card-button"
                            class="btn btn-primary btn-block btn-lg shadow-lg mt-5"
                            type="submit"
                            data-secret="{{ $intent->client_secret }}"
                        > Pay </button>
                    </form>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">
                </div>
            </div>
        </div>

    </div>
    <script>
        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
            base: {
                color: '#32325d',
                lineHeight: '18px',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };

        const stripe = Stripe('{{ env("STRIPE_KEY") }}', { locale: 'en' }); // Create a Stripe client.
        const elements = stripe.elements(); // Create an instance of Elements.
        const cardElement = elements.create('card', { style: style }); // Create an instance of the card Element.
        const cardButton = document.getElementById('card-button');
        const clientSecret = cardButton.dataset.secret;

        cardElement.mount('#card-element'); // Add an instance of the card Element into the `card-element` <div>.

        // Handle real-time validation errors from the card Element.
        cardElement.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Handle form submission.
        var form = document.getElementById('payment-form');

        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe
                .handleCardSetup(clientSecret, cardElement, {
                    payment_method_data: {
                        //billing_details: { name: cardHolderName.value }
                    }
                })
                .then(function(result) {
                    console.log(result);
                    if (result.error) {
                        // Inform the user if there was an error.
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                    } else {
                        console.log(result);
                        // Send the token to your server.
                        stripeTokenHandler(result.setupIntent.payment_method);
                    }
                });
        });

        // Submit the form with the token ID.
        function stripeTokenHandler(paymentMethod) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'paymentMethod');
            hiddenInput.setAttribute('value', paymentMethod);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
        }
    </script>
@endsection

