<?php

use OpenApi\Annotations as OA;

/**
 * @OA\Info(title="API Gestion Etudiant", version="0.1")
 * @OA\Server(
 *  url="http://127.0.0.1:8000/api/",
 *  description="Api permettant de faire la gestion des étudiants et de leurs note pour une école."
 * )
 */

 /**
 * @OA\Schema(
 *     schema="Etudiant",
 *     type="object",
 *     required={"prenom", "nom", "adresse", "telephone", "date_de_naissance", "matricule", "email"},
 *     @OA\Property(property="id", type="integer", format="int64", description="ID de l'étudiant"),
 *     @OA\Property(property="prenom", type="string", example="Jean"),
 *     @OA\Property(property="nom", type="string", example="Dupont"),
 *     @OA\Property(property="adresse", type="string", example="10 rue des Lilas"),
 *     @OA\Property(property="telephone", type="integer", example=123456789, format="int64"),
 *     @OA\Property(property="date_de_naissance", type="string", format="date", example="2000-01-01"),
 *     @OA\Property(property="matricule", type="string", example="M123456"),
 *     @OA\Property(property="email", type="string", example="jean.dupont@example.com"),
 *     @OA\Property(property="mot_de_pass", type="string", example="motdepasse123", nullable=true),
 *     @OA\Property(property="photo", type="string", example="chemin/vers/photo.jpg", nullable=true),
 *     @OA\Property(property="deleted_at", type="string", format="date-time", nullable=true, description="Date de suppression logique")
 * )
 */
