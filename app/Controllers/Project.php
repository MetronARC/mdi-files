<?php

namespace App\Controllers;

class Project extends BaseController
{
    protected $db;
    protected $uploadPath;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->uploadPath = FCPATH . 'order';
    }

    public function getProjectCodes()
    {
        try {
            $query = $this->db->table('project_code_list')
                             ->select('project_code')
                             ->get();

            $result = $query->getResult();

            if ($result) {
                return $this->response->setJSON([
                    'success' => true,
                    'data' => $result
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'No project codes found'
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Database error: ' . $e->getMessage()
            ]);
        }
    }

    public function getProjectStatus()
    {
        try {
            $projectCode = $this->request->getPost('project_code');

            if (!$projectCode) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Project code is required'
                ]);
            }

            $query = $this->db->table('project_code_list')
                             ->select('project_status')
                             ->where('project_code', $projectCode)
                             ->get();

            $result = $query->getRow();

            if ($result) {
                return $this->response->setJSON([
                    'success' => true,
                    'data' => [
                        'project_status' => $result->project_status
                    ]
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Project not found'
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Database error: ' . $e->getMessage()
            ]);
        }
    }

    public function getProjectDetails()
    {
        try {
            $projectCode = $this->request->getPost('project_code');

            if (!$projectCode) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Project code is required'
                ]);
            }

            $query = $this->db->table('project_code_list')
                             ->select('project_name, project_description, project_attention, project_wtp')
                             ->where('project_code', $projectCode)
                             ->get();

            $result = $query->getRow();

            if ($result) {
                return $this->response->setJSON([
                    'success' => true,
                    'data' => $result
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Project not found'
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Database error: ' . $e->getMessage()
            ]);
        }
    }

    public function getProjectDocuments()
    {
        try {
            $projectCode = $this->request->getPost('project_code');

            if (!$projectCode) {
                log_message('error', 'getProjectDocuments: Project code is missing');
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Project code is required'
                ]);
            }

            log_message('info', 'getProjectDocuments: Attempting to fetch documents for project: ' . $projectCode);

            $query = $this->db->table('project_document')
                             ->select('document_type, document_name, revision_status, document_route, project_code')
                             ->where('project_code', $projectCode)
                             ->get();

            if (!$query) {
                log_message('error', 'getProjectDocuments: Query failed: ' . $this->db->error()['message']);
                throw new \Exception('Database query failed');
            }

            $result = $query->getResultArray();

            if ($result) {
                return $this->response->setJSON([
                    'success' => true,
                    'data' => $result
                ]);
            } else {
                log_message('info', 'getProjectDocuments: No documents found for project: ' . $projectCode);
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'No documents found for this project'
                ]);
            }
        } catch (\Exception $e) {
            log_message('error', 'getProjectDocuments Exception: ' . $e->getMessage() . "\n" . $e->getTraceAsString());
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'An error occurred while fetching project documents'
            ]);
        }
    }

    public function viewDocument()
    {
        $filename = $this->request->getPost('filename');
        
        if (!$filename) {
            return $this->response->setStatusCode(400, 'Filename not provided');
        }

        $filepath = FCPATH . 'order/' . $filename;
        
        if (!file_exists($filepath)) {
            return $this->response->setStatusCode(404, 'File not found');
        }

        // Set headers to display PDF in browser
        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setHeader('Content-Disposition', 'inline; filename="' . $filename . '"')
            ->setHeader('Cache-Control', 'public, max-age=0, must-revalidate')
            ->setBody(file_get_contents($filepath));
    }

    public function uploadDocument()
    {
        try {
            $projectCode = $this->request->getPost('project_code');
            $documentType = $this->request->getPost('document_type');
            $documentName = $this->request->getPost('document_name');
            $revisionStatus = $this->request->getPost('revision_status');
            $file = $this->request->getFile('document');

            // Log the upload attempt
            log_message('info', 'uploadDocument: Attempting upload for project: ' . $projectCode);

            if (!$projectCode || !$documentType || !$documentName || !$revisionStatus || !$file) {
                $missing = [];
                if (!$projectCode) $missing[] = 'project_code';
                if (!$documentType) $missing[] = 'document_type';
                if (!$documentName) $missing[] = 'document_name';
                if (!$revisionStatus) $missing[] = 'revision_status';
                if (!$file) $missing[] = 'document file';
                
                log_message('error', 'uploadDocument: Missing required fields: ' . implode(', ', $missing));
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Missing required fields: ' . implode(', ', $missing)
                ]);
            }

            if ($file->isValid() && !$file->hasMoved()) {
                // Get original filename
                $originalName = $file->getClientName();
                log_message('info', 'uploadDocument: Processing file: ' . $originalName);

                // Create directory if it doesn't exist
                if (!is_dir($this->uploadPath)) {
                    if (!mkdir($this->uploadPath, 0777, true)) {
                        log_message('error', 'uploadDocument: Failed to create upload directory: ' . $this->uploadPath);
                        return $this->response->setJSON([
                            'success' => false,
                            'message' => 'Failed to create upload directory'
                        ]);
                    }
                }

                // Check if directory is writable
                if (!is_writable($this->uploadPath)) {
                    log_message('error', 'uploadDocument: Upload directory is not writable: ' . $this->uploadPath);
                    return $this->response->setJSON([
                        'success' => false,
                        'message' => 'Upload directory is not writable'
                    ]);
                }

                try {
                    // Move file to upload directory
                    $file->move($this->uploadPath, $originalName);
                } catch (\Exception $e) {
                    log_message('error', 'uploadDocument: File move failed: ' . $e->getMessage());
                    throw new \Exception('Failed to move uploaded file');
                }

                // Insert document info into database
                $data = [
                    'project_code' => $projectCode,
                    'document_type' => $documentType,
                    'document_name' => $documentName,
                    'document_route' => $originalName,
                    'revision_status' => $revisionStatus
                ];

                if (!$this->db->table('project_document')->insert($data)) {
                    log_message('error', 'uploadDocument: Database insert failed: ' . $this->db->error()['message']);
                    // Remove the uploaded file if database insert fails
                    unlink($this->uploadPath . '/' . $originalName);
                    throw new \Exception('Failed to save document information to database');
                }

                log_message('info', 'uploadDocument: Successfully uploaded document for project: ' . $projectCode);
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Document uploaded successfully'
                ]);
            }

            log_message('error', 'uploadDocument: Invalid file or file already moved');
            return $this->response->setJSON([
                'success' => false,
                'message' => 'File upload failed: Invalid file or file already moved'
            ]);

        } catch (\Exception $e) {
            log_message('error', 'uploadDocument Exception: ' . $e->getMessage() . "\n" . $e->getTraceAsString());
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'An error occurred while uploading the document'
            ]);
        }
    }

    public function createProjectWithDocument()
    {
        try {
            // Get project details
            $projectData = [
                'project_code' => $this->request->getPost('project_code'),
                'project_name' => $this->request->getPost('project_name'),
                'project_description' => $this->request->getPost('project_description'),
                'project_attention' => $this->request->getPost('project_attention'),
                'project_wtp' => $this->request->getPost('project_wtp'),
            ];

            // Validate required fields
            if (!$projectData['project_code'] || !$projectData['project_name']) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Project code and name are required'
                ]);
            }

            // Start transaction
            $this->db->transStart();

            // Insert project data
            $this->db->table('project_code_list')->insert($projectData);

            // Handle document upload
            $file = $this->request->getFile('document');
            $documentType = $this->request->getPost('document_type');

            if ($file && $file->isValid() && !$file->hasMoved() && $documentType) {
                // Get original filename
                $originalName = $file->getClientName();

                // Create directory if it doesn't exist
                if (!is_dir($this->uploadPath)) {
                    if (!mkdir($this->uploadPath, 0777, true)) {
                        $this->db->transRollback();
                        return $this->response->setJSON([
                            'success' => false,
                            'message' => 'Failed to create upload directory'
                        ]);
                    }
                }

                // Move file to upload directory
                $file->move($this->uploadPath, $originalName);

                // Insert document info
                $documentData = [
                    'project_code' => $projectData['project_code'],
                    'document_type' => $documentType,
                    'document_route' => $originalName
                ];

                $this->db->table('project_document')->insert($documentData);
            }

            // Complete transaction
            $this->db->transComplete();

            if ($this->db->transStatus() === false) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Transaction failed'
                ]);
            }

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Project and document created successfully'
            ]);

        } catch (\Exception $e) {
            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
            }
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ]);
        }
    }

    public function deleteDocument()
    {
        try {
            $filename = $this->request->getPost('filename');
            $projectCode = $this->request->getPost('project_code');

            if (!$filename || !$projectCode) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Filename and project code are required'
                ]);
            }

            // Start transaction
            $this->db->transStart();

            // Delete record from database
            $this->db->table('project_document')
                     ->where('document_route', $filename)
                     ->where('project_code', $projectCode)
                     ->delete();

            // Delete file from directory
            $filepath = FCPATH . 'order/' . $filename;
            if (file_exists($filepath)) {
                unlink($filepath);
            }

            // Complete transaction
            $this->db->transComplete();

            if ($this->db->transStatus() === false) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Failed to delete document'
                ]);
            }

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Document deleted successfully'
            ]);

        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ]);
        }
    }
} 