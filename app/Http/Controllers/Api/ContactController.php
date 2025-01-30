<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::all();
        return response()->json([
            "data" => $contacts
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:contacts',
                'no_telp' => 'required|string|max:255',
                'massage' => 'required'
            ]);
            $contact = Contact::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'no_telp' => $validatedData['no_telp'],
                'massage' => $validatedData['massage']
            ]);
            return response()->json([
                "message" => "Data berhasil disimpan",
                "data" => $contact
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                "message" => "Data gagal disimpan",
                "errors" => $e->errors()
            ], 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        return response()->json([
            "data" => $contact
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:contacts,email,' . $contact->id,
                'no_telp' => 'required|string|max:255',
                'massage' => 'required'
            ]);
            $contact->update([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'no_telp' => $validatedData['no_telp'],
                'massage' => $validatedData['massage']
            ]);
            return response()->json([
                "message" => "Data berhasil diubah",
                "data" => $contact
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                "message" => "Data gagal diubah",
                "errors" => $e->errors()
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return response()->json([
            "message" => "Data berhasil dihapus"
        ]);
    }
    public function showDelete()
    {
        $deletedContact = Contact::onlyTrashed()->get();
        return response()->json([
            "message" => "Data yang sudah dihapus",
            "data" => $deletedContact
        ], 201);
    }
    /**
     * Restore a soft-deleted contact.
     *
     * This function attempts to restore a contact that was previously soft-deleted.
     * It searches for the contact using the provided ID, including trashed records.
     *
     * @param int $id The ID of the contact to restore.
     *
     * @return \Illuminate\Http\JsonResponse A JSON response indicating the result of the operation.
     *         If successful, returns a 201 status code with a success message and the restored contact data.
     *         If the contact is not found, returns a 404 status code with an error message.
     */
    public function restore($id)
    {
        $contact = Contact::withTrashed()->where('id', $id)->first();
        if ($contact) {
            $contact->restore();
            return response()->json([
                "message" => "Data berhasil dikembalikan",
                "data" => $contact
            ], 201);
        } else {
            return response()->json([
                "message" => "Data yang dipilih tidak ditemukan"
            ], 404);
        }
    }
}