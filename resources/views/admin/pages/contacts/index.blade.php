@extends('layout.master')

@section('content')
    @if (session('success') || session('error'))
        <div class="alert alert-{{ session('success') ? 'success' : 'danger' }} alert-dismissible fade show" role="alert">
            {{ session('success') ?? session('error') }}
            <button type="button" class="btn close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <h6 class="card-title">Contacts</h6>
                </div>
                <div class="col-md-9 text-end">
                    <a href="{{ route('admin.contacts.create') }}" class="btn btn-primary mb-3">Create Contact</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped" id="contacts-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Views</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                            <th>Copy Link</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
<!-- Add this in the head section of your HTML -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>

<script>
    $(document).ready(function() {
     $('#contacts-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.contacts.getContacts') }}",
            columns: [
                { data: 'sl_no', name: 'sl_no' },
                { data: 'first_name', name: 'first_name' },
                { data: 'last_name', name: 'last_name' },
                { data: 'email_work', name: 'email_work' },
                { data: 'views', name: 'views' },
                {
                    data: null,
                    name: 'status',
                    render: function(data, type, row, meta) {
                        return `
                            <div class="mb-3 col-md-2">
                                <div class="form-check form-switch mb-2">
                                    <input type="checkbox" class="form-check-input my-2 toggle-status" id="formSwitch${data.id}" ${data.status == 1 ? 'checked' : ''} data-id="${data.id}">
                                </div>
                            </div>
                        `;
                    }
                },
                { data: 'formatted_created_at', name: 'formatted_created_at' },
                { 
                    data: 'id',
                    name: 'actions',
                    render: function(data, type, row) {
                        const viewUrl = `{{ route('admin.contacts.show', ':id') }}`.replace(':id', data);
                        const editUrl = `{{ route('admin.contacts.edit', ':id') }}`.replace(':id', data);

                        return `
                            <a href="${viewUrl}" class="btn btn-success btn-sm">View</a>
                            <a href="${editUrl}" class="btn btn-warning btn-sm">Edit</a>
                            <button class="btn btn-danger btn-sm delete-contact" data-id="${data}">Delete</button>
                        `;
                    }
                },
                { 
                    data: null,
                    render: function(data, type, row) {
                        console.log(data)
                        return '<button class="btn btn-secondary btn-sm copy-link" data-clipboard-text="https://tnscards.com/' + data.username + '">Link</button>';
                    }
                }
            ]
        });

        // Initialize ClipboardJS for the "Click to Copy" button
        var clipboard = new ClipboardJS('.copy-link');

        clipboard.on('success', function(e) {
            e.clearSelection();
            alert('Link copied to clipboard!');
        });

        clipboard.on('error', function(e) {
            console.error('Error copying link to clipboard:', e);
        });
    
    $(document).on('click', '.delete-contact', function() {
            const contactId = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this contact!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Continue with the delete action
                    const csrfToken = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        type: 'POST', // Change to POST if needed
                        url: `{{ route('admin.contacts.destroy', ['contact' => ':id']) }}`.replace(':id', contactId),
                        data: {
                            _token: csrfToken,
                            _method: 'DELETE'
                        },
                        success: function(data) {
                            if (data.success) {
                                Swal.fire('Deleted!', 'The contact has been deleted.', 'success');
                                // Optionally, you can update the DataTable to reflect the deletion
                                $('#contacts-table').DataTable().ajax.reload();
                            } else {
                                Swal.fire('Error', 'Failed to delete contact.', 'error');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }
            });
        });

     $(document).on('change', '.toggle-status', function() {
    const contactId = $(this).data('id');
    
    // Get the CSRF token from the meta tag
    const csrfToken = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        type: 'PUT',
        url: `{{ route('admin.contacts.toggleStatus', ['contact' => ':id']) }}`.replace(':id', contactId),
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        success: function(data) {
            if (data.message === 'Status updated successfully') {
                // Handle success, for example, show a success message or update the UI
                Swal.fire('Status Updated', 'Contact status has been updated.', 'success');
            } else {
                // Handle failure, show an error message or handle the error as needed
                Swal.fire('Error', 'Failed to update contact status.', 'error');
            }
        },
        error: function(xhr, status, error) {
            // Handle AJAX error, show an error message or log the error
            console.error(xhr.responseText);
        }
    });
});


        // Rest of your toggle-status and Swal code
        // ...

    });
</script>
<!-- Include your necessary JavaScript libraries here, like jQuery, DataTables, and Swal -->
@endpush

@push('scripts')
   
@endpush
