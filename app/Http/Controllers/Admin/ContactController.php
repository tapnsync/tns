<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\ContactSocialMedia;
use App\Models\ContactDetails;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rule;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    public function index()
    {
        
        return view('admin.pages.contacts.index');
    }
    
    public function home($name="")
    {
        $contact = Contact::where('first_name',$name)->first();
        return view('card',compact('contact'));
    }
    
  public function getContacts(Request $request)
{
    $user = auth()->user();
    
    // Check if the user is a super admin
    if ($user->hasRole('Super-Admin')) {
        $contacts = Contact::select(['id', 'first_name','username', 'last_name','views', 'email_work', 'status','created_at']);
    } else {
        // Load contacts with the company_id of the logged-in user
        $contacts = Contact::where('company_id', $user->company_id)
            ->select(['id', 'first_name', 'last_name', 'email_work', 'status','views','created_at']);
    }

    // Get the current page number and number of records per page from the request
    $page = $request->input('page', 1);
    $perPage = $request->input('length', 10); // You may adjust the default per page value

    // Calculate the starting serial number for the current page
    $startSerial = ($page - 1) * $perPage + 1;

    return DataTables::of($contacts)
        ->addColumn('sl_no', function () use (&$startSerial) {
            // Increment the starting serial number for each row
            return $startSerial++;
        })
         ->addColumn('formatted_created_at', function ($contact) {
            // Format the 'created_at' column as a date without Carbon
            return date('d-m-Y', strtotime($contact->created_at));
        })
        ->addColumn('actions', function ($contact) {
            // Add your actions buttons here
        })
        ->rawColumns(['sl_no', 'actions','formatted_created_at'])
        ->toJson();
}


    public function toggleStatus(Contact $contact)
{
    $contact->status = !$contact->status; // Toggle the status (assuming you have a boolean 'status' field)

    if ($contact->save()) {
        return response()->json(['message' => 'Status updated successfully']);
    } else {
        return response()->json(['message' => 'Status update failed'], 500);
    }
}

    public function create()
    {
        return view('admin.pages.contacts.create');
    }

    public function store(Request $request)
    {
        $validatedContactData = $request->validate([
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
            'username' => 'required|unique:contacts,username',
            'profile_photo' => 'nullable',
            'theme' => 'nullable',
            'password'=> 'nullable',
        ]);
        
        if ($request->hasFile('profile_photo')) {
            $validatedContactData['profile_photo'] = $request->file('profile_photo')->store('profile-photos', 'public');
        }
        
     
        
        if ($request->hasFile('cover_photo')) {
            $validatedContactData['cover_photo'] = $request->file('cover_photo')->store('cover-photo', 'public');
        }
        
        if($validatedContactData['password'] != null){
            $validatedContactData['password'] = Hash::make($validatedContactData['password']);
        }

        
        $validatedContactData['email'] = $validatedContactData['email_work'];

        $validatedContactData['company_id'] = auth()->user()->company_id;
    
        $contact = Contact::create($validatedContactData);

         $contact->username;

        $qrCodeData = 'https://tnscards.com/' . $contact->username;
        $qrCode = QrCode::size(120)->generate($qrCodeData);
        
        // Use 'svg' as the file extension for storing SVG files
        $qrCodePath = 'qrcodes/' . $contact->username . '.svg';
        
        // Ensure the 'qrcodes' directory exists in the 'public' disk
        Storage::disk('public')->makeDirectory('qrcodes');
        
        // Store the SVG QR code in storage
        Storage::disk('public')->put($qrCodePath, $qrCode);
        
        // Update the 'qr_code' field in the 'contacts' table with the relative path to the stored SVG QR code
        $contact->update(['qr_code' => $qrCodePath]);


    
        $socialMediaData = $request->input('social_media', []); // Assuming the input name is 'social_media'
        
        
        

        
        
    
        foreach ($socialMediaData as $socialMedia) {
            $contact->socialMedia()->create([
                'platform' => $socialMedia['platform'],
                // 'username' => $socialMedia['username'],
                'link' => $socialMedia['link'],
                'icon' => $socialMedia['platform'].".png",
            ]);
        }

        $contactDatas = $request->input('contactDetails', []); // Assuming the input name is 'social_media'
    
        foreach ($contactDatas as $contactDat) {
            $contact->contactDetails()->create([
                'title' => $contactDat['title'],
                'details' => $contactDat['details'],
               
            ]);
        }
    
        return redirect()->route('admin.contacts.index')
            ->with('success', 'Contact created successfully.');
    }
    

    public function show(Contact $contact)
    {
        return view('admin.pages.contacts.show', compact('contact'));
    }

    public function edit(Contact $contact)
    {
        return view('admin.pages.contacts.edit', compact('contact'));
    }

    public function update(Request $request, Contact $contact)
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
            'username' => [
                'required',
                Rule::unique('contacts', 'username')->ignore($contact->id),
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
        
         if ($request->hasFile('profile_photo')) {
            $data['profile_photo'] = $request->file('profile_photo')->store('profile-photos', 'public');
        }
            
            if ($request->hasFile('cover_photo')) {
                $data['cover_photo'] = $request->file('cover_photo')->store('cover-photo', 'public');
            }
            
        //$data['password'] = Hash::make($validatedData['password']);
        $data['email'] = $validatedData['email_work'];

    
        $contact->update($data);
        
        
        $qrCodeData = 'https://tnscards.com/' . $contact->username;
        $qrCode = QrCode::size(120)->generate($qrCodeData);
        
        // Use 'svg' as the file extension for storing SVG files
        $qrCodePath = 'qrcodes/' . $contact->username . '.svg';
        
        // Ensure the 'qrcodes' directory exists in the 'public' disk
        Storage::disk('public')->makeDirectory('qrcodes');
        
        // Store the SVG QR code in storage
        Storage::disk('public')->put($qrCodePath, $qrCode);
        
        // Update the 'qr_code' field in the 'contacts' table with the relative path to the stored SVG QR code
        $contact->update(['qr_code' => $qrCodePath]);


    
        $socialMediaData = $request->input('social_media', []); // Assuming the input name is 'social_media'
        
       
    
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
    
    
        return redirect()->route('admin.contacts.index')
            ->with('success', 'Contact updated successfully.');
    }

    

   public function destroy(Contact $contact)
{
    $contact->delete();

    return response()->json(['success' => true]);
}

}
