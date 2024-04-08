$(document).ready(function () {

    $('.btn-num-product-up').click(function (e) {
        e.preventDefault();
        var incre_value = $(this).parents('.product_data').find('.qty-input').val();
        var value = parseInt(incre_value, 10);
        value = isNaN(value) ? 0 : value;
        if(value<10){
            value++;
            $(this).parents('.product_data').find('.qty-input').val(value);
        }

    });

    $('.btn-num-product-down').click(function (e) {
        e.preventDefault();
        var decre_value = $(this).parents('.product_data').find('.qty-input').val();
        var value = parseInt(decre_value, 10);
        value = isNaN(value) ? 0 : value;
        if(value>1){
            value--;
            $(this).parents('.product_data').find('.qty-input').val(value);
        }
    });

    $(document).on('click','.updateQty',function() {
        // alert('update');
        var qty = $(this).closest('.product_data').find('.qty-input').val();
        var prod_id = $(this).closest('.product_data').find('.prod_id').val();

            $.ajax({
                method: "POST",
                url: "updateQty.php",
                data: { "prod_id": prod_id,
                        "quantity": qty,
                        "scope": "update"
                    },
                success: function (response) {
                    // alert(response);
                    // $("#sTotal").html(response);
            }

        });

    });

    $(document).on('change','#input-qty', function() {
        // alert('update');
        var qty = $(this).closest('.product_data').find('.qty-input').val();
        var prod_id = $(this).closest('.product_data').find('.prod_id').val();

            $.ajax({
                method: "POST",
                url: "updateQty.php",
                data: { "prod_id": prod_id,
                        "quantity": qty,
                        "scope": "update"
                    },
                success: function (response) {
                    // alert(response);
                    // $("#sTotal").html(response);
            }
        });
    });
});
