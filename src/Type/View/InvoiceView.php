<?php

namespace App\Type\View;

class InvoiceView
{
    public ?float $amount = null;
    public ?PaymentMethodView $paymentMethod = null;
}