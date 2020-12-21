<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Converter;
use Carbon\Carbon;
class ConverterController extends Controller
{
    public function toArrays(Request $request)
    {
        $json = $request->data;
        $token = $request->token;
        if (env('ACCESS_TOKEN') == $token) {
//        $token = env('ACCESS_TOKEN');
//            '{"notificationType":"Bounce","bounce":{"feedbackId":"010201762c4054a2-424cab55-f6b7-420c-8f51-f1f13cb8b702-000000","bounceType":"Transient","bounceSubType":"General","bouncedRecipients":[{"emailAddress":"chintu@mailinatorc.com","action":"failed","status":"4.4.7","diagnosticCode":"smtp; 554 4.4.7 Message expired: unable to deliver in 840 minutes.<421 4.4.0 Unable to lookup DNS for mailinatorc.com>"}],"timestamp":"2020-12-04T05:36:22.000Z","reportingMTA":"dsn; a4-1.smtp-out.eu-west-1.amazonses.com"},"mail":{"timestamp":"2020-12-03T13:58:22.222Z","source":"ooionline@opsimplify.com","sourceArn":"arn:aws:ses:eu-west-1:128134649499:identity/opsimplify.com","sourceIp":"3.248.44.136","sendingAccountId":"128134649499","messageId":"0102017628e5910e-f8d2fba5-c25f-4109-8571-246ca3c983b2-000000","destination":["chintu@mailinatorc.com"],"headersTruncated":false,"headers":[{"name":"Received","value":"from sharabh.ooionline.com (ec2-3-248-44-136.eu-west-1.compute.amazonaws.com [3.248.44.136]) by email-smtp.amazonaws.com with SMTP (SimpleEmailService-d-8DMC1AGE7) id zcEZl2C63kMsDHYhlI2W for chintu@mailinatorc.com; Thu, 03 Dec 2020 13:58:22 +0000 (UTC)"},{"name":"Date","value":"Thu, 3 Dec 2020 14:58:22 +0100"},{"name":"To","value":"chintu@mailinatorc.com"},{"name":"From","value":"OPSimplify <ooionline@opsimplify.com>"},{"name":"Reply-To","value":"Email Notification <noreply@opsimplify.com>"},{"name":"Subject","value":"Votre accès à la plateforme collaborative SHARABH"},{"name":"Message-ID","value":"<PhTQOVF4ZuRS5icap8Bt6u6KCcBd3l2ihs2RPqYmpI@sharabh.ooionline.com>"},{"name":"X-Mailer","value":"PHPMailer 6.0.7 (https://github.com/PHPMailer/PHPMailer)"},{"name":"MIME-Version","value":"1.0"},{"name":"Content-Type","value":"text/html; charset=UTF-8"}],"commonHeaders":{"from":["OPSimplify <ooionline@opsimplify.com>"],"replyTo":["Email Notification <noreply@opsimplify.com>"],"date":"Thu, 3 Dec 2020 14:58:22 +0100","to":["chintu@mailinatorc.com"],"messageId":"<PhTQOVF4ZuRS5icap8Bt6u6KCcBd3l2ihs2RPqYmpI@sharabh.ooionline.com>","subject":"Votre accès à la plateforme collaborative SHARABH"}}}
//';
            $objs = json_decode($json, true);
            $bounceType = $objs['bounce']['bounceType'];
            $bounceSubType = $objs['bounce']['bounceSubType'];
            $timestamp = $objs['bounce']['timestamp'];
            $time = date('Y-m-d h:i:s', strtotime($timestamp));
            $mailTimestamp = $objs['mail']['timestamp'];
            $mailTime = date('Y-m-d h:i:s', strtotime($mailTimestamp));
            $name = $objs['mail']['headers'][0]['name'];
            $value = $objs['mail']['headers'][1]['value'];
            $from = $objs['mail']['commonHeaders']['from'][0];
            $replyTo = $objs['mail']['commonHeaders']['replyTo'][0];
            $to = $objs['mail']['commonHeaders']['to'][0];

            $param = [
                'bounce_type' => $bounceType,
                'bounceSubType' => $bounceSubType,
                'timestamp' => $time,
                'mail_timestamp' => $mailTime,
                'name' => $name,
                'value' => $value,
                'from' => $from,
                'reply_to' => $replyTo,
                'to' => $to,
            ];
            $data = Converter::create($param);
            return response()->json(['status' => TRUE, 'data' => 'Data inserted', 'content' => $data], 200);
        }
        return response()->json(['status' => false, 'data' => 'Unauthorised Action']);
    }


    public function countEntries(){
        $counts = Converter::get();
        return $counts->count();
    }

    public function getData(Request $request,$numberOfEntries = 3){
        $count = $this->countEntries();
            $data = Converter::paginate($numberOfEntries);
            $check = $data->count();
            if($check !== 0){
//                return view('calender');
                return view('show',compact('data','count','numberOfEntries'));
            }
        return response()->json(['status' => false, 'data' => 'No data found']);
    }

