<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEvaluationRequest;
use App\Http\Requests\UpdateEvaluationRequest;
use App\Models\Evaluation;
use OpenApi\Annotations as OA;

class EvaluationController extends Controller
{
    /**
     * @OA\Get(
     *     path="/evaluations",
     *     summary="Liste des évaluations",
     *     tags={"Évaluations"},
     *     @OA\Response(
     *         response="200",
     *         description="Liste des évaluations",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Evaluation")
     *         )
     *     )
     * )
     */
    public function index()
    {
        $evaluations = Evaluation::all();
        return $this->customJsonResponse("Liste des évaluations", $evaluations);
    }

    /**
     * @OA\Post(
     *     path="/evaluations",
     *     summary="Créer une nouvelle évaluation",
     *     tags={"Évaluations"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"etudiant_id", "matiere_id", "date", "valeur"},
     *             @OA\Property(property="etudiant_id", type="integer", example=1),
     *             @OA\Property(property="matiere_id", type="integer", example=1),
     *             @OA\Property(property="date", type="string", format="date", example="2024-08-07"),
     *             @OA\Property(property="valeur", type="number", format="float", example=15.5)
     *         )
     *     ),
     *     @OA\Response(
     *         response="201",
     *         description="Évaluation créée avec succès",
     *         @OA\JsonContent(ref="#/components/schemas/Evaluation")
     *     )
     * )
     */
    public function store(StoreEvaluationRequest $request)
    {
        $evaluation = Evaluation::create($request->validated());
        return $this->customJsonResponse("Évaluation créée avec succès", $evaluation, 201);
    }

    /**
     * @OA\Get(
     *     path="/evaluations/{id}",
     *     summary="Récupérer une évaluation",
     *     tags={"Évaluations"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de l'évaluation",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Évaluation récupérée avec succès",
     *         @OA\JsonContent(ref="#/components/schemas/Evaluation")
     *     )
     * )
     */
    public function show(Evaluation $evaluation)
    {
        return $this->customJsonResponse("Évaluation récupérée avec succès", $evaluation);
    }

    /**
     * @OA\Put(
     *     path="/evaluations/{id}",
     *     summary="Modifier une évaluation",
     *     tags={"Évaluations"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de l'évaluation",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="etudiant_id", type="integer", example=1),
     *             @OA\Property(property="matiere_id", type="integer", example=1),
     *             @OA\Property(property="date", type="string", format="date", example="2024-08-07"),
     *             @OA\Property(property="valeur", type="number", format="float", example=15.5)
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Évaluation modifiée avec succès",
     *         @OA\JsonContent(ref="#/components/schemas/Evaluation")
     *     )
     * )
     */
    public function update(UpdateEvaluationRequest $request, Evaluation $evaluation)
    {
        $evaluation->fill($request->validated());
        $evaluation->save();
        return $this->customJsonResponse("Évaluation modifiée avec succès", $evaluation);
    }

    /**
     * @OA\Delete(
     *     path="/evaluations/{id}",
     *     summary="Supprimer une évaluation",
     *     tags={"Évaluations"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de l'évaluation",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response="204",
     *         description="Évaluation supprimée avec succès"
     *     )
     * )
     */
    public function destroy(Evaluation $evaluation)
    {
        $evaluation->delete();
        return $this->customJsonResponse("Évaluation supprimée avec succès", 204);
    }
}
