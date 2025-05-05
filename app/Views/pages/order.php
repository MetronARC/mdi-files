<?= $this->extend('layout/index') ?>
<?= $this->section('page-content') ?>

<!-- Add SweetAlert CSS and JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
<!-- Add Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<!-- Add Select2 for better dropdown experience -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- Add DataTables CSS and JS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

<style>
    /* Card styles */
    .card {
        border: none;
        border-radius: 10px;
    }

    .card-header {
        border-bottom: 1px solid rgba(0, 0, 0, .125);
        border-top-left-radius: 10px !important;
        border-top-right-radius: 10px !important;
    }

    .card-body {
        background-color: #f8f9fa;
    }

    /* Form styles */
    .form-group {
        background-color: #fff;
        padding: 1.25rem;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .form-label {
        color: #495057;
        margin-bottom: 1rem;
    }

    .select-container {
        position: relative;
        min-height: 42px;
        margin: 0;
    }

    .select2-container {
        width: 100% !important;
        display: block;
    }

    /* Select2 Styles */
    .select2-container--bootstrap-5 {
        display: block;
    }

    .select2-container--bootstrap-5 .select2-selection {
        border: 1px solid #ced4da;
        border-radius: 6px;
        min-height: 42px;
        background-color: #fff;
        display: flex;
        align-items: center;
    }

    .select2-container--bootstrap-5 .select2-selection--single {
        padding: 0;
    }

    .select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered {
        color: #212529;
        line-height: 42px;
        padding: 0 0.75rem;
        margin: 0;
        width: 100%;
    }

    .select2-container--bootstrap-5 .select2-selection--single .select2-selection__placeholder {
        color: #6c757d;
    }

    .select2-container--bootstrap-5 .select2-selection--single .select2-selection__clear {
        position: absolute;
        right: 2.5rem;
        top: 50%;
        transform: translateY(-50%);
        width: 1rem;
        height: 1rem;
        padding: 0;
        border: 0;
        margin: 0;
        background-color: transparent;
        color: #6c757d;
        cursor: pointer;
        opacity: 0.6;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 2;
    }

    .select2-container--bootstrap-5 .select2-selection--single .select2-selection__clear:hover {
        opacity: 1;
    }

    .select2-container--bootstrap-5 .select2-selection--single .select2-selection__arrow {
        position: absolute;
        right: 0.75rem;
        top: 50%;
        transform: translateY(-50%);
        width: 1rem;
        height: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .select2-container--bootstrap-5 .select2-selection--single .select2-selection__arrow b {
        border-color: #6c757d transparent transparent transparent;
        border-style: solid;
        border-width: 0.3rem 0.3rem 0 0.3rem;
        height: 0;
        width: 0;
        margin: 0;
    }

    .select2-container--bootstrap-5.select2-container--open .select2-selection--single .select2-selection__arrow b {
        border-color: transparent transparent #6c757d transparent;
        border-width: 0 0.3rem 0.3rem 0.3rem;
    }

    /* Dropdown styles */
    .select2-container--bootstrap-5 .select2-dropdown {
        border: 1px solid #ced4da;
        border-radius: 6px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-top: 4px;
        background-color: #fff;
    }

    .select2-container--bootstrap-5 .select2-results__option {
        padding: 0.5rem 0.75rem;
        color: #212529;
    }

    .select2-container--bootstrap-5 .select2-results__option--highlighted[aria-selected] {
        background-color: #f8f9fa;
        color: #16181b;
    }

    .select2-container--bootstrap-5 .select2-results__option[aria-selected=true] {
        background-color: #e9ecef;
        color: #000;
        font-weight: 500;
    }

    .select2-container--bootstrap-5 .select2-search--dropdown {
        padding: 0.5rem;
    }

    .select2-container--bootstrap-5 .select2-search--dropdown .select2-search__field {
        border: 1px solid #ced4da;
        border-radius: 4px;
        padding: 0.375rem 0.75rem;
    }

    /* Status container alignment */
    .status-container {
        display: flex;
        align-items: center;
        min-height: 42px;
        padding: 0;
    }

    /* Badge styles */
    .status-badge {
        font-size: 0.875rem;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        font-weight: 500;
        letter-spacing: 0.3px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        border: 1px solid transparent;
        white-space: nowrap;
        display: inline-flex;
        align-items: center;
    }

    .status-badge i {
        font-size: 1rem;
        margin-right: 0.5rem;
    }

    .status-badge.bg-warning {
        background-color: #fff5d9 !important;
        color: #9a6700;
        border-color: #ffc107;
    }

    .status-badge.bg-info {
        background-color: #e8f4f8 !important;
        color: #0c5460;
        border-color: #17a2b8;
    }

    .status-badge.bg-primary {
        background-color: #e7f1ff !important;
        color: #004085;
        border-color: #007bff;
    }

    .status-badge.bg-success {
        background-color: #e8f6ee !important;
        color: #155724;
        border-color: #28a745;
    }

    .status-badge.bg-danger {
        background-color: #fbe7e9 !important;
        color: #721c24;
        border-color: #dc3545;
    }

    .status-badge.bg-secondary {
        background-color: #e9ecef !important;
        color: #383d41;
        border-color: #6c757d;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .select-container {
            height: 38px;
        }

        .select2-container--bootstrap-5 .select2-selection {
            height: 38px;
        }

        .status-container {
            height: 38px;
        }

        .status-badge {
            font-size: 0.8125rem;
            padding: 0.375rem 0.75rem;
        }

        .status-badge i {
            font-size: 0.875rem;
        }
    }

    /* Add specific styling for Select2 dropdown */
    #projectCodeContainer {
        position: relative;
    }

    .select2-container--bootstrap-5 .select2-dropdown {
        border-color: #ced4da;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .select2-container--bootstrap-5 .select2-results__option {
        padding: 0.5rem 0.75rem;
    }

    .select2-container--bootstrap-5 .select2-results__option--highlighted[aria-selected] {
        background-color: #e9ecef;
        color: #000;
    }
