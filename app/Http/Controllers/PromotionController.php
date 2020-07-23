<?php
/**
 * Created by PhpStorm.
 * User: milad
 * Date: 7/22/20
 * Time: 6:25 PM
 */

namespace App\Http\Controllers;


use App\Models\SellerPromotion;
use App\Seller;
use Auth;
use Illuminate\Http\Request;
use DateTime;

class PromotionController extends Controller
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

    public function indexAction(Request $request)
    {
        /** @var Seller $seller */
        $seller = Auth::user();
        $currentPage = $request->get('page', 1);
        $promotions = SellerPromotion::getBySellerId($seller->getId(), $currentPage);
        return view('panel.promotions.indexAction', ['promotions' => $promotions]);
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function editAction(int $id = 0)
    {
        $promotion = SellerPromotion::getById($id);
        $sellerId = Auth::user()->getId();
        if ($id && $promotion->getSellerId() != $sellerId) {
            throw new \Exception("Not found");
        }
//        dd($promotion);
        return view('panel.promotions.itemAction', ['promotion' => $promotion]);
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function editSaveAction(Request $request)
    {
        $this->validateForm($request);
        $seller = Auth::user();
        $id = $request->get('id');
        $title = $request->get('title');
        $fullPrice = $request->get('full_price');
        $testerPrice = $request->get('tester_price');
        $url = $request->get('url');
        $productCount = $request->get('available_product_count');
        $minimumUserPoint = $request->get('minimum_user_experience');
        $startAt = new DateTime('@'.$request->get('timpestamp-start_at'), new \DateTimeZone('Asia/Tehran'));
        $endAt = new DateTime('@'.$request->get('timpestamp-end_at'));
        $endAt->setTimezone(new \DateTimeZone('Asia/Tehran'));
        $startAt->setTimezone(new \DateTimeZone('Asia/Tehran'));

        $data = [
            'title' => $title,
            'url' => $url,
            'full_price' => $fullPrice,
            'tester_price' => $testerPrice,
            'available_product_count' => $productCount,
            'minimum_user_experience' => $minimumUserPoint,
            'start_at' => $startAt,
            'end_at' => $endAt,
            'seller_id' => $seller->getId()
        ];


        if ($id) {
            $promotion = SellerPromotion::getById($id);
            if ($seller->getId() != $promotion->getSellerId()) {
                throw new \Exception("Not found");
            } else {
                $promotion->update($data);
            }
        } else {
            $promotion = new SellerPromotion($data);
            $promotion->save();
        }

        return back()->withStatus(__('تغییر یافت.'));
    }

    private function validateForm(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:100',
            'url' => 'required|max:100|url',
            'full_price' => 'required|integer|min:0',
            'tester_price' => 'required|integer|min:0',
            'available_product_count' => 'required|integer|min:0',
            'minimum_user_experience' => 'required|integer|min:0',
            'timpestamp-start_at' => 'required|integer|min:0',
            'timpestamp-end_at' => 'required|integer|min:0',
            'image' => 'file|size:2048'
        ]);
    }
}