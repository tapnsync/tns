<?php

namespace App\Http\Controllers\Contacts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\ContactDetails;
use App\Models\ContactSocialMedia;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

class ContactsDashboardController extends Controller
{
    public function index()
    {

        $id = Auth::guard('contacts')->user()->id;
        $contact = Contact::find($id);
        return view('user_profile.pages.profile',compact('contact'));
    }

    public function logout()
    {

   
        Auth::guard('contacts')->logout();

        // Redirect to the login page after logout
        return redirect()->route('contact.login.form');
    }


    public function edit()
    {
        $id = Auth::guard('contacts')->user()->id;
        $contact = Contact::find($id);
        return view('user_profile.pages.contacts.edit', compact('contact'));
    }

    public function save_settings(Request $request, Contact $contact)
    {
        $validatedData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'designation' => 'required',
            'phone_work' => 'required',
            'phone_personal' => 'required',
            'email_work' => 'required|email',
            'website' => 'nullable|url',
            'address' => 'nullable',
            'background_color' => 'nullable',
            'map' => 'nullable',
            'theme' => 'nullable',
            'password' => 'nullable',
            'username' => [
                'required',
                
            ],
        ]);
        
        
        $data = [
            'first_name' => $validatedData['first_name'],
            'username' => $validatedData['username'],
            'last_name' => $validatedData['last_name'],
            'designation' => $validatedData['designation'],
            'phone_work' => $validatedData['phone_work'],
            'phone_personal' => $validatedData['phone_personal'],
            'email_work' => $validatedData['email_work'],
            'website' => $validatedData['website'],
            'address' => $validatedData['address'],
            'background_color' => $validatedData['background_color'],
            'map' => $validatedData['map'],
            'theme' => $validatedData['theme'],
        ];
           
if ($validatedData['password'] !== null) {
    $data['password'] = Hash::make($validatedData['password']);
}

        
         if ($request->hasFile('profile_photo')) {
            $data['profile_photo'] = $request->file('profile_photo')->store('profile-photos', 'public');
        }
            
            if ($request->hasFile('cover_photo')) {
                $data['cover_photo'] = $request->file('cover_photo')->store('cover-photo', 'public');
            }
            $contact = Contact::find($request->contact_id);
            
        //$validatedData['email'] = $validatedData['email_work'];
            
        

        $qrCodeData = 'https://tnscards.com/' . $contact->username;
        $qrCode = QrCode::size(120)->generate($qrCodeData);
        
        // Use 'svg' as the file extension for storing SVG files
        $qrCodePath = 'qrcodes/' . $contact->username . '.svg';
        
        // Ensure the 'qrcodes' directory exists in the 'public' disk
        Storage::disk('public')->makeDirectory('qrcodes');
        
        // Store the SVG QR code in storage
        Storage::disk('public')->put($qrCodePath, $qrCode);
        
        

    
        $contact->update($data);
        
        
       // Update the 'qr_code' field in the 'contacts' table with the relative path to the stored SVG QR code
        $contact->update(['qr_code' => $qrCodePath]);

        
    
     

         
        
       
    
        $socialMediaData = $request['social_media'];
    
            $existingSocialMediaIds = $contact->socialMedia->pluck('id')->toArray();
            if(!empty($socialMediaData)){
                foreach ($socialMediaData as $index => $data) {
                if (isset($data['id'])) {
                    $socialMedia = ContactSocialMedia::find($data['id']);
                    if ($socialMedia) {
                        $socialMedia->update([
                            'platform' => $data['platform'],
                            // 'username' => $data['username'],
                            'link' => $data['link'],
                            'icon' => $data['platform'].".png",
                        ]);
                        // Remove this id from the array, as it's still present in the form
                        $existingSocialMediaIds = array_diff($existingSocialMediaIds, [$data['id']]);
                    } else {
                        // dd("Social media record not found for ID: " . $data['id']);
                    }
                } else {
                    $contact->socialMedia()->create([
                        'platform' => $data['platform'],
                        // 'username' => $data['username'],
                        'link' => $data['link'],
                        'icon' => $data['platform'].".png",
                    ]);
                }
            }
        }
        
        
        
        
        
        
        
    
        // Delete social media entries that were not present in the form
        ContactSocialMedia::whereIn('id', $existingSocialMediaIds)->delete();



        // Update contact details
        $contactData = $request['contactDetails'];
        $existingContactDetailsIds = $contact->contactDetails->pluck('id')->toArray();

        if (!empty($contactData)) {
            foreach ($contactData as $index => $data) {
                if (isset($data['id'])) {
                    $contactDetail = ContactDetails::find($data['id']);
                    if ($contactDetail) {
                        $contactDetail->update([
                            'title' => $data['title'],
                            'details' => $data['details'],
                            // Add other fields as needed
                        ]);
                        $existingContactDetailsIds = array_diff($existingContactDetailsIds, [$data['id']]);
                    } else {
                        // Handle the case where contact detail record is not found for the given ID
                    }
                } else {
                    $contact->contactDetails()->create([
                        'title' => $data['title'],
                        'details' => $data['details'],
                        // Add other fields as needed
                    ]);
                }
            }
        }

        // Delete contact details entries that were not present in the form
        ContactDetails::whereIn('id', $existingContactDetailsIds)->delete();



        // $contactData = $request['contactDetails'];

        // $existingContactDetailsIds = $contact->contactDetails->pluck('id')->toArray();
        // if (!empty($contactData)) {
        //     foreach ($contactData as $index => $data) {
        //         if (isset($data['id'])) {
        //             $contactDetail = ContactDetails::find($data['id']);
        //             if ($contactDetail) {
        //                 $contactDetail->update([
        //                     'title' => $data['title'], // Update with the actual field names
        //                     'details' => $data['details'],
        //                     // ... other fields ...
        //                 ]);
        //                 // Remove this id from the array, as it's still present in the form
        //                 $existingContactDetailsIds = array_diff($existingContactDetailsIds, [$data['id']]);
        //             } else {
        //                 // dd("Contact detail record not found for ID: " . $data['id']);
        //             }
        //         } else {
        //             $contact->contactDetails()->create([
        //                 'title' => $data['title'], // Update with the actual field names
        //                 'details' => $data['details'],
        //                 // ... other fields ...
        //             ]);
        //         }
        //     }
        // }

        // // Delete contact details entries that were not present in the form
        // ContactDetails::whereIn('id', $existingContactDetailsIds)->delete();
    
    
        return redirect()->route('contact.dashboard')->with('success', 'Contact updated successfully.');
    }
    
}
