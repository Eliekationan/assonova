<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class PaymentController extends Controller
{
    //
    public function initiate(){
        return Inertia::render("Cotisation/PayDonation");
    }
}
