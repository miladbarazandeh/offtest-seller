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
use Illuminate\Http\JsonResponse;
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

    public function sendVerificationSms()
    {
        /** @var Seller $seller */
        $seller = Auth::user();
        if ($seller->isPhoneVerified()) {
            throw new \Exception('already verified');
        }
        $generatedKey = rand(10000, 99999);
        \Cache::store('file')->set($this->getSmsCacheKey($seller->getId()), $generatedKey, 180);
        $body = View('panel.profile.verification', ['code' => $generatedKey])->render();
        try{
            $api = new \Kavenegar\KavenegarApi( "646D4F564B626248587264375A3058444F354C496A61664967353671374368326E42464C4D2F50464C61633D" );
            $sender = "10004346";
            $receptor = array($seller->getPhone());
            $api->Send($sender,$receptor,$body);

            return new JsonResponse(['message' => 'success']);
        }
        catch(\Kavenegar\Exceptions\ApiException $e){
            return new JsonResponse(['message' => 'error'], 400);
        }
        catch(\Kavenegar\Exceptions\HttpException $e){
            return new JsonResponse(['message' => 'error'], 400);
        } catch (\Exception $exception) {
            return new JsonResponse(['message' => $exception->getMessage()], 400);
        }
    }


//    public function sendVerifySms(Request $request)
//    {
//        $this->validate($request, [
//            'code' => ['required', 'numeric', 'max:255']
//        ]);
//
//        $code = $request->get('code');
//
//        /** @var Seller $seller */
//        $seller = Auth::user();
//        if ($seller->isPhoneVerified()) {
//            throw new \Exception('already verified');
//        }
//        $sellerCode = \Cache::store('file')->get($this->getSmsCacheKey($seller->getId()));
//        \Cache::store('file')->forget($this->getSmsCacheKey($seller->getId()));
//
//        if ($sellerCode == $code) {
//            $seller
//        }
//    }

    private function getSmsCacheKey($sellerId) :string
    {
        return 'sms:verification:'.$sellerId;
    }
}