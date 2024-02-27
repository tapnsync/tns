@extends('user_profile.layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .card {
            margin-top: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-title {
            font-size: 2rem;
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }

        .cover-photo {
            width: 100%;
            height: 200px; /* Fixed height for the cover photo */
            object-fit: cover;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .profile-photo-container {
            text-align: center;
            margin-top: -50px; /* Adjust as needed */
        }

        .profile-photo {
            border-radius: 50%;
            border: 5px solid #fff;
            max-width: 150px;
            max-height: 150px;
            margin-bottom: 20px;
        }

        .name {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
        }

        .link-to-website {
            color: #007bff;
            text-decoration: underline;
            cursor: pointer;
        }

        .link-to-website:hover {
            color: #0056b3;
        }

        .contact-details {
            margin-top: 20px;
            padding: 20px;
            border-radius: 10px;
            background-color: #f8f9fa;
        }

        .contact-detail {
            margin-bottom: 15px;
        }

        .detail-label {
            font-weight: bold;
            margin-right: 10px;
            color: #333;
        }

        .detail-value {
            color: #666;
        }

        .social-media-icons {
            margin-top: 10px;
        }

        .social-media-icons i {
            font-size: 24px;
            margin-right: 10px;
            color: #007bff;
        }

        .map-icon {
            font-size: 24px;
            margin-right: 10px;
            color: #007bff;
        }

        .qr-code {
            text-align: center;
            margin-top: 20px;
        }

        /* Add more styles as needed */
    </style>
@endpush

@section('content')
<div class="card">
    <img src="{{ $contact->cover_photo_url }}" alt="Cover Photo" class="cover-photo">

    <div class="card-body">
        <div class="profile-photo-container">
            <!-- Profile Photo -->
            <img src="{{ $contact->profile_photo_url }}" alt="Profile Photo" class="profile-photo">
            <div class="name">
                {{ $contact->first_name }} {{ $contact->last_name }}
            </div>
            <div class="link-to-website">
                <a href="https://tnscards.com/{{ $contact->username }}" target="_blank">
                    https://tnscards.com/{{ $contact->username }}
                </a>
            </div>
        </div>

        <div class="contact-details">
            <!-- Contact Details -->
            <div class="contact-detail">
                <span class="detail-label">Email:</span>
                <span class="detail-value">{{ $contact->email_work }}</span>
            </div>
            <div class="contact-detail">
                <span class="detail-label">Phone:</span>
                <span class="detail-value">{{ $contact->phone_work }}</span>
            </div>
            
            <div class="contact-detail">
                <span class="detail-label">Designation:</span>
                <span class="detail-value">{{ $contact->designation }}</span>
            </div>
            <div class="contact-detail">
                <span class="detail-label">Employee Number:</span>
                <span class="detail-value">{{ $contact->employee_number }}</span>
            </div>
            <div class="contact-detail">
                <span class="detail-label">Address:</span>
                <span class="detail-value">{{ $contact->address }}</span>
            </div>

            <!-- Map with icon -->
            <div class="contact-detail">
                <span class="detail-label">Map:</span>
                <span class="detail-value">
                    <i class="fas fa-map-marker-alt map-icon"></i>
                    <!-- You can embed a map here or provide a link to the location -->
                    <!-- Example: <a href="https://www.google.com/maps?q={{ $contact->latitude }},{{ $contact->longitude }}" target="_blank">View on Map</a> -->
                </span>
            </div>

            <!-- Social Media -->
            <div class="social-media-icons">
                @forelse ($contact->socialMedia as $socialMedia)
                    <a href="{{ $socialMedia->link }}" target="_blank" title="{{ $socialMedia->platform }}">
                        <i class="fab fa-{{ strtolower($socialMedia->platform) }}"></i>
                    </a>
                @empty
                    <p>No social media information available.</p>
                @endforelse
            </div>

        </div>

        <!-- QR Code -->
        <!--<div class="qr-code">-->
        <!--    <img src="{{ $contact->qr_code_url }}" alt="QR Code" style="max-width: 150px;">-->
        <!--</div>-->
    </div>
</div>
@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker.js') }}"></script>
@endpush
