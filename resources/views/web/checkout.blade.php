 @extends('layouts.web')

 @section('content')
     <!-- Breadcrumb Start -->
     <div class="container-fluid">
         <div class="row px-xl-5">
             <div class="col-12">
                 <nav class="breadcrumb bg-light mb-30">
                     <a class="breadcrumb-item text-dark" href="{{ '/' }}">Home</a>
                     <span class="breadcrumb-item active">Cart</span>
                     <span class="breadcrumb-item active">Checkout</span>
                 </nav>
             </div>
         </div>
     </div>
     <!-- Breadcrumb End -->

     <!-- Checkout Start -->

     <div class="container-fluid">
         <form action="{{ route('checkout.store') }}" method="POST">
             @csrf
             <div class="row px-xl-5">
                 <div class="col-lg-8">
                     <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Billing
                             Address</span></h5>
                     <div class="bg-light p-30 mb-5">
                         <div class="row">
                             <div class="col-md-6 form-group">
                                 <label>Name</label>
                                 <input class="form-control" type="text" name="billing_name" placeholder="Name"
                                     value="{{ old('billing_name') }}">
                                 @error('billing_name')
                                     <p class="text-danger">{{ $message }}</p>
                                 @enderror
                             </div>
                             <div class="col-md-6 form-group">
                                 <label>E-mail</label>
                                 <input class="form-control" type="text" name="billing_email"
                                     placeholder="example@email.com" value="{{ old('billing_email') }}">
                                 @error('billing_email')
                                     <p class="text-danger">{{ $message }}</p>
                                 @enderror
                             </div>
                             <div class="col-md-6 form-group">
                                 <label>Mobile No</label>
                                 <input class="form-control" type="tel" name="billing_phone" placeholder="+123 456 789"
                                     value="{{ old('billing_phone') }}">
                                 @error('billing_phone')
                                     <p class="text-danger">{{ $message }}</p>
                                 @enderror
                             </div>
                             <div class="col-md-6 form-group">
                                 <label>Address Line 1</label>
                                 <input class="form-control" type="text" name="billing_address" placeholder="123 Street"
                                     value="{{ old('billing_address') }}">
                                 @error('billing_address')
                                     <p class="text-danger">{{ $message }}</p>
                                 @enderror
                             </div>
                             <div class="col-md-6 form-group">
                                 <label>Address Line 2</label>
                                 <input class="form-control" type="text" name="billing_address_2"
                                     placeholder="123 Street" value="{{ old('billing_address_2') }}">
                                 @error('billing_address_2')
                                     <p class="text-danger">{{ $message }}</p>
                                 @enderror
                             </div>
                             <div class="col-md-6 form-group">
                                 <label>Country</label>
                                 <select class="custom-select" name="billing_country">
                                     <option selected>United States</option>
                                     <option>Afghanistan</option>
                                     <option>Albania</option>
                                     <option>Algeria</option>
                                 </select>
                             </div>
                             <div class="col-md-6 form-group">
                                 <label>City</label>
                                 <input class="form-control" type="text" name="billing_city" placeholder="Churu"
                                     value="{{ old('billing_city') }}">
                                 @error('billing_city')
                                     <p class="text-danger">{{ $message }}</p>
                                 @enderror
                             </div>
                             <div class="col-md-6 form-group">
                                 <label>State</label>
                                 <input class="form-control" type="text" name="billing_state" placeholder="New York"
                                     value="{{ old('billing_state') }}">
                                 @error('billing_state')
                                     <p class="text-danger">{{ $message }}</p>
                                 @enderror
                             </div>
                             <div class="col-md-6 form-group">
                                 <label>Pin Code</label>
                                 <input class="form-control" type="number" name="billing_pincode" placeholder="123456"
                                     min="100000" max="999999" value="{{ old('billing_pincode') }}">
                                 @error('billing_pincode')
                                     <p class="text-danger">{{ $message }}</p>
                                 @enderror
                             </div>

                             <div class="col-md-12 form-group">
                                 <div class="custom-control custom-checkbox">
                                     <input type="checkbox" class="custom-control-input" id="newaccount">
                                     <label class="custom-control-label" for="newaccount">Create an account</label>
                                 </div>
                             </div>
                             <div class="col-md-12">
                                 <div class="custom-control custom-checkbox">
                                     <input type="checkbox" name="ship_to_different_address" class="custom-control-input"
                                         id="shipto">
                                     <label class="custom-control-label" for="shipto" data-toggle="collapse"
                                         data-target="#shipping-address">Ship to different address</label>

                                 </div>
                             </div>
                         </div>
                     </div>


                     <div class="collapse mb-5" id="shipping-address">
                         <h5 class="section-title position-relative text-uppercase mb-3"><span
                                 class="bg-secondary pr-3">Shipping Address</span></h5>
                         <div class="bg-light p-30">
                             <div class="row">
                                 <div class="col-md-6 form-group">
                                     <label>First Name</label>
                                     <input class="form-control" type="text" name="shipping_name" placeholder="Name"
                                         value="{{ old('shipping_name') }}">
                                     @error('shipping_name')
                                         <p class="text-danger">{{ $message }}</p>
                                     @enderror
                                 </div>

                                 <div class="col-md-6 form-group">
                                     <label>E-mail</label>
                                     <input class="form-control" type="text" name="shipping_email"
                                         value="{{ old('shipping_email') }}" placeholder="example@email.com">
                                     @error('shipping_email')
                                         <p class="text-danger">{{ $message }}</p>
                                     @enderror
                                 </div>
                                 <div class="col-md-6 form-group">
                                     <label>Mobile No</label>
                                     <input class="form-control" type="tel" name="shipping_phone"
                                         value="{{ old('shipping_phone') }}" placeholder="+123 456 789">
                                     @error('shipping_phone')
                                         <p class="text-danger">{{ $message }}</p>
                                     @enderror
                                 </div>
                                 <div class="col-md-6 form-group">
                                     <label>Address Line 1</label>
                                     <input class="form-control" type="text" name="shipping_address"
                                         value="{{ old('shipping_address') }}" placeholder="123 Street">
                                     @error('shipping_address')
                                         <p class="text-danger">{{ $message }}</p>
                                     @enderror
                                 </div>
                                 <div class="col-md-6 form-group">
                                     <label>Address Line 2</label>
                                     <input class="form-control" type="text" name="shipping_address_2"
                                         value="{{ old('shipping_address2') }}" placeholder="123 Street">
                                     @error('shipping_address_2')
                                         <p class="text-danger">{{ $message }}</p>
                                     @enderror
                                 </div>
                                 <div class="col-md-6 form-group">
                                     <label>Country</label>
                                     <select class="custom-select" name="shipping_country">
                                         <option selected>United States</option>
                                         <option>Afghanistan</option>
                                         <option>Albania</option>
                                         <option>Algeria</option>
                                     </select>
                                 </div>
                                 <div class="col-md-6 form-group">
                                     <label>City</label>
                                     <input class="form-control" type="text" name="shipping_city" placeholder="Churu"
                                         value="{{ old('shipping_city') }}">
                                     @error('shipping_city')
                                         <p class="text-danger">{{ $message }}</p>
                                     @enderror
                                 </div>
                                 <div class="col-md-6 form-group">
                                     <label>State</label>
                                     <input class="form-control" type="text" name="shipping_state"
                                         placeholder="rajasthan" value="{{ old('shipping_state') }}">
                                     @error('shipping_state')
                                         <p class="text-danger">{{ $message }}</p>
                                     @enderror
                                 </div>
                                 <div class="col-md-6 form-group">
                                     <label>Pin Code</label>
                                     <input class="form-control" type="number" name="shipping_pincode" min="100000"
                                         max="999999" placeholder="123456" value="{{ old('shipping_pincode') }}">
                                     @error('shipping_pincode')
                                         <p class="text-danger">{{ $message }}</p>
                                     @enderror
                                 </div>

                             </div>
                         </div>
                     </div>

                     {{-- spping method start --}}
                     <div class="mb-5">
                         <h5 class="section-title position-relative text-uppercase mb-3"><span
                                 class="bg-secondary pr-3">Shipping Method</span></h5>
                         <div class="bg-light p-30">
                             <div class="form-group">
                                 <div class="custom-control custom-radio">
                                     <input type="radio" class="custom-control-input" name="shipping_method"
                                         value="standard_delivery" id="standard_delivery" data-cost="0.00">
                                     <label class="custom-control-label" for="standard_delivery">Standard Delivery
                                         (Free)</label>
                                 </div>
                             </div>
                             <div class="form-group">
                                 <div class="custom-control custom-radio">
                                     <input type="radio" class="custom-control-input" name="shipping_method"
                                         value="express_delivery" id="express_delivery" data-cost="50">
                                     <label class="custom-control-label" for="express_delivery">Express Delivery
                                         (₹50)</label>
                                 </div>
                             </div>
                             <div class="form-group mb-4">
                                 <div class="custom-control custom-radio">
                                     <input type="radio" class="custom-control-input" name="shipping_method"
                                         value="next_business_day" id="next_business_day" data-cost="100">
                                     <label class="custom-control-label" for="next_business_day">Next Business day
                                         (₹100)</label>
                                 </div>
                             </div>
                         </div>
                     </div>
                     {{-- spping method end  --}}
                     
                 </div>
                 <div class="col-lg-4">
                     <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Order
                             Total</span></h5>
                     <div class="bg-light p-30 mb-5">
                         <div class="border-bottom">
                             <h6 class="mb-3">Products</h6>
                             @foreach ($quote->items as $item)
                                 <div class="d-flex justify-content-between">
                                     <p>{{ $item->name }}</p>
                                     <p>₹ {{ $item->row_total }}</p>
                                 </div>
                             @endforeach


                             <div class="border-bottom pt-3 pb-2">
                                 <div class="d-flex justify-content-between mb-3">
                                     <h6>Subtotal</h6>
                                     <h6>{{ $quote->subtotal }}</h6>
                                 </div>
                                 <div class="d-flex justify-content-between">
                                     <h6 class="font-weight-medium">Discount</h6>
                                     <h6 class="font-weight-medium">-₹{{ $quote->coupon_discount ?? 0.00 }}</h6>
                                 </div>
                                 <div class="d-flex justify-content-between">
                                     <h6 class="font-weight-medium">Shipping</h6>
                                     <h6 class="font-weight-medium shipping_cost_sdd">+₹0.00</h6>

                                 </div>
                             </div>
                             <div class="pt-2">
                                 <div class="d-flex justify-content-between mt-2">
                                     <h5>Total</h5>
                                     <h5 class="total_amount">₹ {{ $quote->total }}</h5>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="mb-5">
                         <h5 class="section-title position-relative text-uppercase mb-3"><span
                                 class="bg-secondary pr-3">Payment</span></h5>
                         <div class="bg-light p-30">
                             <div class="form-group">
                                 <div class="custom-control custom-radio">
                                     <input type="radio" class="custom-control-input" name="payment" value="paypal"
                                         id="paypal">
                                     <label class="custom-control-label" for="paypal">Paypal</label>
                                 </div>
                             </div>
                             <div class="form-group">
                                 <div class="custom-control custom-radio">
                                     <input type="radio" class="custom-control-input" name="payment"
                                         value="direct_check" id="directcheck">
                                     <label class="custom-control-label" for="directcheck">Direct Check</label>
                                 </div>
                             </div>
                             <div class="form-group mb-4">
                                 <div class="custom-control custom-radio">
                                     <input type="radio" class="custom-control-input" name="payment" id="banktransfer"
                                         value="bank_transfer">
                                     <label class="custom-control-label" for="banktransfer">Bank Transfer</label>
                                 </div>
                             </div>
                             @error('payment')
                                 <p class="text-danger">{{ $message }}</p>
                             @enderror
                             <button type="submit" class="btn btn-block btn-primary font-weight-bold py-3">Place
                                 Order</button>
                         </div>

                     </div>
                 </div>
             </div>
         </form>


     </div>

     <!-- Checkout End -->
     <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

     <script>
        $('input[name="shipping_method"]').change(function() {
             const cost = parseInt($(this).data('cost'));

             $('.shipping_cost_sdd').text('₹ ' + cost);

             var amount = parseFloat($('.total_amount').text().replace('₹ ', ''));

             var total = amount + cost;

             $('.total_amount').text('₹ ' + total);

             // alert('New Total Amount: ₹' + total);
         });
     </script>
     
 @endsection
