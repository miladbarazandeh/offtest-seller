<?php
/**
 * Created by PhpStorm.
 * User: milad
 * Date: 7/22/20
 * Time: 6:25 PM
 */

namespace App\Http\Controllers;


use App\Seller;
use Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
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

    public function indexAction()
    {
        /** @var Seller $seller */
        $seller = Auth::user();
        return view('panel.profile.indexAction', ['seller' => $seller]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function editAction()
    {
        /** @var Seller $seller */
        $seller = Auth::user();
        return view('panel.profile.editAction', ['seller' => $seller]);
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function editSaveAction(Request $request)
    {
        $this->validateForm($request);
        $phone = $request->get('phone');
        $email = $request->get('email');
        $name = $request->get('name');
        /** @var Seller $seller */
        $seller = Auth::user();

        $data = [
            'name' => $name,
            'email' => $email,
            'phone' => $phone
        ];
        $emailNeedVerification = $seller->getEmail() != $email;

        if ($emailNeedVerification) {
            $data['email_verified_at'] = null;
        }

        $phoneNeedsVerification = $seller->getPhone() != $phone;
        if ($phoneNeedsVerification) {
            $data['phone_verified_at'] = null;
            $data['status'] = Seller::STATUS_NEW;
        }

        $seller->update($data);

        return redirect()->route('panel.profile')->withStatus(__('تغییر یافت.'));
    }

    private function validateForm(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'regex:/(09)[0-9]{9}/', 'max:30'],
            'email' => ['required', 'string', 'email', 'max:255']
        ]);
    }
}