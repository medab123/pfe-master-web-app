<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestServerConnectivityRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'host' => 'required|string|max:255',
            'ssh_login_type' => 'required|string|in:password,ssh_private_key',
            'ssh_user' => 'nullable|required_if:auto_agent_install,1|string|max:255',
            'ssh_port' => 'nullable|required_if:auto_agent_install,1|integer|max:255',
            'ssh_password' => 'nullable|required_if:auto_agent_install,1|string',
            'ssh_private_key' => 'nullable|string',
        ];
    }
}
