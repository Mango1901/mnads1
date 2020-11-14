<?php
/**
 * Description  : Api process
 * Created by   : Thangnv
 * Created date : 2020/08/19
 * -----------------------
 * Description update  :
 * Update by           :
 * Update date         :
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\Controller;
//use JWTAuth;
use http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Calllog;
use App\Chatfblog;
use App\Chatzalolog;
use App\Contactlog;
use App\Maplog;
use App\Users;
use Carbon\Carbon;
use App\Call;
use App\ChatFaceBook;
use App\ChatZalo;
use App\Contact;
use App\Maps;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use DateTime;
require 'vendor/autoload.php';
class ApiController extends Controller
{
    private $respon;
    protected $user;

    public function __construct(){
        $this->respon = array(
            'status' => false,
            'message' => '',
            'data' => (object)[]
        );
    }


    /**
     * API add call
     * Created by   : Thangnv
     * Created date : 2020/08/19
     *
     * @param    Request $request
     * @return      json
     */
    public function calllog(Request $request) {

        $requestData = $request->all();
        $this->respon['error_type'] = 0;
        //
        $message     = array(
            'token.required'         => __('api.token_required'),
            'call_id.required'        => __('api.call_id_required'),
            'ip.required'    => __('api.ip_required'),
            'location.required'     => __('api.location_required'),
        );
        $rule = [
            'token'          => 'required',
            'call_id'         => 'required',
            'ip'     => 'required',
            'location'     => 'required',
        ];
        $validator = Validator::make($requestData, $rule,$message);
        //
        if ($validator->fails()) {
            $this->respon['message'] = $validator->errors()->first();
            return response()->json($this->respon,400);
        }else {
            //
            $user = Users::where('token', $request->input('token'))->first();
            //
            if ($user) {
                $data = [
                    'user_id' => $user->id,
                    'call_id' => $request->input('call_id'),
                    'ip' => $request->input('ip'),
                    'location' => $request->input('location')
                ];
                //
                $check_call_id = Call::where('id',$data['call_id'])->first();
                if($check_call_id){
                    $call = Calllog::create($data);
                    if ($call) {
                        $this->respon['status'] = true;
                        $this->respon['message'] = __('api.success');
                        $this->respon['data'] = $call;
                        $this->respon['error_type'] = 1;
                    } else {
                        $this->respon['message'] = __('api.error');
                    }
                }else{
                    return response()->json([
                        'code'=>'400',
                        'message'=>"undefined call id",
                        'data'=>(object)[],
                        'error_type'=>0
                    ],400);
                }
            } else {
                return response()->json(
                    [
                        'status' => 'false',
                        'message' => 'this token is not correct!!',
                        'data'=>(object)[],
                        'error_type'=>0
                    ], 400);
            }
        }
        return response()->json($this->respon);
    }

    public function chatfblog(Request $request)
    {

        $requestData = $request->all();
        $this->respon['error_type'] = 0;
        //
        $message = array(
            'token.required' => __('api.token_required'),
            'facebook_id.required' => __('api.facebook_id_required'),
            'ip.required' => __('api.ip_required'),
            'location.required' => __('api.location_required'),
        );
        $rule = [
            'token' => 'required',
            'facebook_id' => 'required',
            'ip' => 'required',
            'location' => 'required',
        ];
        $validator = Validator::make($requestData, $rule, $message);
        //
        if ($validator->fails()) {
            $this->respon['message'] = $validator->errors()->first();
            return response()->json($this->respon,400);
        } else {
            //
            $user = Users::where('token', $request->input('token'))->first();
            //
            if ($user) {
                $data = [
                    'user_id' => $user->id,
                    'facebook_id' => $request->input('facebook_id'),
                    'ip' => $request->input('ip'),
                    'location' => $request->input('location')
                ];
                $check_facebook_log = ChatFaceBook::where('id',$data['facebook_id'])->first();
                if($check_facebook_log){
                    $cfb = Chatfblog::create($data);
                    if ($cfb) {
                        $this->respon['status'] = true;
                        $this->respon['message'] = __('api.success');
                        $this->respon['data'] = $cfb;
                        $this->respon['error_type'] = 1;
                    } else {
                        $this->respon['message'] = __('api.error');
                    }
                }else{
                    return response()->json([
                        'status'=>false,
                        'message'=>'your input facebook_id is not correct',
                        'data'=>(object)[],
                        'error_type'=>0
                    ],400);
                }
            } else {
                return response()->json([
                    'status'=>false,
                    'message'=>'your input token is not correct',
                    'data'=>(object)[],
                    'error_type'=>0
                ],400);
            }
        }
        return response()->json($this->respon);
    }

    public function chatzalolog(Request $request) {

        $requestData = $request->all();
        $this->respon['error_type'] = 0;
        //
        $message     = array(
            'token.required'         => __('api.token_required'),
            'zalo_id.required'        => __('api.zalo_id_required'),
            'ip.required'    => __('api.ip_required'),
            'location.required'     => __('api.location_required'),
        );
        $rule = [
            'token'          => 'required',
            'zalo_id'         => 'required',
            'ip'     => 'required',
            'location'     => 'required',
        ];
        $validator = Validator::make($requestData, $rule,$message);
        //
        if ($validator->fails()) {
            $this->respon['message'] = $validator->errors()->first();
            return response()->json($this->respon);
        }else{
            //
            $user = Users::where('token', $request->input('token'))->first();
            //
            if ($user) {
                $data = [
                    'user_id'      => $user->id,
                    'zalo_id'     => $request->input('zalo_id'),
                    'ip'  => $request->input('ip'),
                    'location'   => $request->input('location')
                ];
                $check_zalo_id = ChatZalo::where('id',$data['zalo_id'])->first();
                //
                if($check_zalo_id){
                    $czl = Chatzalolog::create($data);
                    //
                    if($czl){
                        $this->respon['status']   = true;
                        $this->respon['message']  = __('api.success');
                        $this->respon['data']     = $czl;
                        $this->respon['error_type'] = 1;
                    } else {
                        $this->respon['message']  = __('api.error');
                    }
                }else{
                    return response()->json([
                        'code'=>400,
                        'message'=>'Your input zalo id is not correct',
                        'data'=>(object)[]
                    ],400);
                }
            }else{
                return response()->json([
                    'code'=>'400',
                    'message'=>'Your input token is not correct',
                    'data'=>(object)[]
                ],400);
            }
        }

        return response()->json($this->respon);

    }

    public function contactlog(Request $request)
    {

        $requestData = $request->all();
        $this->respon['error_type'] = 0;
        //
        $message = array(
            'token.required' => __('api.token_required'),
            'lienhe_id.required' => __('api.lienhe_id_required'),
            'ip.required' => __('api.ip_required'),
            'location.required' => __('api.location_required'),
            'mobile.required' => __('api.mobile_required'),
            'description.required' => __('api.description_required')
        );
        $rule = [
            'token' => 'required',
            'lienhe_id' => 'required',
            'ip' => 'required',
            'location' => 'required',
            'mobile' => 'required',
            'description' => 'required',
        ];
        $validator = Validator::make($requestData, $rule, $message);
        //
        if ($validator->fails()) {
            $this->respon['message'] = $validator->errors()->first();
            return response()->json($this->respon);
        } else {
            //
            $user = Users::where('token', $request->input('token'))->first();
            //
            if ($user) {
                $data = [
                    'user_id' => $user->id,
                    'lienhe_id' => $request->input('lienhe_id'),
                    'ip' => $request->input('ip'),
                    'location' => $request->input('location'),
                    'mobile' => $request->input('mobile'),
                    'description' => $request->input('description')
                ];
                $check_contact_id = Contact::where('id',$data['lienhe_id'])->first();
                if($check_contact_id){
                    //
                    $contact = Contactlog::create($data);
                    //
                    if ($contact) {
                        $this->respon['status'] = true;
                        $this->respon['message'] = __('api.success');
                        $this->respon['data'] = $contact;
                        $this->respon['error_type'] = 1;
                    } else {
                        $this->respon['message'] = __('api.error');
                    }
                } else{
                    return response()->json([
                        'code' => 400,
                        'message' => 'Your input lien he id is not correct',
                        'data' => (object)[]
                    ], 400);
                }
                }else{
                    return response()->json([
                        'code'=>'400',
                        'message'=>'Your input token is not correct',
                        'data'=>(object)[]
                    ],400);
                }
    }
        return response()->json($this->respon);
    }
    public function maplog(Request $request) {

        $requestData = $request->all();
        $this->respon['error_type'] = 0;
        //
        $message     = array(
            'token.required'         => __('api.token_required'),
            'map_id.required'        => __('api.map_id_required'),
            'ip.required'    => __('api.ip_required'),
            'location.required'     => __('api.location_required'),
        );
        $rule = [
            'token'          => 'required',
            'map_id'         => 'required',
            'ip'     => 'required',
            'location'     => 'required',
        ];
        $validator = Validator::make($requestData, $rule,$message);
        //
        if ($validator->fails()) {
            $this->respon['message'] = $validator->errors()->first();
            return response()->json($this->respon);
        }else{
            //
            $user = Users::where('token', $request->input('token'))->first();
            //
            if($user){
                $data = [
                    'user_id'      => $user->id,
                    'map_id'     => $request->input('map_id'),
                    'ip'  => $request->input('ip'),
                    'location'   => $request->input('location')
                ];
                $check_map_id = Maps::where('id',$data['map_id'])->first();
                if($check_map_id){
                    //
                    $map = Maplog::create($data);
                    //
                    if($map){
                        $this->respon['status']   = true;
                        $this->respon['message']  = __('api.success');
                        $this->respon['data']     = $map;
                        $this->respon['error_type'] = 1;
                    } else {
                        $this->respon['message']  = __('api.error');
                    }
                }else{
                    return response()->json([
                        'code'=>400,
                        'message'=>'Your input map_id is not correct',
                        'data'=>(object)[]
                    ],400);
                }
            }else{
                return response()->json([
                    'code'=>'400',
                    'message'=>'Your input token is not correct',
                    'data'=>(object)[]
                ],400);
            }
        }
        return response()->json($this->respon);
    }
    public  function chart(Request $request){
//        $requestData=$request->all();
//        $user_id=Auth::id();
//        $facelog=Chatfblog::where('token',$request->input('token'))->first();
//        $data=[
//            'id'=>$facelog->id,
//            'user_id'=>$facelog->user_id,
//            'facebook_id'=>$facelog->facebook_id,
//            'ip'=>$facelog->ip,
//            'location'=>$facelog->location,
//            'created_at'=>$facelog->created_at,
//        ];
        function validateDate($date, $format = 'Y-m-d')
        {
            $d = DateTime::createFromFormat($format, $date);
            // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
            return $d && $d->format($format) === $date;
        }
        $requestData=$request->all();
        $zalolog=[];
        $contactlog=[];
        $maplog=[];
        $calllog=[];
        $fblog=[];
        $carbon = now();
        $now = $carbon->toDateString();
        if(isset($requestData['date1']) && isset($requestData['date2'])){
            $date1=validateDate($requestData['date1']);
            $date2=validateDate($requestData['date2']);
            if($date1 == true && $date2 == true){
                $date1=($requestData['date1']);
                $date2=($requestData['date2']);
                if ($requestData['date1'] == $requestData['date2']) {
                    $zalolog = DB::select("select  (`created_at`) , count(`id`) as count from chatzalo_log where date (`created_at`)=date ('$date1')  group by hour (`created_at`)");
                    $contactlog = DB::select("select (`created_at`), count(`id`) as count from lienhe_log where date (`created_at`)=date ('$date1')  group by  hour (`created_at`)");
                    $maplog = DB::select("select (`created_at`) , count(`id`) as count from maps_log where date (`created_at`)=date ('$date1')  group by  hour (`created_at`)");
                    $calllog = DB::select("select (`created_at`) , count(`id`) as count from call_log where date (`created_at`)=date ('$date1')  group by  hour (`created_at`)");
                    $fblog = DB::select("select (`created_at`) , count(`id`) as count from chatfb_log where date (`created_at`)=date ('$date1')  group by  hour (`created_at`)");
                    $data = [
                        'zalolog' => $zalolog,
                        'contactlog' => $contactlog,
                        'maplog' => $maplog,
                        'fblog' => $fblog,
                        'calllog' => $calllog,
                        'date_format' => 'hours'
                    ];
                } else if($requestData['date1'] < $requestData['date2']) {
                    $zalolog = DB::select("select DATE(created_at) as created_at, count(`id`) as count from chatzalo_log where date(`created_at`)>=date('$date1') AND date(`created_at`) <=date ('$date2') group by DATE_FORMAT(`created_at`, '%Y-%m-%d')");
                    $contactlog = DB::select("select DATE(created_at) as created_at, count(`id`) as count from lienhe_log where date(`created_at`)>=date('$date1') AND date(`created_at`) <=date ('$date2')  group by DATE_FORMAT(`created_at`, '%Y-%m-%d')");
                    $maplog = DB::select("select DATE(created_at) as created_at, count(`id`) as count from maps_log where date(`created_at`)>=date('$date1') AND date(`created_at`) <=date ('$date2')  group by DATE_FORMAT(`created_at`, '%Y-%m-%d')");
                    $calllog = DB::select("select DATE(created_at) as created_at, count(`id`) as count from call_log where date(`created_at`)>=date('$date1') AND date(`created_at`) <=date ('$date2')  group by DATE_FORMAT(`created_at`, '%Y-%m-%d')");
                    $fblog = DB::select("select DATE(created_at) as created_at, count(`id`) as count from chatfb_log where date(`created_at`)>=date('$date1') AND date(`created_at`)<=date('$date2')  group by DATE_FORMAT(`created_at`, '%Y-%m-%d')");
                    $data = [
                        'zalolog' => $zalolog,
                        'contactlog' => $contactlog,
                        'maplog' => $maplog,
                        'fblog' => $fblog,
                        'calllog' => $calllog,
                        'date_format' => 'date',
                        'date1' => $date1,
                        'date2' => $date2,

                    ];
                }else{
                    return response()->json([
                        'code'=>400,
                        'message'=>'date1 cannot bigger than date2'
                    ],400);
                }
            }else{
                return response()->json([
                    'code'=>400,
                    'message'=>'Invalid date'
                ],400);
            }
        }else if(isset($requestData['date1'])){
            $date1 = validateDate($requestData['date1']);
            if($date1 == true ){
                $date1 = $requestData['date1'];
                $date2 = $now;
                if($requestData['date1'] <= $date2){
                    $zalolog = DB::select("select DATE(created_at) as created_at, count(`id`) as count from chatzalo_log where date(`created_at`)>=date('$date1') AND date(`created_at`) <=date('$date2') group by DATE_FORMAT(`created_at`, '%Y-%m-%d')");
                    $contactlog = DB::select("select DATE(created_at) as created_at, count(`id`) as count from lienhe_log where date(`created_at`)>=date('$date1') AND date(`created_at`) <=date('$date2')  group by DATE_FORMAT(`created_at`, '%Y-%m-%d')");
                    $maplog = DB::select("select DATE(created_at) as created_at, count(`id`) as count from maps_log where date(`created_at`)>=date('$date1') AND date(`created_at`) <=date('$date2')  group by DATE_FORMAT(`created_at`, '%Y-%m-%d')");
                    $calllog = DB::select("select DATE(created_at) as created_at, count(`id`) as count from call_log where date(`created_at`)>=date('$date1') AND date(`created_at`) <=date('$date2')  group by DATE_FORMAT(`created_at`, '%Y-%m-%d')");
                    $fblog = DB::select("select DATE(created_at) as created_at, count(`id`) as count from chatfb_log where date(`created_at`)>=date('$date1') AND date(`created_at`)<=date('$date2')  group by DATE_FORMAT(`created_at`, '%Y-%m-%d')");
                    $data = [
                        'zalolog' => $zalolog,
                        'contactlog' => $contactlog,
                        'maplog' => $maplog,
                        'fblog' => $fblog,
                        'calllog' => $calllog,
                        'date_format' => 'date',
                        'date1' => $date1,
                        'date2' => $date2,
                    ];
                }else{
                    return response()->json([
                        'code'=>400,
                        'message'=>'date1 cannot greater than date2(date2 = now)!!'
                    ],400);
                }
            }else{
                return response()->json([
                    'code'=>400,
                    'message'=>'Invalid date'
                ],400);
            }
        }else if(isset($requestData['date2'])){
            $date1 = $now;
            $date2 = validateDate($requestData['date2']);
            if($date2 == true){
                $date2 = ($requestData['date2']);
                if($requestData['date2'] >= $date1){
                    $zalolog = DB::select("select DATE(created_at) as created_at, count(`id`) as count from chatzalo_log where date(`created_at`)>=date('$date1') AND date(`created_at`) <= date('$date2') group by DATE_FORMAT(`created_at`, '%Y-%m-%d')");
                    $contactlog = DB::select("select DATE(created_at) as created_at, count(`id`) as count from lienhe_log where date(`created_at`)>=date('$date1') AND date(`created_at`) <= date('$date2')  group by DATE_FORMAT(`created_at`, '%Y-%m-%d')");
                    $maplog = DB::select("select DATE(created_at) as created_at, count(`id`) as count from maps_log where date(`created_at`)>=date('$date1') AND date(`created_at`) <= date('$date2')  group by DATE_FORMAT(`created_at`, '%Y-%m-%d')");
                    $calllog = DB::select("select DATE(created_at) as created_at, count(`id`) as count from call_log where date(`created_at`)>=date('$date1') AND date(`created_at`) <=date('$date2')  group by DATE_FORMAT(`created_at`, '%Y-%m-%d')");
                    $fblog = DB::select("select DATE(created_at) as created_at, count(`id`) as count from chatfb_log where date(`created_at`)>=date('$date1') AND date(`created_at`)<=date('$date2')  group by DATE_FORMAT(`created_at`, '%Y-%m-%d')");
                    $data = [
                        'zalolog' => $zalolog,
                        'contactlog' => $contactlog,
                        'maplog' => $maplog,
                        'fblog' => $fblog,
                        'calllog' => $calllog,
                        'date_format' => 'date',
                        'date1' => $date1,
                        'date2' => $date2,
                    ];
                }else{
                    return response()->json([
                        'code'=>400,
                        'message'=>'date2 cannot smaller than date1(date1 = now)!!'
                    ],400);
                }
            }else{
                return response()->json([
                    'code'=>400,
                    'message'=>'Invalid date'
                ],400);
            }
        } else{
            $zalolog= DB::select("select DATE(created_at) as created_at, count(`id`) as count from chatzalo_log group by DATE_FORMAT(`created_at`, '%Y-%m-%d')");
            $contactlog= DB::select("select DATE(created_at) as created_at, count(`id`) as count from lienhe_log group by DATE_FORMAT(`created_at`, '%Y-%m-%d')");
            $maplog= DB::select("select DATE(created_at) as created_at, count(`id`) as count from maps_log group by DATE_FORMAT(`created_at`, '%Y-%m-%d')");
            $calllog=DB::select("select DATE(created_at) as created_at, count(`id`) as count from call_log group by DATE_FORMAT(`created_at`, '%Y-%m-%d')");
            $fblog = DB::select("select DATE(created_at) as created_at, count(`id`) as count from chatfb_log group by DATE_FORMAT(`created_at`, '%Y-%m-%d')");
            $data=[
                'zalolog'=>$zalolog,
                'contactlog'=>$contactlog,
                'maplog'=>$maplog,
                'fblog'=>$fblog,
                'calllog'=>$calllog,
                'date_format'=>'all'
            ];
        }

        $this->respon['status']   = true;
        $this->respon['message']  = __('api.success');
        $this->respon['data']     = $data;
        $this->respon['error_type'] = 1;
        return response()->json($this->respon);
    }


    /**
     * API add call
     * Created by   : Thangnv
     * Created date : 2020/08/19
     *
     * @param    Request $request
     * @return      json
     */
    public function userinfo(Request $request) {

        $requestData = $request->all();
        $this->respon['error_type'] = 0;
        //
        $message     = array(
            'token.required'         => __('api.token_required'),
        );
        $rule = [
            'token'          => 'required',
         ];
        $validator = Validator::make($requestData, $rule,$message);
        //
        if ($validator->fails()) {
            $this->respon['message'] = $validator->errors()->first();
            return response()->json($this->respon);
        }else{
            //
            $user = Users::where('token',$request->input('token'))->first();
            if($user){
                $call = Call::where('user_id',$user->id)->get();
                $fb = ChatFaceBook::where('user_id',$user->id)->get();
                $zl = ChatZalo::where('user_id',$user->id)->get();
                $contact = Contact::where('user_id',$user->id)->get();
                $map = Maps::where('user_id',$user->id)->get();
                $data=[
                    'zalo'=>$zl,
                    'contact'=>$contact,
                    'map'=>$map,
                    'fb'=>$fb,
                    'call'=>$call,
                ];

                $this->respon['status']   = true;
                $this->respon['message']  = __('api.success');
                $this->respon['data']     = $data;
                $this->respon['error_type'] = 1;
            }else{
                return response()->json([
                    'code'=>400,
                    'message'=>'Invalid Token'
                ],400);
            }
        }
        return response()->json($this->respon);
    }
    public function sentmessage(Request $request) {

        $requestData = $request->all();
        $user = Users::where('token',$request->input('token'))->first();

        $requestData['author']=$user->username;
        $requestData['conten']=$requestData['content'];
        app('App\Http\Controllers\Admin\ChatController')->store($requestData);

        $this->respon['status']   = true;
        $this->respon['message']  = __('api.success');
        $this->respon['data']     = $requestData['content'];
        $this->respon['error_type'] = 1;
        return response()->json($this->respon);
    }
    public function mail(Request $request){
        $mail = new PHPMailer(true);
        try {
            //Server settings
            //thêm dòng sau để hiển thị đc ký tự có dấu
            $mail->CharSet = 'UTF-8';
            //thực tế sử dụng debug_off
            $mail->SMTPDebug = SMTP::DEBUG_OFF;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            //sử dụng server gmail để gửi mail
            $mail->Host = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth = true;                                   // Enable SMTP authentication
            //nhập tài khoản gmail cho username
            //tạm thời dùng tài khoản sau để
            // đỡ mất thời gian Xác minh 2 bươc
            $mail->Username = 'duylinh180998@gmail.com';                     // SMTP username
            //password ko phải là pasword gmail, mà gmail có 1 cơ chế
            //tạo password cho các ứng dụng, password này độc lập với
            //password gmail của bạn
            $mail->Password = 'idfbwjmnbzkzniuf';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            //gửi từ ai
            $mail->setFrom('abc@gmail.com', 'Lưu Duy Linh');
            //gửi tới ai
            $mail->addAddress($request->input('email'));     // Add a recipient
//    $mail->addAddress('ellen@example.com');               // Name is optional
//    $mail->addReplyTo('info@example.com', 'Information');
//    $mail->addCC('cc@example.com');
//    $mail->addBCC('bcc@example.com');

            // Attachments
            //đính kèm file muốn gửi cùng mail
//            $mail->addAttachment('image.jpeg');         // Add attachments
//    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Test mail';
            $mail->Body = 'Test mail thành công';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        $this->respon['status']   = true;
        $this->respon['message']  = __('api.success');
        $this->respon['data']     = 1;
        $this->respon['error_type'] = 1;
        return response()->json($this->respon);
    }
}

