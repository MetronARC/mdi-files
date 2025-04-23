<?php

namespace App\Controllers;

class Document extends BaseController
{
    protected $db;
    protected $uploadPath;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->uploadPath = FCPATH . 'operational-procedures'; // Changed to plural
    }

    public function index(): string
    {
        return view('pages/sop');
    }

    public function store()
    {
        // Handle file upload
        $file = $this->request->getFile('document');

        if ($file->isValid() && !$file->hasMoved()) {
            // Get original filename
            $originalName = $file->getClientName();

            // Create directory if it doesn't exist
            if (!is_dir($this->uploadPath)) {
                if (!mkdir($this->uploadPath, 0777, true)) {
                    log_message('error', 'Failed to create directory: ' . $this->uploadPath);
                    return $this->response->setJSON([
                        'status' => 'error',
                        'message' => 'Failed to create upload directory'
                    ]);
                }
            }

            // Check if directory is writable
            if (!is_writable($this->uploadPath)) {
                log_message('error', 'Directory not writable: ' . $this->uploadPath);
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Upload directory is not writable'
                ]);
            }

            try {
                // Move file to the upload directory with original name
                $file->move($this->uploadPath, $originalName);

                // Log successful file upload
                log_message('info', 'File uploaded successfully to: ' . $this->uploadPath . '/' . $originalName);

                // Prepare data for database
                $data = [
                    'document-number' => $this->request->getPost('document-number'),
                    'document-name' => $this->request->getPost('document-name'),
                    'effective-date' => $this->request->getPost('effective-date'),
                    'revision-status' => $this->request->getPost('revision-status'),
                    'document-route' => $originalName
                ];

                // Insert into database
                $this->db->table('operational_procedures')->insert($data);

                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Document uploaded successfully'
                ]);
            } catch (\Exception $e) {
                // Log the error
                log_message('error', 'Error during file upload: ' . $e->getMessage());

                // Delete the uploaded file if it exists
                if (file_exists($this->uploadPath . '/' . $originalName)) {
                    unlink($this->uploadPath . '/' . $originalName);
                }

                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Error: ' . $e->getMessage()
                ]);
            }
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'File upload failed: ' . $file->getErrorString()
        ]);
    }

    public function list()
    {
        $documents = $this->db->table('operational_procedures')
            ->select('id, document-number, document-name, effective-date, revision-status, document-route')
            ->get()
            ->getResultArray();

        return $this->response->setJSON(['data' => $documents]);
    }

    public function view()
    {
        $filename = $this->request->getPost('filename');
        
        if (!$filename) {
            return $this->response->setStatusCode(400, 'Filename not provided');
        }

        $filepath = FCPATH . 'operational-procedures/' . $filename;
        
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

    public function delete()
    {
        $id = $this->request->getPost('id');
        
        if (!$id) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Document ID not provided'
            ]);
        }

        try {
            // Get the document info first to delete the file
            $document = $this->db->table('operational_procedures')
                ->where('id', $id)
                ->get()
                ->getRowArray();

            if ($document) {
                // Delete the physical file
                $filepath = FCPATH . 'operational-procedures/' . $document['document-route'];
                if (file_exists($filepath)) {
                    unlink($filepath);
                }

                // Delete from database
                $this->db->table('operational_procedures')
                    ->where('id', $id)
                    ->delete();

                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Document deleted successfully'
                ]);
            }

            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Document not found'
            ]);

        } catch (\Exception $e) {
            log_message('error', 'Error deleting document: ' . $e->getMessage());
            
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Error deleting document: ' . $e->getMessage()
            ]);
        }
    }
}
