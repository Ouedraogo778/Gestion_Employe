<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',

           'departement-liste',
           'departement-ajouter',
           'departement-modifier',
           'departement-supprimer',
           
           'employe-liste',
           'employe-ajouter',
           'employe-modifier',
           'employe-supprimer',

           'projet-liste',
           'projet-ajouter',
           'projet-modifier',
           'projet-supprimer',

           'materiel-liste',
           'materiel-ajouter',
           'materiel-modifier',
           'materiel-supprimer',

           'activite-liste',
           'activite-ajouter',
           'activite-modifier',
           'activite-supprimer',

           'mission-liste',
           'mission-ajouter',
           'mission-modifier',
           'mission-supprimer',

           'ractivite-liste',
           'ractivite-ajouter',
           'ractivite-modifier',
           'ractivite-supprimer',

           'rmission-liste',
           'rmission-ajouter',
           'rmission-modifier',
           'rmission-supprimer',

           'validation-coordination-activite',
           'validation-raf-activite',
           'validation-president-activite',
           'sans-action-1',

           'validation-coordination-mission',
           'validation-raf-mission',
           'validation-president-mission',
           'sans-action-2',

           'validation-coordination-rapport-activite',
           'validation-raf-rapport-activite',
           'validation-president-rapport-activite',
           'sans-action-3',

           'validation-coordination-rapport-mission',
           'validation-raf-rapport-mission',
           'validation-president-rapport-mission',
           'sans-action-4'
          




        ];

        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}
