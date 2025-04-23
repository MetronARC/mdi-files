<?= $this->extend('layout/index') ?>
<?= $this->section('page-content') ?>

<!-- Add SweetAlert CSS and JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
<!-- Add Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Operational Procedures</h4>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDocumentModal">
                        <i class="fas fa-plus me-2"></i>Add
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Operational Procedures List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="documentsTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Document Number</th>
                                    <th>Document Name</th>
                                    <th>Effective Date</th>
                                    <th>Revision Status</th>
                                    <th>Document</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Document Modal -->
<div class="modal fade" id="addDocumentModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Operational Procedure</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="uploadForm" enctype="multipart/form-data">
                    <div class="form-group mb-3">
                        <label for="document-number">Document Number</label>
                        <input type="text" class="form-control" id="document-number" name="document-number" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="document-name">Document Name</label>
                        <input type="text" class="form-control" id="document-name" name="document-name" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="effective-date">Effective Date</label>
                        <input type="date" class="form-control" id="effective-date" name="effective-date" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="revision-status">Revision Status</label>
                        <input type="text" class="form-control" id="revision-status" name="revision-status" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="document">Document (PDF)</label>
                        <input type="file" class="form-control" id="document" name="document" accept=".pdf" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="submitDocument">Upload Document</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Document</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" enctype="multipart/form-data">
                    <input type="hidden" id="edit-id" name="id">
                    <div class="form-group mb-3">
                        <label for="edit-document-number">Document Number</label>
                        <input type="text" class="form-control" id="edit-document-number" name="document-number" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="edit-document-name">Document Name</label>
                        <input type="text" class="form-control" id="edit-document-name" name="document-name" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="edit-effective-date">Effective Date</label>
                        <input type="date" class="form-control" id="edit-effective-date" name="effective-date" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="edit-revision-status">Revision Status</label>
                        <input type="text" class="form-control" id="edit-revision-status" name="revision-status" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="edit-document">Document (PDF - Optional)</label>
                        <input type="file" class="form-control" id="edit-document" name="document" accept=".pdf">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveEdit">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Handle form submission
    $('#submitDocument').click(function(e) {
        e.preventDefault();
        
        var formData = new FormData($('#uploadForm')[0]);
        
        $.ajax({
            url: '<?= base_url('document/store') ?>',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if(response.status === 'success') {
                    // Hide modal and reset form
                    $('#addDocumentModal').modal('hide');
                    $('#uploadForm')[0].reset();
                    
                    // Show success message with SweetAlert
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Document uploaded successfully',
                        timer: 2000,
                        showConfirmButton: false
                    });
                    
                    // Refresh the table
                    $('#documentsTable').DataTable().ajax.reload();
                } else {
                    // Show error message with SweetAlert
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: response.message
                    });
                }
            },
            error: function(xhr, status, error) {
                // Show error message with SweetAlert
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Error uploading document: ' + error
                });
            }
        });
    });

    // Initialize DataTable
    $('#documentsTable').DataTable({
        ajax: {
            url: '<?= base_url('document/list') ?>',
            type: 'GET',
            dataSrc: 'data'
        },
        columns: [
            { data: 'document-number' },
            { data: 'document-name' },
            { data: 'effective-date' },
            { data: 'revision-status' },
            { 
                data: 'document-route',
                render: function(data, type, row) {
                    return '<form action="<?= base_url('document/view') ?>" method="post" target="_blank" style="display:inline;">' +
                           '<input type="hidden" name="filename" value="' + data + '">' +
                           '<button type="submit" class="btn btn-sm btn-info"><i class="fas fa-eye me-2"></i>View</button>' +
                           '</form>';
                }
            },
            {
                data: 'id',
                render: function(data, type, row) {
                    return '<button class="btn btn-sm btn-danger delete-btn" data-id="' + data + '">' +
                           '<i class="fas fa-trash-alt me-2"></i>Delete</button>';
                }
            }
        ]
    });

    // Handle delete button click
    $('#documentsTable').on('click', '.delete-btn', function() {
        var id = $(this).data('id');
        console.log('Deleting document with ID:', id); // Add this for debugging
        
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url('document/delete') ?>',
                    type: 'POST',
                    data: { id: id },
                    success: function(response) {
                        if(response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: 'Document has been deleted.',
                                timer: 2000,
                                showConfirmButton: false
                            });
                            
                            // Refresh the table
                            $('#documentsTable').DataTable().ajax.reload();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: response.message
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Delete error:', error); // Add this for debugging
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Error deleting document: ' + error
                        });
                    }
                });
            }
        });
    });
});
</script>

<?= $this->endSection() ?>