<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\Analytic;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Facades\Agent;
use Stevebauman\Location\Facades\Location;
use Validator;

class HomeController extends BaseController
{


    public function cardInfo(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'uuid' => 'required',
            
        ]);

        if ($validator->fails()) {
            return $this->sendError('Error validation', $validator->errors());
        }
        

     $contact = Contact::with('company', 'socialMedia','contactDetails')->where('username', $request->uuid)->first();

        if ($contact) {
            $contact->increment('views');


            $uri = str_replace($request->root(), '', $request->url()) ?: '/';
            $agent = app('agent');
        // if (! $agent->isRobot()) {
            $agent->setUserAgent($request->headers->get('user-agent'));
            $agent->setHttpHeaders($request->headers);
            // $sessionExists = Analytic::where('session', $request->session()->getId())->where('contact_id',
            // $contact->id)->exists();
            // if ($sessionExists) {
            //     return $next($request);
            // }

            $items = implode($agent->languages());
            $lang = substr($items, 0, 2);
            $ip = Location::get($request->ip());
            $country = $ip ? $ip->countryName : '';

            Analytic::create([
                'session' => '',
                'contact_id' => $contact->id,
                'uri' => $uri,
                'source' => $request->headers->get('referer'),
                'country' => $country,
                'browser' => $agent->browser() ?? null,
                'device' => $agent->deviceType(),
                'operating_system' => $agent->platform(),
                'ip' => $request->ip(),
                'language' => $lang,
                'meta' => json_encode(Location::get($request->ip())),
            ]);
            if (isset($contact->company)) {
                $company = $contact->company->name;
                unset($contact->company); // Remove the original 'company' relationship
                 $contact['company'] = $company;
            }
            return $this->sendResponse($contact, 'User created successfully.');
        } else {
            return $this->sendError('Contact not found');
        }

       
    }
}
