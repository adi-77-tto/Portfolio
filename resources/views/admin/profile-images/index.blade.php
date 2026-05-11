@extends('layouts.app')

@section('content')
<style>
    .profile-images-container {
        background: var(--surface);
        border: 1px solid var(--line);
        border-radius: 16px;
        padding: 1.5rem;
    }

    .profile-images-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .profile-images-header h2 {
        margin: 0;
    }

    .add-image-btn {
        background: #0c7c59;
        color: white;
        border: none;
        padding: 0.6rem 1.2rem;
        border-radius: 10px;
        cursor: pointer;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .add-image-btn:hover {
        background: #095643;
    }

    .images-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 1rem;
    }

    .images-table thead {
        background: #f6f8f9;
        border-bottom: 2px solid var(--line);
    }

    .images-table th {
        padding: 1rem;
        text-align: left;
        font-weight: 600;
        color: var(--ink);
    }

    .images-table td {
        padding: 1rem;
        border-bottom: 1px solid var(--line);
    }

    .images-table tbody tr:hover {
        background: #f6f8f9;
    }

    .image-thumbnail {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
    }

    .description-text {
        color: var(--muted);
        max-width: 300px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .btn-edit, .btn-delete {
        border: none;
        padding: 0.5rem;
        border-radius: 6px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        transition: all 0.2s;
    }

    .btn-edit {
        background: #fbbf24;
        color: white;
    }

    .btn-edit:hover {
        background: #f59e0b;
    }

    .btn-delete {
        background: #ef4444;
        color: white;
    }

    .btn-delete:hover {
        background: #dc2626;
    }

    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        align-items: center;
        justify-content: center;
    }

    .modal.show {
        display: flex;
    }

    .modal-content {
        background-color: var(--surface);
        padding: 2rem;
        border-radius: 16px;
        width: 90%;
        max-width: 500px;
        border: 1px solid var(--line);
        position: relative;
    }

    .modal-header {
        font-size: 1.25rem;
        font-weight: bold;
        margin-bottom: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-close {
        background: none;
        border: none;
        font-size: 1.5rem;
        cursor: pointer;
        color: var(--muted);
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
    }

    .form-group input[type="file"],
    .form-group textarea {
        width: 100%;
        padding: 0.65rem;
        border: 1px solid var(--line);
        border-radius: 10px;
        font-family: inherit;
    }

    .form-group textarea {
        resize: vertical;
        min-height: 100px;
    }

    .preview-container {
        margin-bottom: 1rem;
        text-align: center;
    }

    .preview-image {
        max-width: 100%;
        max-height: 300px;
        border-radius: 8px;
        margin-bottom: 0.5rem;
    }

    .modal-actions {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        margin-top: 2rem;
    }

    .btn-submit, .btn-cancel {
        padding: 0.6rem 1.2rem;
        border-radius: 10px;
        border: none;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.2s;
    }

    .btn-submit {
        background: var(--accent);
        color: white;
    }

    .btn-submit:hover {
        background: #095643;
    }

    .btn-cancel {
        background: var(--line);
        color: var(--ink);
    }

    .btn-cancel:hover {
        background: #d9e2e9;
    }

    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
        color: var(--muted);
    }

    .empty-state-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
    }
</style>

<div class="card profile-images-container">
    <div class="profile-images-header">
        <h2>Profile Images</h2>
        <button class="add-image-btn" onclick="openAddModal()">
            <span>+</span> Add Image
        </button>
    </div>

    @if ($profileImages->count() > 0)
        <table class="images-table">
            <thead>
                <tr>
                    <th style="width: 100px;">SL.</th>
                    <th style="width: 120px;">Image</th>
                    <th>Description</th>
                    <th style="width: 150px;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($profileImages as $index => $image)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <img src="{{ asset($image->image_path) }}" alt="Profile Image" class="image-thumbnail">
                        </td>
                        <td>
                            <span class="description-text">{{ $image->description ?: '—' }}</span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-edit" onclick="openEditModal({{ $image->id }}, '{{ str_replace("'", "\\'", $image->description) }}')">
                                    ✎
                                </button>
                                <button class="btn-delete" onclick="deleteImage({{ $image->id }})">
                                    🗑
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="empty-state">
            <div class="empty-state-icon">📸</div>
            <p>No profile images yet. Click "Add Image" to get started!</p>
        </div>
    @endif
</div>

