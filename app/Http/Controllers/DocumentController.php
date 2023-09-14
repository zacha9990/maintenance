<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Document;
use App\Models\Factory;
use Auth;
use App\Models\User;

class DocumentController extends Controller
{
    // app/Http/Controllers/DocumentController.php

    public function index(Request $request)
    {
        // Fetch and display the list of documents
        $query = Document::query();

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->input('category'));
        }

        // Filter by factory (assuming you have a factory_id column in your documents table)
        if ($request->filled('factory')) {
            $query->where('factory_id', $request->input('factory'));
        }

        $documents = $query->paginate(2);

        $factories = Factory::query();
        if (Auth::user()->hasRole(['Operator'])) {
            $user = Auth::user();
            $user2 = User::find($user->id);
            $factories = $factories->where('id', $user2->staff->factory_id);
        }
        $factories = $factories->get();

        return view('documents.index', compact('documents', 'factories'));
    }

    public function create()
    {
        // Display the upload form
        $factories = Factory::query();
        if (Auth::user()->hasRole(['Operator'])) {
            $user = Auth::user();
            $user2 = User::find($user->id);
            $factories = $factories->where('id', $user2->staff->factory_id);
        }
        $factories = $factories->get();

        return view('documents.create', compact('factories'));
    }

    public function store(Request $request)
    {
        // Handle document upload and storage
        $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx',
            'factory_id' => 'required',
            'category' => 'required', // Validate against your category array
        ]);

        $file = $request->file('file');
        $filename = $file->store('public/documents');

        Document::create([
            'filename' => $filename,
            'category' => $request->input('category'),
            'factory_id' => $request->input('factory_id'),
        ]);

        return redirect()->route('documents.index')->with('success', 'Document uploaded successfully.');
    }

    public function show(Document $document)
    {
        return view('documents.view', compact('document'));
    }

    public function edit(Document $document)
    {
        // Display the edit form
    }

    public function update(Request $request, Document $document)
    {
        // Handle document update
    }

    public function destroy(Document $document)
    {
        $filePath = storage_path('app/' . $document->filename);

    // Check if the file exists
        if (file_exists($filePath)) {
            // Delete the file
            unlink($filePath);
        }else{
            dd($filePath);
        }
        $document->delete();

        return redirect()->route('documents.index')->with('success', 'Document deleted successfully.');
    }

}
