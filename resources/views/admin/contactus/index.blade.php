@extends('layouts.master')

@section('title', 'Messages')

@section('content')

<div class="container-fluid px-4">
    <div class="admin-card mt-4">
        <div class="admin-card-header d-flex justify-content-between align-items-center">
            <h4 class="admin-card-title">User Messages</h4>
        </div>
        <div class="admin-card-body">
            <table id="messagesTable"
                class="admin-table dataTable table table-bordered table-hover text-center align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($messages as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->user->first_name . ' ' . $item->user->last_name }}</td>
                        <td>{{ $item->user->email }}</td>
                        <td>{{ $item->subject }}</td>
                        <td>{{ Str::limit($item->message, 50) }}</td>
                        <td>
                            <!-- View Modal Trigger -->
                            <a href="#" class="text-success mx-2" title="View Message" data-bs-toggle="modal"
                                data-bs-target="#viewMessageModal{{ $item->id }}">
                                <i class="fas fa-eye fa-lg"></i>
                            </a>
                        </td>
                    </tr>
                    <!-- View Message Modal -->
                    <div class="modal fade" id="viewMessageModal{{ $item->id }}" tabindex="-1"
                        aria-labelledby="viewMessageModalLabel{{ $item->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="viewMessageModalLabel{{ $item->id }}">View Message</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Subject:</strong> {{ $item->subject }}</p>
                                    <p><strong>Message:</strong> {{ $item->message }}</p>
                                    <p><strong>Sent by:</strong> {{ $item->user->first_name }}
                                        {{ $item->user->last_name }}</p>
                                    <p><strong>Email:</strong> {{ $item->user->email }}</p>
                                    <p><strong>Sent On:</strong> {{ $item->created_at->format('d M, Y H:i A') }}</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary"
                                        onclick="markAsRead({{ $item->id }})">Mark as Read</button>
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="6">No messages found</td>
                    </tr>
                    @endforelse
                </tbody>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
// Mark as Read Function
function markAsRead(messageId) {
    fetch(`/admin/contactus/${messageId}/mark-read`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                _method: 'PUT'
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Message marked as read');
                var modal = document.getElementById('viewMessageModal' + messageId);
                var modalInstance = bootstrap.Modal.getInstance(modal);
                modalInstance.hide();
            } else {
                alert('Error marking message as read');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}
</script>
@endsection