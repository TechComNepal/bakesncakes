      <div class="col-lg-4">
          <div class="border p-md-4 cart-totals ml-30">
              <h1 class="heading-2 mb-10">Your Order</h1>
              <div class="table-responsive">
                  <table class="table no-border">
                      <thead>
                          <th>
                              <h5 class="text-heading text-end">Product</h5>
                          </th>
                          <th>
                              <h5 class="text-heading text-end">Total</h5>
                          </th>
                      </thead>


                      <tbody>
                          @php
                              $subtotal = 0;
                              $tax = 0;
                              $shipping = 0;
                              $product_shipping_cost = 0;
                          @endphp
                          @foreach ($carts as $cart)
                              @php
                                  $product = \App\Models\Product::where('id', $cart->product_id)->first();
                                  $subtotal += $cart->price * $cart->quantity;
                                  $tax += $cart->tax * $cart->quantity;
                                  $product_shipping_cost = $cart->shipping_cost;
                                  $shipping += $product_shipping_cost;
                                  $total = $total + ($cart->price + $cart->tax) * $cart->quantity;
                              @endphp
                              <tr>
                                  <td class="cart_total_label">
                                      <h5 class="text-muted">{{ $product->name }} x <span>
                                              {{ $cart->quantity }} </span></h5>
                                  </td>
                                  <td class="cart_total_amount">
                                      <h5 class="text-heading text-end">{{ $cart->price * $cart->quantity }}</h5>
                                  </td>
                              </tr>
                          @endforeach
                          <tr>
                              <td scope="col" colspan="2">
                                  <div class="divider-2 mt-10 mb-10"></div>
                              </td>
                          </tr>
                          <tr>
                              <td class="cart_total_label">
                                  <h6 class="text-muted">Coupon</h6>
                              </td>
                              <td class="cart_total_amount">
                                  <h5 class="text-heading text-end">
                                      <div class="form-check">
                                          <input type="text" name="total" placeholder="Enter Coupon" id="coupon">
                                      </div>

                                      <div class="message form-check">
                                          <span><small id="coupon-message" class=""></small></span>
                                      </div>
                                  </h5>
                              </td>
                          </tr>

                          <tr>
                              <td scope="col" colspan="2">
                                  <div class="divider-2 mt-10 mb-10"></div>
                              </td>
                          </tr>
                          <tr>
                              <td class="cart_total_label" id="coupon_discount">
                                  <h6 class="text-muted">Coupon Discount</h6>
                              </td>
                              <td class="cart_total_amount">
                                  <h5 class="text-heading text-end" id="coupon_charge">

                                  </h5>
                              </td>
                          </tr>
                          <tr>
                              <td scope="col" colspan="2">
                                  <div class="divider-2 mt-10 mb-10"></div>
                              </td>
                          </tr>
                          <tr>
                              <td class="cart_total_label">
                                  <h6 class="text-muted">Subtotal</h6>
                              </td>
                              <td class="cart_total_amount">
                                  <h5 class="text-heading text-end" id="shipping_charge">
                                      {{ $subtotal }}
                                  </h5>
                              </td>
                          </tr>
                          <tr>
                              <td class="cart_total_label">
                                  <h6 class="text-muted">Tax</h6>
                              </td>
                              <td class="cart_total_amount">
                                  <h5 class="text-heading text-end" id="shipping_charge">
                                      {{ $tax }}
                                  </h5>
                              </td>
                          </tr>
                          <tr>
                              <td class="cart_total_label">
                                  <h6 class="text-muted">Total</h6>
                              </td>
                              <td class="cart_total_amount">
                                  <h4 class="text-brand text-end">Rs. {{ $total }}</h4>
                              </td>
                          </tr>
                      </tbody>
                  </table>
              </div>
              @auth
                  <a href="{{ route('user.shipping.info') }}" class="btn mb-20 w-100">Proceed To CheckOut<i
                          class="fi-rs-sign-out ml-15"></i></a>

              @endauth
              @guest
                  <a href="{{ route('auth.login.show') }}" class="btn mb-20 w-100">Login to
                      checkout<i class="fi-rs-sign-out ml-15"></i></a>
              @endguest

          </div>
      </div
