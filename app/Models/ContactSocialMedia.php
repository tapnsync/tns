<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactSocialMedia extends Model
{
    protected $guarded = [];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
    // Define an accessor for the icon URL
    public function getIconAttribute()
    {
        // Assuming the 'icon' field stores the relative path to the icon image
        $iconPath = $this->attributes['icon'];

        if ($iconPath) {
            return 'icon/' . $iconPath;
        }

        // If no icon path is set, return a default or empty URL
        return '';
    }
    
     // Accessor for profile photo URL with the name "profilePhotoUrl"
    public function getIconUrlAttribute()
    {
        $value = strtolower($this->icon);
        // Check if the profile photo field is not empty
        if ($value) {
            // Define the base URL for the profile photo
            $baseUrl = 'https://tnscards.com/tns/';
    
            // Append the base URL to the profile photo path
            return $baseUrl . $value;
        }
    
        return null;
    }

    // Define the attributes to be appended to the JSON output
    protected $appends = ['IconUrl'];
}
