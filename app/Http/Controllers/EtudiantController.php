<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEtudiantRequest;
use App\Http\Requests\UpdateEtudiantRequest;
use App\Models\Etudiant;

class EtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $etudiants = Etudiant::all();
        return $this->customJsonResponse("Liste des étudiants", $etudiants);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEtudiantRequest $request)
    {
        $etudiant = new Etudiant();
        $etudiant->fill($request->validated());
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $etudiant->image = $image->store('etudiants', 'public');
        }
        $etudiant->save();
        return $this->customJsonResponse("etudiant créé avec succès", $etudiant, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Etudiant $etudiant)
    {
        return $this->customJsonResponse("Etudiant récupéré avec succès", $etudiant);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Etudiant $etudiant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEtudiantRequest $request, Etudiant $etudiant)
    {
        $etudiant->fill($request->validated());

        if ($request->hasFile('image')) {
            if (File::exists(public_path("storage/" . $etudiant->image))) {
                File::delete(public_path("storage/" . $etudiant->image));
            }
            $image = $request->file('image');
            $etudiant->image = $image->store('etudiants', 'public');
        }

        $etudiant->save();
        return $this->customJsonResponse("Étudiant modifié avec succès", $etudiant);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Etudiant $etudiant)
    {
        $etudiant->delete();
        return $this->customJsonResponse("Étudiant supprimé avec succès", 200);
    }
}
