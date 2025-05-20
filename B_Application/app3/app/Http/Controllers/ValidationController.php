<?php

namespace App\Http\Controllers;

use App\Services\ValidationService;
use Illuminate\Http\Request;
use App\Models\Validation;

class ValidationController extends Controller
{
    protected $validations;

    public function __construct(ValidationService $validations)
    {
        $this->middleware('auth');
        $this->validations = $validations;
    }

    public function index()
    {
        $vals = $this->validations->getAll();
        return view('validations.index', compact('vals'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'document_id'  => 'required|exists:documents,id',
            'formateur_id' => 'required|exists:formateurs,id',
        ]);
        $this->validations->validateDocument($data['document_id'], $data['formateur_id']);
        return redirect()->route('validations.index');
    }

    public function destroy(Validation $validation)
    {
        $validation->delete();
        return redirect()->route('validations.index');
    }
}
