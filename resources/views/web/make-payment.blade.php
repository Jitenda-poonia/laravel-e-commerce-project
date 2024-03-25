@php

$orderIncrement = Session::get('order_increment');
@endphp

<button style="display: none;" id="rzp-button1">Pay</button>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
var options = {
    "key": "rzp_test_qKEuEXIxZZGb5j", // Enter the Key ID generated from the Dashboard
    "amount": 100050, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
    "currency": "INR",
    "name": "Acme Corp",
    "description": "<?php echo $orderIncrement; ?>",
    // "image": "https://example.com/your_logo",
    // "order_id": "order_MOQ7ibHE96aSAK", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
    "callback_url": "https://eneqd3r9zrjok.x.pipedream.net/",
    // "callback_url": "http://localhost/php-class/js-validation/test.php",
    "prefill": {
        "name": "jitendra",
        "email": "jitendr@gmaila.com",
        "contact": "723026292"
    },
    "notes": {
        "address": "Corporate Office"
    },
    "theme": {
        "color": "#3399cc"
    }
};
var rzp1 = new Razorpay(options);
document.getElementById('rzp-button1').onclick = function(e){
    rzp1.open();
    e.preventDefault();
}
document.getElementById('rzp-button1').click();
</script>
