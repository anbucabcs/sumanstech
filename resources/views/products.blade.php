@extends('layout.app')

@section('content')
        <div class="container">
          <h2>Products</h2>
            <br>
          <div class="row">          
            @foreach($products as $item)
                <div class="col-md-4">
                    <div style="border:1px solid #333"> 
                    <div> 
                        <b>{{ $item->name}}</b>

                        <!-- <p>{{ $item->description }}</p> -->
                    </div>
                    <div>{{ $item->price}}</div>
                    <a class="btn btn-primary" href="{{ route('product.show', $item->id) }}">Buy Now</a>
                    </div>
                </div>
            @endforeach          
        </div>
        

          
        </div>
@endsection
