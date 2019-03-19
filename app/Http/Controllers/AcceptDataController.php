<?php

namespace App\Http\Controllers;

use App\Analytic;
use App\Helpers\BrowserHelper;
use Illuminate\Http\Request;

class AcceptDataController extends Controller
{
    /**
     * Accept and save any incoming request containing needed analytics data.
     * In case any of the data is missing, the transaction will fail and error
     * will be saved into the standard laravel's log file.
     *
     * This code will NOT show error in user's browser nor will stop execution of the page.
     *
     * @param Request $request
     */
    public function accept(Request $request)
    {
        $r = json_decode(request()->getContent());
        \DB::beginTransaction();

        try {
            // This does not recognize timezones, just reads the timestamp
            $date = !isset($r->date) && !empty($r->date) ? date('Y-m-d H:i:s', strtotime($r->date)) : date('Y-m-d H:i:s');


            // Very simple storage
            $analytics = new Analytic();
            $analytics->user_id = $r->yU;
            $analytics->url = $r->location;
            $analytics->browser = BrowserHelper::detect_browser($r->userAgent);
            $analytics->request_datetime = $date;
            $analytics->user_ip = $request->ip();
            $analytics->save();

            \DB::commit();
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            \DB::rollback();
        }

        // We can add some kind of a counter increment so we have percentage of fail / success ratio.
        // This would go to, for example, redis.
    }
}
