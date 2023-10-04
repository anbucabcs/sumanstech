@extends('layout.app')

@section('content')
        <div class="container">
          
          <div class="row">
           <h2> {{ $product->name }}        </h2>
            {{ $product->price }}         <br>
            <!-- {{ $product->description }}         <br> -->
        </div>

          
        </div>

        <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    You will be charged ${{ number_format($product->price, 2) }} for {{ $product->name }}
                </div>
  
                <div class="card-body">
  
                    <form id="payment-form" action="{{ route('subscription.create') }}" method="POST">
                        @csrf
                        <input type="hidden" name="plan" id="plan" value="{{ $product->id }}">
  
                        <div class="row">
                            <div class="col-xl-4 col-lg-4">
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" name="name" id="card-holder-name" class="form-control" value="" placeholder="Name on the card">
                                </div>
                            </div>
                        </div>
  
                        <div class="row">
                            <div class="col-xl-4 col-lg-4">
                                <div class="form-group">
                                    <label for="">Card details</label>
                                    <div id="card-element"></div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12">
                            <hr>
                                <button type="submit" class="btn btn-primary" id="card-button" data-secret="{{ $intent->client_secret }}">Purchase</button>
                            </div>
                        </div>
  
                    </form>
  
                </div>
            </div>
        </div>
    </div>
</div>


        <script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe('pk_test_51NQ6b8SJOrLYMYt6HSEu62ge7cUmt1LJQudV1IH4b9CzffIhtXL2Bf4vmzj9ZHFBV0hT5iCv7PJ2qjf7o8kp4jWR00BLe9mXjD'); //Stripe('{{ env('STRIPE_KEY') }}')
  
    const elements = stripe.elements()
    const cardElement = elements.create('card')
  
    cardElement.mount('#card-element')
  
    const form = document.getElementById('payment-form')
    const cardBtn = document.getElementById('card-button')
    const cardHolderName = document.getElementById('card-holder-name')
  
    form.addEventListener('submit', async (e) => {
        e.preventDefault()
  
        cardBtn.disabled = true
        const { setupIntent, error } = await stripe.confirmCardSetup(
            cardBtn.dataset.secret, {
                payment_method: {
                    card: cardElement,
                    billing_details: {
                        name: cardHolderName.value
                    }   
                }
            }
        )
  
        if(error) {
            cardBtn.disable = false
        } else {            
            let token = document.createElement('input')
            token.setAttribute('type', 'hidden')
            token.setAttribute('name', 'token')
            token.setAttribute('value', setupIntent.payment_method)
            form.appendChild(token)
            form.submit();
        }
    })
</script>

@endsection