</style>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">
                        <i class="fas fa-project-diagram me-2"></i>
                        Project Details
                    </h4>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProjectDocumentModal">
                        <i class="fas fa-plus me-2"></i>Add
                    </button>
                </div>
                <div class="card-body p-4">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="form-group h-100">
                                <label for="projectCode" class="form-label fw-bold mb-2">
                                    <i class="fas fa-code me-1"></i>
                                    Select Project Code:
                                </label>
                                <div class="select-container" id="projectCodeContainer">
                                    <select class="form-control select2" id="projectCode" name="projectCode">
                                        <option value="">Select a project code...</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group h-100">
                                <label class="form-label fw-bold mb-2">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Project Status:
                                </label>
                                <div id="projectStatus" class="select-container">
                                    <div class="status-container">
                                        <span class="badge bg-secondary status-badge">No project selected</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Project Documents Section -->
    <div class="row mt-4" id="documentsSection" style="display: none;">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3">
                    <h4 class="card-title mb-0">
                        <i class="fas fa-file-alt me-2"></i>
                        Project Documents
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="documentsTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Project Code</th>
                                    <th>Document Type</th>
                                    <th>Document Name</th>
                                    <th>Revision Status</th>
                                    <th>Project Name</th>
                                    <th>Project Description</th>
                                    <th>Project Attention</th>
                                    <th>Willing to Pay</th>
                                    <th>Documents</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Project Document Modal -->
