<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Contact extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'contact';

    protected $guarded = [];

    public $timestamps = true;

    // Relationships
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function socialMedia()
    {
        return $this->hasMany(ContactSocialMedia::class);
    }

    public function contactDetails()
    {
        return $this->hasMany(ContactDetails::class);
    }

    // Accessors
    public function getProfilePhotoUrlAttribute()
    {
        $value = $this->profile_photo;

        if ($value) {
            $baseUrl = 'https://tnscards.com/tns/storage/app/public/';
            return $baseUrl . $value;
        }

        return null;
    }

    public function getCoverPhotoUrlAttribute()
    {
        $value = $this->cover_photo;

        if ($value) {
            $baseUrl = 'https://tnscards.com/tns/storage/app/public/';
            return $baseUrl . $value;
        }

        return null;
    }

    public function getQrCodeUrlAttribute()
    {
        $value = $this->qr_code;

        if ($value) {
            $baseUrl = 'https://tnscards.com/tns/storage/app/public/';
            return $baseUrl . $value;
        }

        return null;
    }

    // Attributes to be appended to the JSON output
    protected $appends = ['profilePhotoUrl', 'CoverPhotoUrl', 'qrCodeUrl'];

    

    // Use the email field for authentication
    public function getEmailForPasswordReset()
    {
        return $this->email;
    }
}
