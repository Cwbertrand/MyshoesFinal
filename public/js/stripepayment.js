// This is your test publishable API key.
//Here, you put the public key
const stripe = Stripe("pk_test_51K59bPL6hQn7IJZxkj0AYTsWjXlmzOY2twQ5OVyAAEGZmwXCdVwzoWgeUq7IQP5XaKogtQjEsFzfSM9jlgLD6S9V00L92sx80k");

var checkoutButton = document.getElementById("button_pay");
checkoutButton.addEventListener("click", function () {
    fetch("/command/payment", {
        method: "POST",
    })
    .then(function (response) {
        //console.log(response.json())
        return response.json();
    })
    .then(function (session) {
        if(session.error == 'commande'){
            window.location.replace('{{ path("commande")}}');
        }else{
            return stripe.redirectToCheckout({ sessionId: session.id });
        }
    })
    .then(function (result) {
        // If redirectToCheckout fails due to a browser or network
        // error, you should display the localized error message to your
        // customer using error.message.
        if (result.error) {
            alert(result.error.message);
        }
    })
    .catch(function (error) {
        console.error("Error:", error);
    })
});
