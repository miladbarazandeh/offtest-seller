<?php

namespace App\Http\Controllers;

use App\Models\SellerPromotion;
use App\Seller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        /** @var Seller $seller */
        $seller = Auth()->user();
        $data['status'] = $seller->getStatus();
        $data['promotionCount'] = SellerPromotion::getBySellerActivePromotionCount($seller->getId());
        $data['pendingPromotionCount'] = SellerPromotion::getBySellerPendingPromotionCount($seller->getId());
        return view('panel.home', $data);
    }
}
