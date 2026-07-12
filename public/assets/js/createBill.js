$(document).ready(function () {

    // Product selection
    $('#selectProduct').on('change', function () {

        let html = '';

        $('#selectProduct option:selected').each(function () {

            let id = $(this).val();
            let name = $(this).data('name');
            let price = parseFloat($(this).data('price')) || 0;
            let productQty = parseInt($(this).data('qty')) || 1;
            let subtotal = parseInt($(this).data('subtotal')) || 0;

            html += `
                <div class="card mb-2 p-3">
                    <div class="row align-items-center">

                        <div class="col-md-4">
                            <strong>${name}</strong>
                            <input type="hidden" name="selected_products[]" value="${id}">
                        </div>

                        <div class="col-md-3">
                            ₹ ${price.toFixed(2)}
                            <input type="hidden" name="price[${id}]" value="${price}">
                        </div>

                        <div class="col-md-3">
                            <input
                                type="number"
                                class="form-control qty"
                                name="qty[${id}]"
                                value="1"
                                min="1"
                                max="${productQty}"
                                data-price="${price}"
                            >
                        </div>

                        <div class="col-md-1 text-center">
                            <button
                                type="button"
                                class="btn btn-sm remove-product"
                                data-id="${id}"
                                title="Remove Product">
                                ✖
                            </button>
                        </div>

                    </div>
                </div>
            `;
        });

        $('#selectedProducts').html(html);

        calculateTotal();
    });

    // Quantity change
    $(document).on('input', '.qty', function () {

        let max = parseInt($(this).attr('max'));
        let min = parseInt($(this).attr('min'));
        let value = parseInt($(this).val()) || min;

        if (value > max) {
            value = max;
        }

        if (value < min) {
            value = min;
        }

        $(this).val(value);

        calculateTotal();
    });

    // Discount & GST change
    $('#discount, #productGst').on('input', function () {
        calculateTotal();
    });

});

// function calculateTotal() {

//     let subtotal = 0;

//     // Calculate subtotal
//     $('.qty').each(function () {

//         let qty = parseFloat($(this).val()) || 0;
//         let price = parseFloat($(this).data('price')) || 0;

//         subtotal += qty * price;
//     });

//     // Get discount and GST percentages
//     let discountPercent = parseFloat($('#discount').val()) || 0;
//     let gstPercent = parseFloat($('#productGst').val()) || 0;

//     // Calculate discount amount
//     let discountAmount = (subtotal * discountPercent) / 100;

//     // Amount after discount
//     let amountAfterDiscount = subtotal - discountAmount;

//     // Calculate GST on discounted amount
//     let gstAmount = (amountAfterDiscount * gstPercent) / 100;

//     // Final total
//     let finalTotal = amountAfterDiscount + gstAmount;

//     $('#totalPrice').val(finalTotal.toFixed(2));
// }

function calculateTotal() {

    let subtotal = 0;

    // Calculate subtotal (Price × Qty)
    $('.qty').each(function () {

        let qty = parseFloat($(this).val()) || 0;
        let price = parseFloat($(this).data('price')) || 0;

        subtotal += qty * price;
    });

    // Show subtotal
    $('#subTotal').val(subtotal.toFixed(2));

    // Get discount & GST percentage
    let discountPercent = parseFloat($('#discount').val()) || 0;
    let gstPercent = parseFloat($('#productGst').val()) || 0;

    // Discount amount
    let discountAmount = (subtotal * discountPercent) / 100;

    // Amount after discount
    let amountAfterDiscount = subtotal - discountAmount;

    // GST amount
    let gstAmount = (amountAfterDiscount * gstPercent) / 100;

    // Grand total
    let finalTotal = amountAfterDiscount + gstAmount;

    $('#totalPrice').val(finalTotal.toFixed(2));
}


// Remove selected product
$(document).on('click', '.remove-product', function () {

    let id = $(this).data('id');

    $('#selectProduct option[value="' + id + '"]').prop('selected', false);

    $('.product-card[data-id="' + id + '"]').remove();

    $('#selectProduct').trigger('change');

    // Recalculate total
    calculateTotal();
});