    public function filterByColumns(Request $request){


        if($request->filled('from_date') && $request->filled('to_date') &&
           $request->filled('from_email') && $request->filled('to_email')){

            $fromDate = $request->from_date;
            $toDate = $request->to_date;
            $fromEmail = $request->from_email;
            $toEmail = $request->to_email;

            $dateData = $this->filterByAllKeys($fromDate,$toDate,$fromEmail,$toEmail);
            return view('showbydate',compact('dateData'));


        }elseif ($request->filled('from_email') && $request->filled('to_email')){
            $fromEmail = $request->from_email;
            $toEmail = $request->to_email;
            $dateData = $this->filterByEmails($fromEmail,$toEmail);
            return view('showbydate',compact('dateData'));
        }elseif ($request->filled('from_date') && $request->filled('to_date') &&
            $request->filled('from_email')){
//            dd("okkk");
            $fromDate = $request->from_date;
            $toDate = $request->to_date;
            $fromEmail = $request->from_email;

            $dateData = $this->filterByDateFromEmails($fromEmail,$fromDate,$toDate);
            return view('showbydate',compact('dateData'));

        }
        elseif($request->filled('from_date') && $request->filled('to_date') &&
            $request->filled('to_email')){
//            dd("okll");
            $fromDate = $request->from_date;
            $toDate = $request->to_date;
//            $fromEmail = $request->from_email;
            $toEmail = $request->to_email;
            $dateData = $this->filterByDateToEmail($fromDate,$toDate,$toEmail);
            return view('showbydate',compact('dateData'));

        }
//        elseif ($request->filled('to_email')){
//            dd("to e");
//            $toEmail = $request->to_email;
//            $dateData = $this->filterByToEmails($toEmail);
//           return view('showbydate',compact('dateData'));
//
//        }
        elseif($request->filled('from_date') && $request->filled('to_date')){
//            $error = $request->validate([
//                'from_date' => 'required',
////                'to_date' => 'required_with:from_date',
//            'to_date' => 'required',
//
//            ]);
//            if($error){
////            dd("ok");
//                return view('showbydate',compact('dateData'));
//            }
//                        dd("ok");
            $fromDate = $request->from_date;
            $toDate = $request->to_date;
//            $toEmail = $request->to_email;
            $dateData = $this->filterByDates($fromDate,$toDate);
            return view('showbydate',compact('dateData'));

        }
//        elseif($request->filled('from_date') && $request->filled('to_date') && $request->filled('from_email') ){
//            dd("date f");
//            $fromDate = $request->from_date;
//            $toDate = $request->to_date;
//            $fromEmail = $request->from_email;
////            $toEmail = $request->from_email;
//            $dateData = $this->filterByDateToEmail($fromDate,$toDate,$fromEmail);
//            return view('showbydate',compact('dateData'));
//
//        }

    }

    public function filterByAllKeys($fromDate,$toDate,$fromEmail,$toEmail){
//        dd("okk");

        return  Converter::where('timestamp','>=',$fromDate)->where('timestamp','<=',$toDate)
//            ->where('from',$fromEmail)->where('to',$toEmail)
            ->paginate(5);
    }

    public function filterByEmails($fromEmail,$toEmail){
//        dd("okk");
        return Converter::where('from',$fromEmail)->where('to',$toEmail)->paginate(5);
    }

    public function filterByDateFromEmails($fromEmail,$fromDate,$toDate){
        return Converter::where('from',$fromEmail)->where('timestamp','>=',$fromDate)->where('timestamp','<=',$toDate)->paginate(5);
    }

//    public function filterByToEmails($toEmail){
//        return Converter::where('to',$toEmail)->paginate(5);
////        return view('showbydate',compact('data'));
//
//    }
//    public function filterByToEmails($toEmail)
    public function filterByDates($fromDate,$toDate){
//                    dd("ok");

//        if($request->filled('from_date') && $request->filled('to_date')){
//
//        }
//        $error = $request->validate([
//            'from_date' => 'required_with:to_date',
//            'to_date' => 'required_with:from_date',
////            'to_date' => 'required',
//
//        ]);

//        $fromDate = $request->from_date;
//        $toDate = $request->to_date;
        $toDate = date('Y-m-d', strtotime($toDate));
        $fromDate = date('Y-m-d', strtotime($fromDate));
//        $dateData = Converter::where('timestamp','>=',$fromDate)->where('timestamp','<=',$toDate)->paginate(5);
        $dateData = Converter::where('timestamp','>=',$fromDate)->where('timestamp','<=',$toDate)->paginate(5);
        $check = $dateData->count();
        if($check !== 0){
//                return view('calender');
//            return redirect('/get-data');
            return $dateData;
//            return view('showbydate',compact('dateData'));
        }
//        if($error){
////            dd("ok");
//            return redirect('/data/date');
//        }
        return response()->json(['status' => false, 'data' => 'No data found']);
    }

    public function filterByDateToEmail($fromDate,$toDate,$toEmail){
        return  Converter::where('timestamp','>=',$fromDate)->where('timestamp','<=',$toDate)->where('to',$toEmail)->paginate(5);

    }
}