<div class="modal fade" id="addProjectDocumentModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Project Document</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <!-- Initial buttons -->
                <div id="documentChoiceButtons" class="text-center mb-4">
                    <button type="button" class="btn btn-primary me-3" id="existingProjectBtn">
                        <i class="fas fa-folder-open me-2"></i>Insert from Available Project
                    </button>
                    <button type="button" class="btn btn-success" id="newProjectBtn">
                        <i class="fas fa-plus me-2"></i>Create New Project
                    </button>
                </div>

                <!-- Existing Project Form -->
                <form id="existingProjectForm" style="display: none;">
                    <div class="form-group mb-3">
                        <label for="existing-project-code">Project Code</label>
                        <select class="form-control select2" id="existing-project-code" name="project_code" required>
                            <option value="">Select Project Code</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="existing-document-type">Document Type</label>
                        <select class="form-control" id="existing-document-type" name="document_type" required>
                            <option value="">Select Document Type</option>
                            <option value="QUOTATION">QUOTATION</option>
                            <option value="INVOICE">INVOICE</option>
                            <option value="PURCHASE ORDER">PURCHASE ORDER</option>
                            <option value="TRANSFER RECEIPT">TRANSFER RECEIPT</option>
                            <option value="NDA">NDA</option>
                            <option value="REPORT">REPORT</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="existing-document-name">Document Name</label>
                        <input type="text" class="form-control" id="existing-document-name" name="document_name" placeholder="Enter document name" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="existing-revision-status">Revision Status</label>
                        <input type="text" class="form-control" id="existing-revision-status" name="revision_status" placeholder="Enter revision status" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="existing-document">Document (PDF)</label>
                        <input type="file" class="form-control" id="existing-document" name="document" accept=".pdf" required>
                    </div>
                </form>

                <!-- New Project Form -->
                <form id="newProjectForm" style="display: none;">
                    <div class="row">
                        <div class="col-12">
                            <h6 class="mb-3">Project Details</h6>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="new-project-code">Project Code</label>
                                <input type="text" class="form-control" id="new-project-code" name="project_code" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="new-project-name">Project Name</label>
                                <input type="text" class="form-control" id="new-project-name" name="project_name" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="new-project-description">Project Description</label>
                                <textarea class="form-control" id="new-project-description" name="project_description" rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="new-project-attention">Project Attention</label>
                                <input type="text" class="form-control" id="new-project-attention" name="project_attention" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="new-project-wtp">Client Willing to Pay</label>
                                <input type="number" class="form-control" id="new-project-wtp" name="project_wtp" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="new-document-type">Document Type</label>
                                <select class="form-control" id="new-document-type" name="document_type" required>
                                    <option value="">Select Document Type</option>
                                    <option value="QUOTATION">QUOTATION</option>
                                    <option value="INVOICE">INVOICE</option>
                                    <option value="PURCHASE ORDER">PURCHASE ORDER</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="new-document">Document (PDF)</label>
                                <input type="file" class="form-control" id="new-document" name="document" accept=".pdf" required>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="submitDocument" style="display: none;">Upload Document</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Initialize Select2 for main project code dropdown
        $('#projectCode').select2({
            theme: 'bootstrap-5',
            width: '100%',
            placeholder: 'Select a project code...',
            allowClear: true,
            dropdownParent: $('#projectCodeContainer')
        });

        // Initialize Select2 for modal project code dropdown
        $('#existing-project-code').select2({
            theme: 'bootstrap-5',
            width: '100%',
            placeholder: 'Select a project code...',
            allowClear: true,
            dropdownParent: $('#addProjectDocumentModal')
        });

        let documentsTable;

        // Load project codes on page load
        loadProjectCodes();

        // Handle project selection change
        $('#projectCode').on('change', function() {
            const selectedProject = $(this).val();
            if (selectedProject) {
                fetchProjectStatus(selectedProject);
                loadProjectDocuments(selectedProject);
            } else {
                $('#projectStatus').html(`
                <div class="status-container">
                    <span class="badge bg-secondary status-badge">No project selected</span>
                </div>
            `);
                $('#documentsSection').hide();
            }
        });

        function loadProjectCodes() {
            $.ajax({
                url: '<?= base_url('project/getProjectCodes') ?>',
                type: 'GET',
                success: function(response) {
                    if (response.success) {
                        const select = $('#projectCode');
                        select.empty().append('<option value="">Select a project code...</option>');

                        response.data.forEach(function(project) {
                            select.append(new Option(project.project_code, project.project_code));
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to load project codes'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to connect to server: ' + error
                    });
                }
            });
        }

        function loadProjectDocuments(projectCode) {
            $('#documentsSection').show();
            
            if (documentsTable) {
                documentsTable.destroy();
            }

            documentsTable = $('#documentsTable').DataTable({
                ajax: {
                    url: '<?= base_url('project/getProjectDocuments') ?>',
                    type: 'POST',
                    data: function(d) {
                        d.project_code = projectCode;
                    },
                    dataSrc: function(response) {
                        return response.success ? response.data : [];
                    }
                },
                columns: [
                    { data: 'project_code' },
                    { data: 'document_type' },
                    { data: 'document_name' },
                    { data: 'revision_status' },
                    { data: 'project_name' },
                    { data: 'project_description' },
                    { data: 'project_attention' },
                    { data: 'project_wtp' },
                    { 
                        data: 'document_route',
                        render: function(data, type, row) {
                            if (data) {
                                return '<button class="btn btn-sm btn-info view-document" data-filename="' + data + '">' +
                                       '<i class="fas fa-eye me-2"></i>View</button>';
                            }
                            return 'No document';
                        }
                    }
                ]
            });

            // Add click handler for view document buttons
            $('#documentsTable').on('click', '.view-document', function() {
                const filename = $(this).data('filename');
                // Create a form dynamically
                const form = $('<form>', {
                    'method': 'POST',
                    'action': '<?= base_url('project/viewDocument') ?>',
                    'target': '_blank'
                });

                // Add filename input
                $('<input>', {
                    'type': 'hidden',
                    'name': 'filename',
                    'value': filename
                }).appendTo(form);

                // Add form to body, submit it, and remove it
                form.appendTo('body').submit().remove();
            });
        }

        function fetchProjectStatus(projectCode) {
            var formData = $('#tokenForm').serialize();
            formData += '&project_code=' + encodeURIComponent(projectCode);

            $.ajax({
                url: '<?= base_url('project/get-project-status') ?>',
                type: 'POST',
                data: formData,
                success: function(response) {
                    if (response.success) {
                        let badgeClass = '';
                        switch (response.data.project_status) {
                            case 'Waiting Quotation':
                                badgeClass = 'bg-warning text-dark';
                                break;
                            case 'Waiting P.O.':
                                badgeClass = 'bg-info';
                                break;
                            case 'Waiting Down Payment':
                                badgeClass = 'bg-primary';
                                break;
                            case 'Waiting UAT Payment':
                                badgeClass = 'bg-info';
                                break;
                            case 'Waiting Final Payment':
                                badgeClass = 'bg-warning text-dark';
                                break;
                            case 'Done':
                                badgeClass = 'bg-success';
                                break;
                            case 'Cancel / Void':
                                badgeClass = 'bg-danger';
                                break;
                            default:
                                badgeClass = 'bg-secondary';
                        }
                        $('#projectStatus').html(`
                        <div class="status-container">
                            <span class="badge ${badgeClass} status-badge">
                                <i class="fas ${getStatusIcon(response.data.project_status)} me-2"></i>
                                ${response.data.project_status}
                            </span>
                        </div>
                    `);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to load project status'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to connect to server: ' + error
                    });
                }
            });
        }

        function getStatusIcon(status) {
            switch (status) {
                case 'Waiting Quotation':
                    return 'fa-file-invoice-dollar';
                case 'Waiting P.O.':
                    return 'fa-file-contract';
                case 'Waiting Down Payment':
                    return 'fa-money-bill-wave';
                case 'Waiting UAT Payment':
                    return 'fa-clipboard-check';
                case 'Waiting Final Payment':
                    return 'fa-money-check-alt';
                case 'Done':
                    return 'fa-check-circle';
                case 'Cancel / Void':
                    return 'fa-times-circle';
                default:
                    return 'fa-question-circle';
            }
        }

        // Reset modal state when closing
        $('#addProjectDocumentModal').on('hidden.bs.modal', function () {
            // Hide forms and show initial buttons
            $('#existingProjectForm').hide();
            $('#newProjectForm').hide();
            $('#documentChoiceButtons').show();
            $('#submitDocument').hide();
            
            // Reset form values
            $('#existingProjectForm')[0].reset();
            $('#newProjectForm')[0].reset();
            
            // Reset Select2
            $('#existing-project-code').val(null).trigger('change');
        });

        // Show existing project form
        $('#existingProjectBtn').click(function() {
            $('#documentChoiceButtons').hide();
            $('#existingProjectForm').show();
            $('#newProjectForm').hide();
            $('#submitDocument').show();
            
            // Load project codes
            $.ajax({
                url: '<?= base_url('project/getProjectCodes') ?>',
                type: 'GET',
                success: function(response) {
                    if (response.success) {
                        const select = $('#existing-project-code');
                        select.empty().append('<option value="">Select a project code...</option>');

                        response.data.forEach(function(project) {
                            select.append(new Option(project.project_code, project.project_code));
                        });
                        
                        // Trigger change event to refresh Select2
                        select.trigger('change');
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to load project codes'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to connect to server: ' + error
                    });
                }
            });
        });

        // Show new project form
        $('#newProjectBtn').click(function() {
            $('#documentChoiceButtons').hide();
            $('#existingProjectForm').hide();
            $('#newProjectForm').show();
            $('#submitDocument').show();
        });

        // Handle form submission
        $('#submitDocument').click(function() {
            const isNewProject = $('#newProjectForm').is(':visible');
            const form = isNewProject ? $('#newProjectForm') : $('#existingProjectForm');
            const formData = new FormData(form[0]);
            
            const url = isNewProject ? 
                '<?= base_url('project/create-with-document') ?>' : 
                '<?= base_url('project/upload-document') ?>';

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if(response.success) {
                        // Show success message
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            // Refresh the page after the success message
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: response.message
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Error uploading document: ' + error
                    });
                }
            });
        });
    });
</script>

<?= $this->endSection() ?>