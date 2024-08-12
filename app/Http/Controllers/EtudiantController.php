<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEtudiantRequest;
use App\Http\Requests\UpdateEtudiantRequest;
use App\Models\Etudiant;
use Illuminate\Support\Facades\File;
use OpenApi\Annotations as OA;


class EtudiantController extends Controller
{

    /**
     * @OA\Get(
     *     path="/etudiants",
     *     summary="Liste des étudiants",
     *     tags={"Étudiants"},
     *     @OA\Response(
     *         response="200",
     *         description="Liste des étudiants",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Etudiant")
     *         )
     *     )
     * )
     */

    public function index()
    {
        $etudiants = Etudiant::all();
        return $this->customJsonResponse("Liste des étudiants", $etudiants);
    }


 /**
     * @OA\Post(
     *     path="/etudiants",
     *     summary="Créer un nouvel étudiant",
     *     tags={"Étudiants"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"prenom", "nom", "adresse", "telephone", "date_de_naissance", "matricule", "email"},
     *             @OA\Property(property="prenom", type="string", example="Jean"),
     *             @OA\Property(property="nom", type="string", example="Dupont"),
     *             @OA\Property(property="adresse", type="string", example="10 rue des Lilas"),
     *             @OA\Property(property="telephone", type="integer", example=123456789),
     *             @OA\Property(property="date_de_naissance", type="string", format="date", example="2000-01-01"),
     *             @OA\Property(property="matricule", type="string", example="M123456"),
     *             @OA\Property(property="email", type="string", example="jean.dupont@example.com"),
     *             @OA\Property(property="mot_de_pass", type="string", example="motdepasse123", nullable=true),
     *             @OA\Property(property="photo", type="string", example="chemin/vers/photo.jpg", nullable=true)
     *         )
     *     ),
     *     @OA\Response(
     *         response="201",
     *         description="Étudiant créé avec succès",
     *         @OA\JsonContent(ref="#/components/schemas/Etudiant")
     *     )
     * )
     */
    public function store(StoreEtudiantRequest $request)
    {
        $etudiant = new Etudiant();
        $etudiant->fill($request->validated());
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $etudiant->photo = $image->store('etudiants', 'public');
        }
        $etudiant->save();
        return $this->customJsonResponse("Étudiant créé avec succès", $etudiant, 201);
    }


    /**
     * @OA\Get(
     *     path="/etudiants/{id}",
     *     summary="Récupérer un étudiant",
     *     tags={"Étudiants"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de l'étudiant",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Étudiant récupéré avec succès",
     *         @OA\JsonContent(ref="#/components/schemas/Etudiant")
     *     )
     * )
     */
    public function show(Etudiant $etudiant)
    {
        return $this->customJsonResponse("Étudiant récupéré avec succès", $etudiant);
    }

/**
     * @OA\Put(
     *     path="/etudiants/{id}",
     *     summary="Modifier un étudiant",
     *     tags={"Étudiants"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de l'étudiant",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="prenom", type="string", example="Jean"),
     *             @OA\Property(property="nom", type="string", example="Dupont"),
     *             @OA\Property(property="adresse", type="string", example="10 rue des Lilas"),
     *             @OA\Property(property="telephone", type="integer", example=123456789),
     *             @OA\Property(property="date_de_naissance", type="string", format="date", example="2000-01-01"),
     *             @OA\Property(property="matricule", type="string", example="M123456"),
     *             @OA\Property(property="email", type="string", example="jean.dupont@example.com"),
     *             @OA\Property(property="mot_de_pass", type="string", example="motdepasse123", nullable=true),
     *             @OA\Property(property="photo", type="string", example="chemin/vers/photo.jpg", nullable=true)
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Étudiant modifié avec succès",
     *         @OA\JsonContent(ref="#/components/schemas/Etudiant")
     *     )
     * )
     */
    public function update(UpdateEtudiantRequest $request, Etudiant $etudiant)
    {
        $etudiant->fill($request->validated());

        if ($request->hasFile('photo')) {
            if (File::exists(public_path("storage/" . $etudiant->photo))) {
                File::delete(public_path("storage/" . $etudiant->photo));
            }
            $image = $request->file('photo');
            $etudiant->photo = $image->store('etudiants', 'public');
        }

        $etudiant->update();
        return $this->customJsonResponse("Étudiant modifié avec succès", $etudiant);
    }

    /**
     * @OA\Delete(
     *     path="/etudiants/{id}",
     *     summary="Supprimer un étudiant",
     *     tags={"Étudiants"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de l'étudiant",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response="204",
     *         description="Étudiant supprimé avec succès"
     *     )
     * )
     */

    public function destroy(Etudiant $etudiant)
    {
        $etudiant->delete();
        return $this->customJsonResponse("Étudiant supprimé avec succès", 204);
    }
}
