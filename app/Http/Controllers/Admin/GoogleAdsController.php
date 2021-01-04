<?php

namespace App\Http\Controllers\Admin;

use App\authenticationCode;
use App\Customers;
use App\GoogleAds;
use App\GoogleReport;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class GoogleAdsController extends Controller
{
    public function getAuthentication(Request $request)
    {
        $authentication = authenticationCode::where('user_id', Auth::user()->id)->first();
        if ($authentication == NULL) {
            $client = new Client();
            $res = $client->request('POST', 'https://accounts.google.com/o/oauth2/auth', [
                'form_params' => [
                    'access_type' => 'offline',
                    'prompt' => 'consent',
                    'client_id' => '124712444776-6dfhlgdvb827j30mhpsd3s7hhalmumq2.apps.googleusercontent.com',
                    'response_type' => 'code',
                    'scope' => 'https://www.googleapis.com/auth/adwords',
                    'redirect_uri' => "http://" . $_SERVER['HTTP_HOST'] . '/oauth2callback'
                ]
            ]);
            echo $res->getStatusCode();
            echo $res->getBody();
        }
    }
    public function Auth_save(Request $request)
    {
        $authCode = new authenticationCode();
        $authCode->Code = $_GET['code'];
        $authCode->user_id = Auth::user()->id;
        $client = new Client();
        $res1 = $client->request('POST', 'https://accounts.google.com/o/oauth2/token', [
            'form_params' => [
                'code' => $_GET['code'],
                'client_id' => '124712444776-6dfhlgdvb827j30mhpsd3s7hhalmumq2.apps.googleusercontent.com',
                'client_secret' => 'hFz7FHT3B2VZOK92WV3qk8ip',
                'redirect_uri' => "http://" . $_SERVER['HTTP_HOST'] . '/oauth2callback',
                'grant_type' => 'authorization_code'
            ]
        ]);
        $res1->getStatusCode();
        $json = $res1->getBody();
        $carbon = Carbon::now('Asia/Ho_Chi_Minh');
        $time = $carbon->addHours(1);
        $expired_in = $time->toDateTimeString();
        $obj = json_decode($json);
        $accessToken = $obj->{'access_token'};
        $refreshToken = $obj->{'refresh_token'};
        $scope = $obj->{'scope'};
        $token_type = $obj->{'token_type'};

        $google_ads = new GoogleAds();
        $google_ads->access_token = $accessToken;
        $google_ads->expired_in = $expired_in;
        $google_ads->refresh_token = $refreshToken;
        $google_ads->user_id = Auth::user()->id;
        $google_ads->scope = $scope;
        $google_ads->token_type = $token_type;
        $google_ads->save();
        $get_access_token = GoogleAds::where("user_id", Auth::user()->id)->first();
        try {
            $res2 = $client->request('GET', 'https://googleads.googleapis.com/v6/customers:listAccessibleCustomers', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $get_access_token->access_token,
                    'developer-token' => 'BrtDh-R9uWJUYzJx1d_EoA'
                ]
            ]);
        } catch (ClientException $e) {
            $get_access_token->delete();
            return redirect(route('googleAds.index'))->with('error', 'You did not have your google ads accounts');
        }
        echo $res2->getStatusCode();
        $json1 = $res2->getBody();
        //Get array
        $obj1 = json_decode($json1, true);
        //dd($obj1) --> check valuables
        //get Array name ResourceNames
        $customer_id = $obj1["resourceNames"];
        //convert to string to save db
        $customer_name = json_encode($customer_id);

            $customers = new Customers();
            $customers->customer_id = $customer_name;
            $customers->user_id = Auth::user()->id;
            $customers->save();
            $authCode->save();
            //convert to array
            $customers_id = json_decode($customer_name, true);
            return view('customer.get_customer_id')->with(compact('customers_id'));
    }
    public function getCampaignDetails()
    {
        $client = new Client();
        $carbon = Carbon::now('Asia/Ho_Chi_Minh');
        $date = $carbon->toDateTimeString();
        $check_authorization = authenticationCode::where('user_id', Auth::user()->id)->first();
        if ($check_authorization != NULL) {
            $google_ads = GoogleAds::where('user_id', Auth::user()->id)->first();
            if ($date >= $google_ads->expired_in) {
                $client = new Client();
                $res1 = $client->request('POST', 'https://accounts.google.com/o/oauth2/token', [
                    'form_params' => [
                        'refresh_token' => $google_ads->refresh_token,
                        'client_id' => '124712444776-6dfhlgdvb827j30mhpsd3s7hhalmumq2.apps.googleusercontent.com',
                        'client_secret' => 'hFz7FHT3B2VZOK92WV3qk8ip',
                        'redirect_uri' => "http://" . $_SERVER['HTTP_HOST'] . '/oauth2callback',
                        'Content-Type' => 'application/json',
                        'grant_type' => 'refresh_token'
                    ]
                ]);
                $res1->getStatusCode();
                $json = $res1->getBody();
                $obj = json_decode($json);
                $accessToken = $obj->{'access_token'};

                $time = $carbon->addHours(1);
                $expired_in = $time->toDateTimeString();

                $google_ads = GoogleAds::where('user_id', Auth::user()->id)->first();
                $google_ads->access_token = $accessToken;
                $google_ads->expired_in = $expired_in;
                $google_ads->save();
            }
            $get_access_token = GoogleAds::where('user_id', Auth::user()->id)->first();
            $get_customers = Customers::where('user_id', Auth::user()->id)->first();
            if ($get_customers) {
                try {
                    $res2 = $client->request('GET', 'https://googleads.googleapis.com/v6/customers:listAccessibleCustomers', [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $get_access_token->access_token,
                            'developer-token' => 'BrtDh-R9uWJUYzJx1d_EoA'
                        ]
                    ]);
                } catch (ClientException $e) {
                    $google_ads_report = GoogleReport::where("user_id", Auth::user()->id)->first();
                    if ($google_ads_report) {
                        $google_ads_report->delete();
                    }
                    return redirect(route('googleAds.index'))->with('error', 'You did not have your google ads accounts');
                }
                echo $res2->getStatusCode();
                $json1 = $res2->getBody();
                $obj1 = json_decode($json1, true);
                $customer_id = $obj1["resourceNames"];
                $customer_name = json_encode($customer_id);
                $customers = Customers::where("user_id", Auth::user()->id)->first();
                $customers->customer_id = $customer_name;

                $customers->save();

                $customers_id = json_decode($customer_name, true);
                return view('customer.get_customer_id')->with(compact('customers_id'));
            }
        }
            return redirect(route("googleAds.get.Authentication"));
    }
    public function get_google_report(Request $request)
    {
        $requestData = $request->all();
        $client = new Client();
        $google_ads = GoogleAds::where('user_id', Auth::user()->id)->first();
        try{
            $res = $client->request('POST', 'https://googleads.googleapis.com/v6/'.$requestData['customer_id'].'/googleAds:searchStream', [
                'headers' => [
                    'User-Agent' => 'curl  HTTP/1.1',
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . $google_ads->access_token,
                    'developer-token' => 'BrtDh-R9uWJUYzJx1d_EoA'
                ],
                'form_params' => [
                    "query" => "SELECT campaign.name, campaign.status, segments.device,
                    metrics.impressions, metrics.clicks, metrics.ctr,
                    metrics.average_cpc, metrics.cost_micros
            FROM campaign
            WHERE segments.date DURING LAST_30_DAYS"
                        ]
                    ]);
              }catch(ClientException $e){
            return redirect(route('googleAds.index'))->with('error','Your account did not have roles to get reports');
        }
//            $campaign = json_decode($json_decode);
            //            $array = [];
            //            foreach ($campaign as $results) {
            //                $i = 0;
            //                foreach ($results["results"] as $key => $result) {
            //                    $array[$i]["clicks"] = isset($result["metrics"]["clicks"]) ? $result["metrics"]["clicks"] : "";
            //                    $array[$i]["costMicros"] = isset($result["metrics"]["costMicros"]) ? $result["metrics"]["costMicros"] : "";
            //                    $array[$i]["ctr"] = isset($result["metrics"]["ctr"]) ? $result["metrics"]["ctr"] : "";
            //                    $array[$i]["averageCpc"] = isset($result["metrics"]["averageCpc"]) ? $result["metrics"]["averageCpc"] : "";
            //                    $array[$i]["impressions"] = isset($result["metrics"]["impressions"]) ? $result["metrics"]["impressions"] : "";
            //                    $i++;
            //                }
            //            }

//            $google_reports = GoogleReport::where('user_id', Auth::user()->id)->first();

            //            $honganh = [
            //                [["clicks" => "clicks_desktop"], ["costMicros" => "cost_desktop"], ["ctr" => "ctr_desktop"]],
            //                [["clicks" => "clicks_mobile"], ["costMicros" => "cost_mobile"], ["ctr" => "ctr_mobile"]],
            //                [["clicks" => "clicks_tablet"], ["costMicros" => "cost_tablet"], ["ctr" => "ctr_tablet"]],
            //            ];
            //
            //
            //
            //            foreach ($array as $key => $values) {
            //                foreach ($honganh[$key] as $key1 => $mappedArray) {
            //                    $google_reports->{$mappedArray[array_key_first($mappedArray)]} = $values[array_key_first($mappedArray)];
            //                }
            //            }
            //
            //
            //            dd($google_reports->clicks_desktop);
            //
            //            dd($array[0]["clicks"]);
            //            echo "<pre>";
            //            die;
        echo $res->getStatusCode();
        $json_decode = $res->getBody();
        $campaign = json_decode($json_decode);
        $check_google_report_exist = GoogleReport::where("user_id",Auth::user()->id)->first();
        if(!$check_google_report_exist){
            $google_reports = new GoogleReport();
        }else{
            $google_reports = GoogleReport::where("user_id",Auth::user()->id)->first();
        }
        if(isset($campaign[0])){
            $desktop = $campaign[0]->{'results'}[0]->{'metrics'};
            $mobile = $campaign[0]->{'results'}[1]->{'metrics'};
            $tablet = $campaign[0]->{'results'}[2]->{'metrics'};
        }
        // DESKTOP
        if(isset($desktop->{'clicks'})){
            $google_reports->clicks_desktop = $desktop->{'clicks'};
        }else{
            $google_reports->clicks_desktop = 0;
        }
        if(isset($desktop->{'costMicros'})){
            $google_reports->cost_desktop = $desktop->{'costMicros'};
        }else{
            $google_reports->cost_desktop = 0;
        }
        if(isset($desktop->{'ctr'})){
            $google_reports->ctr_desktop = $desktop->{'ctr'};
        }else{
            $google_reports->ctr_desktop = 0;
        }
        if(isset($desktop->{'averageCpc'})){
            $google_reports->averageCpc_desktop = $desktop->{'averageCpc'};
        }else{
            $google_reports->averageCpc_desktop = 0;
        }
        if(isset($desktop->{'impressions'})){
            $google_reports->impressions_desktop = $desktop->{'impressions'};
        }else{
            $google_reports->impressions_desktop = 0;
        }
        $google_reports->segments_desktop = "DESKTOP";
        // MOBILE
        if(isset($mobile->{'clicks'})){
            $google_reports->clicks_mobile = $mobile->{'clicks'};
        }else{
            $google_reports->clicks_mobile = 0;
        }
        if(isset($mobile->{'costMicros'})){
            $google_reports->cost_mobile = $mobile->{'costMicros'};
        }else{
            $google_reports->cost_mobile = 0;
        }
        if(isset($mobile->{'ctr'})){
            $google_reports->ctr_mobile = $mobile->{'ctr'};
        }else{
            $google_reports->ctr_mobile = 0;
        }
        if(isset($mobile->{'averageCpc'})){
            $google_reports->averageCpc_mobile = $mobile->{'averageCpc'};
        }else{
            $google_reports->averageCpc_mobile = 0;
        }
        if(isset($mobile->{'impressions'})){
            $google_reports->impressions_mobile = $mobile->{'impressions'};
        }else{
            $google_reports->impressions_mobile = 0;
        }
        $google_reports->segments_mobile = "MOBILE";
        //TABLET
        if(isset($tablet->{'clicks'})){
            $google_reports->clicks_tablet = $tablet->{'clicks'};
        }else{
            $google_reports->clicks_tablet = 0;
        }
        if(isset($tablet->{'costMicros'})){
            $google_reports->cost_tablet = $tablet->{'costMicros'};
        }else{
            $google_reports->cost_tablet = 0;
        }
        if(isset($tablet->{'ctr'})){
            $google_reports->ctr_tablet = $tablet->{'ctr'};
        }else{
            $google_reports->ctr_tablet = 0;
        }
        if(isset($tablet->{'averageCpc'})){
            $google_reports->averageCpc_tablet = $tablet->{'averageCpc'};
        }else{
            $google_reports->averageCpc_tablet = 0;
        }
        if(isset($tablet->{'impressions'})){
            $google_reports->impressions_tablet = $tablet->{'impressions'};
        }else{
            $google_reports->impressions_tablet = 0;
        }
        $google_reports->segments_tablet = "TABLET";

        $google_reports->user_id = Auth::user()->id;
        $google_reports->save();
        return redirect(route('googleAds.index'))->with('message', 'get report successfully');
    }
    public function delete_google_report()
    {
        authenticationCode::where("user_id",Auth::user()->id)->delete();
        GoogleAds::where("user_id",Auth::user()->id)->delete();
        Customers::where("user_id",Auth::user()->id)->delete();
        GoogleReport::where("user_id",Auth::user()->id)->delete();
       return redirect(route("googleAds.index"))->with("message","delete google report successfully");
    }
    public function google_report_list()
    {
        $google_reports = GoogleReport::where('user_id', Auth::user()->id)->where('status', 0)->get();
        return view('googleAds.index', compact('google_reports'));
    }
}
