<?php

function create_stripe_customer( $user_id ){

    $AFZ_Stripe_Payments = new AFZ_Stripe_Payments();
    $user = get_userdata($user_id);
    $customer = $AFZ_Stripe_Payments->stripe_client->customers->create([
        'email' => $user->user_email,
    ]);
    add_user_meta($user_id, 'stripe_customer_id', $customer->id, true);
 
}
add_action( 'user_register', 'create_stripe_customer', 10, 1 );