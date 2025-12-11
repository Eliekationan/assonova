<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreAssociationRequest;
use App\Models\Association;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class OnBoardingController extends Controller
{
    public function store(StoreAssociationRequest $request)
    {
        $tempPassword  = "password";
        $validated = $request->validated();

        DB::beginTransaction();

        try {
            // --- Séparer les données de l'association et de l'admin ---
            $associationData = [
                'name' => $validated['name'],
                'acronym' => $validated['acronym'],
                'object' => $validated['object'],
                'description' => $validated['description'],
                'email' => $validated['email'], // email de contact de l'association
                'phone' => $validated['phone'],
                'address' => $validated['siege'],
                // ... autres champs de l'association
                'uuid' => Str::uuid()->toString(),
            ];

            // Upload du logo
            if ($request->hasFile('logo')) {
                $associationData['logo_path'] = $request->file('logo')->store('logos', 'public');
            }

            // Upload des documents PDF
            if ($request->hasFile('documents')) {
                $docs = [];
                foreach ($request->file('documents') as $file) {
                    $docs[] = $file->store('documents', 'public');
                }
                $associationData['documents'] = $docs;
            }

            // Création de l'association
            $association = Association::create($associationData);

            // --- Données de l'admin ---
            $adminData = [

                'name' => $validated['admin_name'],
                'email' => $validated['admin_email'], // si email spécifique admin
                'phone' => $validated['admin_phone'],
                'password' => bcrypt($tempPassword), // mot de passe temporaire
            ];

            $admin = User::create($adminData);

            // Lier l'admin à l'association
            $association->users()->attach($admin->id, [
                'role' => 'membre',
                'is_admin' => true,
                'section_id' => null,
            ]);

            \Mail::to($admin->email)->queue(new \App\Mail\WelcomeAdminMail($admin, $tempPassword, $association));

            DB::commit();

            return Inertia::render('Onboarding/Finish', [
                'association' => $association,
                'message' => 'Association créée avec succès et admin principal généré'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Erreur lors de la création de l\'association: '.$e->getMessage()]);
        }
    }

}
