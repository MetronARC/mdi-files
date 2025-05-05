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

    public function getProjectDocuments()
    {
        try {
            $projectCode = $this->request->getPost('project_code');

            if (!$projectCode) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Project code is required'
                ]);
            }

            $query = $this->db->table('project_code_list pcl')
                             ->select('pcl.project_code, pd.document_type, pd.document_name, pd.revision_status, pcl.project_name, 
                                     pcl.project_description, pcl.project_attention, 
                                     pcl.project_wtp, pd.document_route')
                             ->join('project_document pd', 'pcl.project_code = pd.project_code', 'inner')
                             ->where('pcl.project_code', $projectCode)
                             ->get();

            $result = $query->getResultArray();

            if ($result) {
                // Format the project_wtp as Rupiah currency
                foreach ($result as &$row) {
                    if (isset($row['project_wtp']) && is_numeric($row['project_wtp'])) {
                        $row['project_wtp'] = 'Rp ' . number_format($row['project_wtp'], 0, ',', '.');
                    }
                }

                return $this->response->setJSON([
                    'success' => true,
                    'data' => $result
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'No documents found for this project'
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Database error: ' . $e->getMessage()
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

            if (!$projectCode || !$documentType || !$documentName || !$revisionStatus || !$file) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Missing required fields'
                ]);
            }

            if ($file->isValid() && !$file->hasMoved()) {
                // Get original filename
                $originalName = $file->getClientName();

                // Create directory if it doesn't exist
                if (!is_dir($this->uploadPath)) {
                    if (!mkdir($this->uploadPath, 0777, true)) {
                        return $this->response->setJSON([
                            'success' => false,
                            'message' => 'Failed to create upload directory'
                        ]);
                    }
                }

                // Move file to upload directory
                $file->move($this->uploadPath, $originalName);

                // Insert document info into database
                $data = [
                    'project_code' => $projectCode,
                    'document_type' => $documentType,
                    'document_name' => $documentName,
                    'document_route' => $originalName,
                    'revision_status' => $revisionStatus
                ];

                $this->db->table('project_document')->insert($data);

                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Document uploaded successfully'
                ]);
            }

            return $this->response->setJSON([
                'success' => false,
                'message' => 'File upload failed'
            ]);

        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
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