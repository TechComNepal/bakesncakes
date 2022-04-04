<x-new-site-master-layout>
    @push('styles')
        <style>
            .cart-product__color_span a {
                display: inline-block;
                margin: 0 10px 10px 0;
                font-size: 14px;
            }

            .cart-product__color {
                border-radius: 50%;
                width: 25px;
                height: 25px;
            }

        </style>
    @endpush
    <div class="ps-shopping my-5" id="cart-summary">
        @include('site.carts.new_cart_summary')
    </div>

    @push('scripts')
        <script>
            function removeFromCartView(e, key) {
                e.preventDefault();
                removeFromCart(key);
            }

            function updateQuantity(key, element) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('cart.updateQuantity') }}",
                    data: {
                        id: key,
                        quantity: element.value
                    },
                    success: function(data) {
                        $('#cart-summary').html(data.cart_view);
                        updateNavCart(data.nav_cart_view, data.cart_count);
                        //    ***********
                        $('.plus-minus button').on('click', function(e) {
                            e.preventDefault();

                            var fieldName = $(this).attr("data-field");
                            var type = $(this).attr("data-type");
                            var input = $("input[name='" + fieldName + "']");
                            var currentVal = parseInt(input.val());

                            if (!isNaN(currentVal)) {
                                if (type == "minus") {
                                    if (currentVal > input.attr("min")) {
                                        input.val(currentVal - 1).change();
                                    }
                                    if (parseInt(input.val()) == input.attr("min")) {
                                        $(this).attr("disabled", true);
                                    }
                                } else if (type == "plus") {
                                    if (currentVal < input.attr("max")) {
                                        input.val(currentVal + 1).change();
                                    }
                                    if (parseInt(input.val()) == input.attr("max")) {
                                        $(this).attr("disabled", true);
                                    }
                                }
                            } else {
                                input.val(0);
                            }
                        });
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            }
        </script>
    @endpush


</x-new-site-master-layout>
