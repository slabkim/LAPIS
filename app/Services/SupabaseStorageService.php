<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;

class SupabaseStorageService
{
    protected Client $client;
    protected string $url;
    protected string $key;
    protected string $bucket;

    public function __construct()
    {
        $this->url = config('services.supabase.url');
        $this->key = config('services.supabase.key');
        $this->bucket = config('services.supabase.bucket');

        $this->client = new Client([
            'base_uri' => $this->url . '/storage/v1/',
            'headers' => [
                'Authorization' => 'Bearer ' . $this->key,
                'apikey' => $this->key,
            ],
        ]);
    }

    /**
     * Upload file to Supabase Storage
     *
     * @param UploadedFile $file
     * @param string $folder Folder path in bucket (e.g., 'pengaduan/pungli')
     * @return string Public URL of uploaded file
     * @throws \Exception
     */
    public function upload(UploadedFile $file, string $folder): string
    {
        try {
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '_' . uniqid() . '.' . $extension;
            $filePath = $folder . '/' . $fileName;

            // Upload file
            $response = $this->client->post("object/{$this->bucket}/{$filePath}", [
                'headers' => [
                    'Content-Type' => $file->getMimeType(),
                ],
                'body' => fopen($file->getRealPath(), 'r'),
            ]);

            if ($response->getStatusCode() !== 200) {
                throw new \Exception('Failed to upload file to Supabase Storage');
            }

            // Return public URL
            return $this->getPublicUrl($filePath);
        } catch (GuzzleException $e) {
            Log::error('Supabase Storage upload error: ' . $e->getMessage());
            throw new \Exception('Failed to upload file: ' . $e->getMessage());
        }
    }

    /**
     * Get public URL for a file
     *
     * @param string $path File path in bucket
     * @return string Public URL
     */
    public function getPublicUrl(string $path): string
    {
        return $this->url . '/storage/v1/object/public/' . $this->bucket . '/' . $path;
    }

    /**
     * Delete file from Supabase Storage
     *
     * @param string $path File path in bucket
     * @return bool
     */
    public function delete(string $path): bool
    {
        try {
            $response = $this->client->delete("object/{$this->bucket}/{$path}");
            return $response->getStatusCode() === 200;
        } catch (GuzzleException $e) {
            Log::error('Supabase Storage delete error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Check if file exists
     *
     * @param string $path File path in bucket
     * @return bool
     */
    public function exists(string $path): bool
    {
        try {
            $response = $this->client->head("object/{$this->bucket}/{$path}");
            return $response->getStatusCode() === 200;
        } catch (GuzzleException $e) {
            return false;
        }
    }
}
