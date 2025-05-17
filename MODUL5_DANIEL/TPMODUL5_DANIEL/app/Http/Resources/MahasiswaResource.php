<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MahasiswaResource extends JsonResource
{
    // TODO: Deklarasikan 3 properties (status, message, data) dengan visibility public 
    public $status;
    public $message;
    public $data;

    public function __construct($status, $message, $resource)
    {
        parent::__construct($resource);
        $this->status  = $status;
        $this->message = $message;
        $this->data    = $resource;
    }

    public function toArray(Request $request): array
    {
        // TODO: Lengkapi return dengan success mengambil dari property status, message dari property message, dan data dari property data
        return [
            'success' => $this->status,
            'message' => $this->message,
            'data'    => $this->data,
        ];
    }
}
