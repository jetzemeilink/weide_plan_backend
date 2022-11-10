<?php

namespace App\Type\View;

class InvoiceView
{
    public ?int $id = null;
    public ?float $amount = null;
    public ?PaymentMethodView $paymentMethod = null;
}