@extends('layouts.app')

@section('content')
<div class="container"  id="information"  >
<div class="loader" id="loader"></div>
   <div class="row justify-content-center" >

     <div class="container">
       @if (sizeof(Cart::content()) > 0)

                   <table class="table">
                       <thead>
                           <tr>
                               <th class="table-image"></th>
                               <th>Product</th>
                               <th>Quantity</th>
                               <th>Price</th>
                               <th class="column-spacer"></th>
                               <th></th>
                           </tr>
                       </thead>

                       <tbody>
                           @foreach (Cart::content() as $item)
                           <tr>
                               <td class="table-image"><a href="{{ url('shop', [$item->model->slug]) }}"><img src="{{ asset('img/' . $item->model->image) }}" alt="product" class="img-responsive cart-image"></a></td>
                               <td><a href="{{ url('shop', [$item->model->slug]) }}">{{ $item->name }}</a></td>
                               <td>
                                   <select class="quantity" data-id="{{ $item->rowId }}">
                                       <option {{ $item->qty == 1 ? 'selected' : '' }}>1</option>
                                       <option {{ $item->qty == 2 ? 'selected' : '' }}>2</option>
                                       <option {{ $item->qty == 3 ? 'selected' : '' }}>3</option>
                                       <option {{ $item->qty == 4 ? 'selected' : '' }}>4</option>
                                       <option {{ $item->qty == 5 ? 'selected' : '' }}>5</option>
                                   </select>
                               </td>
                               <td>${{ $item->subtotal }}</td>
                               <td class=""></td>
                               <td>
                                   <form action="{{ url('cart', [$item->rowId]) }}" method="POST" class="side-by-side">
                                       {!! csrf_field() !!}
                                       <input type="hidden" name="_method" value="DELETE">
                                       <input type="submit" class="btn btn-danger btn-sm" value="Remove">
                                   </form>

                                   <form action="{{ url('switchToWishlist', [$item->rowId]) }}" method="POST" class="side-by-side">
                                       {!! csrf_field() !!}
                                       <input type="submit" class="btn btn-success btn-sm" value="To Wishlist">
                                   </form>
                               </td>
                           </tr>

                           @endforeach
                           <tr>
                               <td class="table-image"></td>
                               <td></td>
                               <td class="small-caps table-bg" style="text-align: right">Subtotal</td>
                               <td>${{ Cart::instance('default')->subtotal() }}</td>
                               <td></td>
                               <td></td>
                           </tr>
                           <tr>
                               <td class="table-image"></td>
                               <td></td>
                               <td class="small-caps table-bg" style="text-align: right">Tax</td>
                               <td>${{ Cart::instance('default')->tax() }}</td>
                               <td></td>
                               <td></td>
                           </tr>

                           <tr class="border-bottom">
                               <td class="table-image"></td>
                               <td style="padding: 40px;"></td>
                               <td class="small-caps table-bg" style="text-align: right">Your Total</td>
                               <td class="table-bg">${{ Cart::total() }}</td>
                               <td class="column-spacer"></td>
                               <td></td>
                           </tr>

                       </tbody>
                   </table>

                   <a href="{{ url('/shop') }}" class="btn btn-primary btn-lg">Continue Shopping</a> &nbsp;
                   <a href="#" class="btn btn-success btn-lg">Proceed to Checkout</a>

                   <div style="float:right">
                       <form action="{{ url('/emptyCart') }}" method="POST">
                           {!! csrf_field() !!}
                           <input type="hidden" name="_method" value="DELETE">
                           <input type="submit" class="btn btn-danger btn-lg" value="Empty Cart">
                       </form>
                   </div>

               @else

                   <h3>You have no items in your shopping cart</h3>
                   <a href="{{ url('/shop') }}" class="btn btn-primary btn-lg">Continue Shopping</a>

               @endif
      </div>
      <!-- /.row -->

    </div>


       </div>
   </div>

</div>
<br>
<br>
@endsection

@push('scripts')
<script>
document.getElementById("loader").style.display = "none";

</script>
@endpush
