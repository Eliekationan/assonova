<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\SanitizesInput;

class StoreAssociationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    use SanitizesInput;

    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'acronym' => ['nullable', 'string', 'max:50'],
            'object' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],

            'email' => ['nullable', 'email'],
            'phone' => ['nullable', 'string', 'max:30'],

            'address' => ['nullable', 'string', 'max:255'],
            'siege' => ['nullable', 'string', 'max:255'],
            'country' => ['nullable', 'string', 'max:80'],
            'city' => ['nullable', 'string', 'max:80'],

            'admin_name' => ['required', 'string', 'max:255'],
            'admin_email' => ['nullable', 'email'],
            'admin_phone' => ['nullable', 'string', 'max:30'],

            'creation_date' => ['nullable', 'date'],
            'rccm' => ['nullable', 'string', 'max:100'],
            'npi' => ['nullable', 'string', 'max:100'],

            'logo' => ['nullable', 'image', 'max:2048'],
            'documents.*' => ['nullable', 'file', 'mimes:pdf', 'max:4096'],
        ];
    }

    protected function prepareForValidation()
    {
        $data = $this->all();

        foreach ([
            'name', 'acronym', 'object', 'description',
            'address', 'country', 'city',
            'president_name', 'rccm', 'npi'
        ] as $field) {
            if (isset($data[$field])) {
                $data[$field] = $this->cleanString($data[$field]);
            }
        }

        if (isset($data['email'])) {
            $data['email'] = $this->cleanEmail($data['email']);
        }

        if (isset($data['phone'])) {
            $data['phone'] = $this->cleanPhone($data['phone']);
        }

        if (isset($data['president_phone'])) {
            $data['president_phone'] = $this->cleanPhone($data['president_phone']);
        }

        if (isset($data['creation_date'])) {
            $data['creation_date'] = $this->cleanDate($data['creation_date']);
        }

        $this->replace($data);
    }
}
