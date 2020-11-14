<?php

namespace App\Http\Controllers\Admin;

use App\authenticationCode;
use App\GoogleAds;
use App\GoogleReport;
use GuzzleHttp\Client;
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
                    'redirect_uri' => 'http://localhost/oauth2callback'
                ]
            ]);
            echo $res->getStatusCode();
            echo $res->getBody();
        } else {
            return redirect('dashboard');
        }
    }

    public function Auth_save(Request $request)
    {
        $authCode = new authenticationCode();
        $authCode->Code = $_GET['code'];
        $authCode->user_id = Auth::user()->id;
        $authCode->save();
        $client = new Client();
        $res1 = $client->request('POST', 'https://accounts.google.com/o/oauth2/token', [
            'form_params' => [
                'code' => $authCode->Code = $_GET['code'],
                'client_id' => '124712444776-6dfhlgdvb827j30mhpsd3s7hhalmumq2.apps.googleusercontent.com',
                'client_secret' => 'hFz7FHT3B2VZOK92WV3qk8ip',
                'redirect_uri' => 'http://localhost/oauth2callback',
                'grant_type' => 'authorization_code'
            ]
        ]);
        $res1->getStatusCode();
        $json = $res1->getBody();

        $carbon = Carbon::now('Asia/Ho_Chi_Minh');
        $time = $carbon->addHours(1);
        $expired_in = $time->toDateTimeString();
        $authentication_code = authenticationCode::where('Code', $_GET['code'])->first();

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
        $google_ads->authentication_id = $authentication_code->id;
        $google_ads->save();
        $res = $client->request('POST', 'https://googleads.googleapis.com/v6/customers/5542577145/googleAds:searchStream', [
            'headers' => [
                'User-Agent' => 'curl  HTTP/1.1',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $accessToken,
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
        echo $res->getStatusCode();
        $json_decode = $res->getBody();
        $campaign = json_decode($json_decode);
        $google_reports = new GoogleReport();
        // DESKTOP
        $desktop = $campaign[0]->{'results'}[0]->{'metrics'};
        $mobile = $campaign[0]->{'results'}[1]->{'metrics'};
        $tablet = $campaign[0]->{'results'}[2]->{'metrics'};

        $google_reports->clicks_desktop = $desktop->{'clicks'};
        $google_reports->cost_desktop = $desktop->{'costMicros'};
        $google_reports->ctr_desktop = $desktop->{'ctr'};
        $google_reports->averageCpc_desktop = $desktop->{'averageCpc'};
        $google_reports->impressions_desktop = $desktop->{'impressions'};
        $google_reports->segments_desktop = "DESKTOP";
        // MOBILE
        $google_reports->clicks_mobile = $mobile->{'clicks'};
        $google_reports->cost_mobile = $mobile->{'costMicros'};
        $google_reports->ctr_mobile = $mobile->{'ctr'};
        $google_reports->averageCpc_mobile = $mobile->{'averageCpc'};
        $google_reports->impressions_mobile = $mobile->{'impressions'};
        $google_reports->segments_mobile = "MOBILE";
        //TABLET
        $google_reports->clicks_tablet = $tablet->{'clicks'};
        $google_reports->cost_tablet = $tablet->{'costMicros'};
        $google_reports->ctr_tablet = $tablet->{'ctr'};
        $google_reports->impressions_tablet = $tablet->{'impressions'};
        $google_reports->segments_tablet = "TABLET";

        $google_reports->user_id = Auth::user()->id;
        $google_reports->save();
        return redirect(route('google.report.list'))->with('message', 'get report successfully');
    }

    public function getCampaignDetails()
    {
        $client = new Client();
        $carbon = Carbon::now('Asia/Ho_Chi_Minh');
        $date = $carbon->toDateTimeString();
        $check_authorization = authenticationCode::where('user_id', Auth::user()->id)->first();
        if ($check_authorization != NULL) {
            $google_ads = GoogleAds::where('authentication_id', $check_authorization->id)->first();
            if ($date >= $google_ads->expired_in) {
                $client = new Client();
                $res1 = $client->request('POST', 'https://accounts.google.com/o/oauth2/token', [
                    'form_params' => [
                        'refresh_token' => $google_ads->refresh_token,
                        'client_id' => '124712444776-6dfhlgdvb827j30mhpsd3s7hhalmumq2.apps.googleusercontent.com',
                        'client_secret' => 'hFz7FHT3B2VZOK92WV3qk8ip',
                        'redirect_uri' => 'http://localhost/oauth2callback',
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
            $res = $client->request('POST', 'https://googleads.googleapis.com/v6/customers/5542577145/googleAds:searchStream', [
                'headers' => [
                    'User-Agent' => 'curl  HTTP/1.1',
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . $get_access_token->access_token,
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
            echo $res->getStatusCode();
            $json_decode = $res->getBody();
            $campaign = json_decode($json_decode);

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

            $google_reports = GoogleReport::where('user_id', Auth::user()->id)->first();

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


            $desktop = $campaign[0]->{'results'}[0]->{'metrics'};
            $mobile = $campaign[0]->{'results'}[1]->{'metrics'};
            $tablet = $campaign[0]->{'results'}[2]->{'metrics'};
            // DESKTOP
            $google_reports->clicks_desktop = $desktop->{'clicks'};
            $google_reports->cost_desktop = $desktop->{'costMicros'};
            $google_reports->ctr_desktop = $desktop->{'ctr'};
            $google_reports->averageCpc_desktop = $desktop->{'averageCpc'};
            $google_reports->impressions_desktop = $desktop->{'impressions'};
            $google_reports->segments_desktop = "DESKTOP";
            // MOBILE
            $google_reports->clicks_mobile = $mobile->{'clicks'};
            $google_reports->cost_mobile = $mobile->{'costMicros'};
            $google_reports->ctr_mobile = $mobile->{'ctr'};
            $google_reports->averageCpc_mobile = $mobile->{'averageCpc'};
            $google_reports->impressions_mobile = $mobile->{'impressions'};
            $google_reports->segments_mobile = "MOBILE";
            //TABLET
            $google_reports->clicks_tablet = $tablet->{'clicks'};
            $google_reports->cost_tablet = $tablet->{'costMicros'};
            $google_reports->ctr_tablet = $tablet->{'ctr'};
            $google_reports->impressions_tablet = $tablet->{'impressions'};
            $google_reports->segments_tablet = "TABLET";

            $google_reports->user_id = Auth::user()->id;
            $google_reports->save();
            return redirect(route('google.report.list'))->with('message', 'get report successfully');
        } else {
            return redirect('/getAuthentication');
        }
    }

    public function google_report_list()
    {
        $google_reports = GoogleReport::where('user_id', Auth::user()->id)->get();
        return view('googleAds.index', compact('google_reports'));
    }
}