<!-- Add Image Modal -->
<div id="addModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <span>Add Profile Image</span>
            <button class="modal-close" onclick="closeAddModal()">&times;</button>
        </div>

        <div class="preview-container" id="addPreviewContainer" style="display: none;">
            <img id="addPreviewImage" class="preview-image" alt="Preview">
        </div>

        <form id="addForm" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="addImageInput">Image</label>
                <input type="file" id="addImageInput" name="image" accept="image/*" required onchange="previewAddImage(event)">
            </div>

            <div class="form-group">
                <label for="addDescriptionInput">Description (Optional)</label>
                <textarea id="addDescriptionInput" name="description" placeholder="Add a description for this image..."></textarea>
            </div>

            <div class="modal-actions">
                <button type="button" class="btn-cancel" onclick="closeAddModal()">Cancel</button>
                <button type="button" class="btn-submit" onclick="submitAddForm()">Add Image</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <span>Edit Description</span>
            <button class="modal-close" onclick="closeEditModal()">&times;</button>
        </div>

        <form id="editForm">
            <div class="form-group">
                <label for="editDescriptionInput">Description (Optional)</label>
                <textarea id="editDescriptionInput" name="description" placeholder="Add a description for this image..."></textarea>
            </div>

            <div class="modal-actions">
                <button type="button" class="btn-cancel" onclick="closeEditModal()">Cancel</button>
                <button type="button" class="btn-submit" onclick="submitEditForm()">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<script>
    let currentEditId = null;

    function openAddModal() {
        document.getElementById('addModal').classList.add('show');
    }

    function closeAddModal() {
        document.getElementById('addModal').classList.remove('show');
        document.getElementById('addForm').reset();
        document.getElementById('addPreviewContainer').style.display = 'none';
    }

    function previewAddImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('addPreviewImage').src = e.target.result;
                document.getElementById('addPreviewContainer').style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    }

    function submitAddForm() {
        const form = document.getElementById('addForm');
        const imageInput = document.getElementById('addImageInput');
        
        // Validate that an image is selected
        if (!imageInput.files || imageInput.files.length === 0) {
            alert('Please select an image');
            return;
        }

        const formData = new FormData(form);
        // Ensure CSRF token is included
        formData.append('_token', '{{ csrf_token() }}');
        
        fetch('{{ route("admin.profile-images.store") }}', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            console.log('Response status:', response.status);
            console.log('Response redirected:', response.redirected);
            
            // Check for success (2xx status or redirect)
            if (response.status < 400 || response.redirected) {
                closeAddModal();
                // Small delay to allow modal to close
                setTimeout(() => location.reload(), 300);
            } else {
                return response.json().then(data => {
                    const errorMsg = data.errors ? Object.values(data.errors).flat().join('\n') : response.statusText;
                    alert('Error: ' + errorMsg);
                    console.error('Server error:', data);
                }).catch(() => {
                    alert('Error adding image. Status: ' + response.status);
                });
            }
        })
        .catch(error => {
            console.error('Network error:', error);
            alert('Network error: ' + error.message);
        });
    }

    function openEditModal(id, description) {
        currentEditId = id;
        document.getElementById('editDescriptionInput').value = description;
        document.getElementById('editModal').classList.add('show');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.remove('show');
        currentEditId = null;
    }

    function submitEditForm() {
        const formData = new FormData();
        formData.append('description', document.getElementById('editDescriptionInput').value);
        formData.append('_method', 'PUT');
        formData.append('_token', '{{ csrf_token() }}');

        fetch(`{{ url('/admin/profile-images') }}/${currentEditId}`, {
            method: 'POST',
            body: formData
        })
        .then(response => {
            console.log('Update response status:', response.status);
            
            if (response.status < 400 || response.redirected) {
                closeEditModal();
                setTimeout(() => location.reload(), 300);
            } else {
                return response.json().then(data => {
                    const errorMsg = data.errors ? Object.values(data.errors).flat().join('\n') : response.statusText;
                    alert('Error: ' + errorMsg);
                }).catch(() => {
                    alert('Error updating image. Status: ' + response.status);
                });
            }
        })
        .catch(error => {
            console.error('Network error:', error);
            alert('Network error: ' + error.message);
        });
    }

    function deleteImage(id) {
        if (confirm('Are you sure you want to delete this image?')) {
            const formData = new FormData();
            formData.append('_method', 'DELETE');
            formData.append('_token', '{{ csrf_token() }}');

            fetch(`{{ url('/admin/profile-images') }}/${id}`, {
                method: 'POST',
                body: formData
            })
            .then(response => {
                console.log('Delete response status:', response.status);
                
                if (response.status < 400 || response.redirected) {
                    setTimeout(() => location.reload(), 300);
                } else {
                    return response.json().then(data => {
                        const errorMsg = data.errors ? Object.values(data.errors).flat().join('\n') : response.statusText;
                        alert('Error: ' + errorMsg);
                    }).catch(() => {
                        alert('Error deleting image. Status: ' + response.status);
                    });
                }
            })
            .catch(error => {
                console.error('Network error:', error);
                alert('Network error: ' + error.message);
            });
        }
    }

    // Close modal when clicking outside
    document.getElementById('addModal').addEventListener('click', function(event) {
        if (event.target === this) {
            closeAddModal();
        }
    });

    document.getElementById('editModal').addEventListener('click', function(event) {
        if (event.target === this) {
            closeEditModal();
        }
    });
</script>
@endsection
