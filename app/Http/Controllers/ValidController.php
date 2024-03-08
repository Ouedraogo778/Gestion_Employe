<?php

namespace App\Http\Controllers;

use App\Mail\ActiviteValidation;
use App\Models\Activite;
use App\Models\Employe;
use App\Models\Mission;
use App\Models\Ractivite;
use App\Models\Rmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Mail\Message;





class ValidController extends Controller
{
    public function valid1()
    {
        $activites = Activite::latest()->paginate(25);

        return view('validations.validation1', compact('activites'))
            ->with('i', (request()->input('page', 1) - 1) * 25);
    }

    public function valider1(Request $request, $id)
    {
        // Récupérer l'activité par son ID
        $activite = Activite::findOrFail($id);

        // Valider l'activité, par exemple, en mettant à jour un champ
        $activite->update([
            'statut1' => 1,
            'statut2' => 0,
            'motif1' => 'RAS',
            'validation_finance' => 'valider',
        ]);

        // Vous pouvez également ajouter d'autres traitements, comme l'envoi d'e-mails, etc.

        return redirect()->back()->with('success', 'validée avec succès.');
    }

    public function rejeter1(Request $request, $id)
    {
        // Récupérer l'activité par son ID
        $activite = Activite::findOrFail($id);
        $motifRejet = $request->input('motif');

        // Valider l'activité, par exemple, en mettant à jour un champ
        $activite->update([
            'statut1' => 0,
            'statut2' => 1,
            'validation_finance' => 'rejeter',
            'motif1' => $motifRejet,
        ]);


        // Vous pouvez également ajouter d'autres traitements, comme l'envoi d'e-mails, etc.

        return redirect()->back()->with('success', 'Rejerter avec succès.');
    }



    // POUR LA VALIDATION RAF
    public function valid2()
    {
        $activites = Activite::latest()->paginate(25);

        return view('validations.validation2', compact('activites'))
            ->with('i', (request()->input('page', 1) - 1) * 25);
    }

    public function valider2(Request $request, $id)
    {
        // Récupérer l'activité par son ID
        $activite = Activite::findOrFail($id);

        // Valider l'activité, par exemple, en mettant à jour un champ
        $activite->update([
            'statut3' => 1,
            'statutfin' => 1,
            'statut4' => 0,
            'motif2' => 'RAS',
            'validation_raf' => 'valider',
        ]);

       
// Récupérer l'employé associé à cette activité

$employe =Employe::findOrFail($activite->employe_id);

//dd($employe);
//dd($activite->employe);
// Envoyer un e-mail à l'employé
////Mail::to($employe->email)->send(new ActiviteValidation($activite));   

//nouveau
// Récupérer l'employé associé à cette activité

// Vérifier et envoie de mail
 ////Mail::to($employe->email)
    //// ->send(new ActiviteValidation($activite));

// Vous pouvez également ajouter d'autres traitements, comme l'envoi d'e-mails, etc.

        return redirect()->back()->with('success', 'validée avec succès.');
    }

    public function rejeter2(Request $request, $id)
    {
        // Récupérer l'activité par son ID
        $activite = Activite::findOrFail($id);
        $motifRejet = $request->input('motif');

        // Valider l'activité, par exemple, en mettant à jour un champ
        $activite->update([
            'statut3' => 0,
            'statut4' => 1,
            'validation_raf' => 'rejeter',
            'motif2' => $motifRejet,
        ]);


        // Vous pouvez également ajouter d'autres traitements, comme l'envoi d'e-mails, etc.

        return redirect()->back()->with('success', 'Rejerter avec succès.');
    }

     // POUR LA VALIDATION SUPPERIEUR
     public function valid3()
     {
         $activites = Activite::latest()->paginate(25);

         return view('validations.validation3', compact('activites'))
             ->with('i', (request()->input('page', 1) - 1) * 25);
     }

     public function valider3(Request $request, $id)
     {
         // Récupérer l'activité par son ID
         $activite = Activite::findOrFail($id);

         // Valider l'activité, par exemple, en mettant à jour un champ
         $activite->update([
             'statut5' => 1,
            
             'statut6' => 0,
             'motif3' => 'RAS',
             'validation_supperieur' => 'valider',
         ]);

         // Vous pouvez également ajouter d'autres traitements, comme l'envoi d'e-mails, etc.

         return redirect()->back()->with('success', 'validée avec succès.');
     }

     public function rejeter3(Request $request, $id)
     {
         // Récupérer l'activité par son ID
         $activite = Activite::findOrFail($id);
         $motifRejet = $request->input('motif');

         // Valider l'activité, par exemple, en mettant à jour un champ
         $activite->update([
             'statut5' => 0,
             'statutfin' => 0,
             'statut6' => 1,
             'validation_supperieur' => 'rejeter',
             'motif3' => $motifRejet,
         ]);


         // Vous pouvez également ajouter d'autres traitements, comme l'envoi d'e-mails, etc.

         return redirect()->back()->with('danger', 'Rejerter avec succès.');
     }



     //Validation de la mission

     public function validmission1()
     {
         $missions = Mission::latest()->paginate(25);
 
         return view('validations.validationmission1', compact('missions'))
             ->with('i', (request()->input('page', 1) - 1) * 25);
     }
 
     public function validermission1(Request $request, $id)
     {
         // Récupérer l'activité par son ID
         $mission = Mission::findOrFail($id);
 
         // Valider l'activité, par exemple, en mettant à jour un champ
         $mission->update([
             'statut1' => 1,
             'statut2' => 0,
             'motif1' => 'RAS',
             'validation_finance' => 'valider',
         ]);
 
         // Vous pouvez également ajouter d'autres traitements, comme l'envoi d'e-mails, etc.
 
         return redirect()->back()->with('success', 'validée avec succès.');
     }
 
     public function rejetermission1(Request $request, $id)
     {
         // Récupérer l'activité par son ID
         $mission = Mission::findOrFail($id);
         $motifRejet = $request->input('motif');
 
         // Valider l'activité, par exemple, en mettant à jour un champ
         $mission->update([
             'statut1' => 0,
             'statut2' => 1,
             'validation_finance' => 'rejeter',
             'motif1' => $motifRejet,
         ]);
 
 
         // Vous pouvez également ajouter d'autres traitements, comme l'envoi d'e-mails, etc.
 
         return redirect()->back()->with('success', 'Rejerter avec succès.');
     }
 
 
 
     // POUR LA VALIDATION RAF
     public function validmission2()
     {
         $missions = Mission::latest()->paginate(25);
 
         return view('validations.validationmission2', compact('missions'))
             ->with('i', (request()->input('page', 1) - 1) * 25);
     }
 
     public function validermission2(Request $request, $id)
     {
         // Récupérer l'activité par son ID
         $mission = Mission::findOrFail($id);
 
         // Valider l'activité, par exemple, en mettant à jour un champ
         $mission->update([
             'statut3' => 1,
             'statutfin' => 1,
             'statut4' => 0,
             'motif2' => 'RAS',
             'validation_raf' => 'valider',
         ]);
 
         // Vous pouvez également ajouter d'autres traitements, comme l'envoi d'e-mails, etc.
 
         return redirect()->back()->with('success', 'validée avec succès.');
     }
 
     public function rejetermission2(Request $request, $id)
     {
         // Récupérer l'activité par son ID
         $mission = Mission::findOrFail($id);
         $motifRejet = $request->input('motif');
 
         // Valider l'activité, par exemple, en mettant à jour un champ
         $mission->update([
             'statut3' => 0,
             'statut4' => 1,
             'validation_raf' => 'rejeter',
             'motif2' => $motifRejet,
         ]);
 
 
         // Vous pouvez également ajouter d'autres traitements, comme l'envoi d'e-mails, etc.
 
         return redirect()->back()->with('success', 'Rejerter avec succès.');
     }
 
      // POUR LA VALIDATION SUPPERIEUR
      public function validmission3()
      {
          $missions = Mission::latest()->paginate(25);
 
          return view('validations.validationmission3', compact('missions'))
              ->with('i', (request()->input('page', 1) - 1) * 25);
      }
 
      public function validermission3(Request $request, $id)
      {
          // Récupérer l'activité par son ID
          $mission = Mission::findOrFail($id);
 
          // Valider l'activité, par exemple, en mettant à jour un champ
          $mission->update([
              'statut5' => 1,
             
              'statut6' => 0,
              'motif3' => 'RAS',
              'validation_supperieur' => 'valider',
          ]);
 
          // Vous pouvez également ajouter d'autres traitements, comme l'envoi d'e-mails, etc.
 
          return redirect()->back()->with('success', 'validée avec succès.');
      }
 
      public function rejetermission3(Request $request, $id)
      {
          // Récupérer l'activité par son ID
          $mission = Mission::findOrFail($id);
          $motifRejet = $request->input('motif');
 
          // Valider l'activité, par exemple, en mettant à jour un champ
          $mission->update([
              'statut5' => 0,
              'statutfin' => 0,
              'statut6' => 1,
              'validation_supperieur' => 'rejeter',
              'motif3' => $motifRejet,
          ]);
 
 
          // Vous pouvez également ajouter d'autres traitements, comme l'envoi d'e-mails, etc.
 
          return redirect()->back()->with('danger', 'Rejerter avec succès.');
      }


      //Validation rapport activite


      public function validractivite1()
      {
          $ractivites = Ractivite::latest()->paginate(25);
  
          return view('validations.validationractivite1', compact('ractivites'))
              ->with('i', (request()->input('page', 1) - 1) * 25);
      }
  
      public function validerractivite1(Request $request, $id)
      {
          // Récupérer l'activité par son ID
          $ractivite = Ractivite::findOrFail($id);
  
          // Valider l'activité, par exemple, en mettant à jour un champ
          $ractivite->update([
              'statut1' => 1,
              'statut2' => 0,
              'motif1' => 'RAS',
              'validation_finance' => 'valider',
          ]);
  
          // Vous pouvez également ajouter d'autres traitements, comme l'envoi d'e-mails, etc.
  
          return redirect()->back()->with('success', 'validée avec succès.');
      }
  
      public function rejeterractivite1(Request $request, $id)
      {
          // Récupérer l'activité par son ID
          $ractivite = Ractivite::findOrFail($id);
          $motifRejet = $request->input('motif');
  
          // Valider l'activité, par exemple, en mettant à jour un champ
          $ractivite->update([
              'statut1' => 0,
              'statut2' => 1,
              'validation_finance' => 'rejeter',
              'motif1' => $motifRejet,
          ]);
  
  
          // Vous pouvez également ajouter d'autres traitements, comme l'envoi d'e-mails, etc.
  
          return redirect()->back()->with('success', 'Rejerter avec succès.');
      }
  
  
  
      // POUR LA VALIDATION RAF
      public function validractivite2()
      {
          $ractivites = Ractivite::latest()->paginate(25);
  
          return view('validations.validationractivite2', compact('ractivites'))
              ->with('i', (request()->input('page', 1) - 1) * 25);
      }
  
      public function validerractivite2(Request $request, $id)
      {
          // Récupérer l'activité par son ID
          $ractivite = Ractivite::findOrFail($id);
  
          // Valider l'activité, par exemple, en mettant à jour un champ
          $ractivite->update([
              'statut3' => 1,
              'statut4' => 0,
              'motif2' => 'RAS',
              'validation_raf' => 'valider',
          ]);
  
          // Vous pouvez également ajouter d'autres traitements, comme l'envoi d'e-mails, etc.
  
          return redirect()->back()->with('success', 'validée avec succès.');
      }
  
      public function rejeterractivite2(Request $request, $id)
      {
          // Récupérer l'activité par son ID
          $ractivite = Ractivite::findOrFail($id);
          $motifRejet = $request->input('motif');
  
          // Valider l'activité, par exemple, en mettant à jour un champ
          $ractivite->update([
              'statut3' => 0,
              'statut4' => 1,
              'validation_raf' => 'rejeter',
              'motif2' => $motifRejet,
          ]);
  
  
          // Vous pouvez également ajouter d'autres traitements, comme l'envoi d'e-mails, etc.
  
          return redirect()->back()->with('success', 'Rejerter avec succès.');
      }
  
       // POUR LA VALIDATION SUPPERIEUR
       public function validractivite3()
       {
           $ractivites = Ractivite::latest()->paginate(25);
  
           return view('validations.validationractivite3', compact('ractivites'))
               ->with('i', (request()->input('page', 1) - 1) * 25);
       }
  
       public function validerractivite3(Request $request, $id)
       {
           // Récupérer l'activité par son ID
           $ractivite = Ractivite::findOrFail($id);
  
           // Valider l'activité, par exemple, en mettant à jour un champ
           $ractivite->update([
               'statut5' => 1,
               'statut6' => 0,
               'motif3' => 'RAS',
               'validation_supperieur' => 'valider',
           ]);
                // Mettre à jour le champ statutfin dans la table Mission
            Activite::where('id', $ractivite->id)->update(['statutfin' => 0]);
           // Vous pouvez également ajouter d'autres traitements, comme l'envoi d'e-mails, etc.
  
           return redirect()->back()->with('success', 'validée avec succès.');
       }
  
       public function rejeterractivite3(Request $request, $id)
       {
           // Récupérer l'activité par son ID
           $ractivite = Ractivite::findOrFail($id);
           $motifRejet = $request->input('motif');
  
           // Valider l'activité, par exemple, en mettant à jour un champ
           $ractivite->update([
               'statut5' => 0,
               'statut6' => 1,
               'validation_supperieur' => 'rejeter',
               'motif3' => $motifRejet,
           ]);
  // Mettre à jour le champ statutfin dans la table Mission
  Activite::where('id', $ractivite->id)->update(['statutfin' => 1]);
  
           // Vous pouvez également ajouter d'autres traitements, comme l'envoi d'e-mails, etc.
  
           return redirect()->back()->with('danger', 'Rejerter avec succès.');
       }




       //Validation du rapport de mission


       public function validrmission1()
       {
           $rmissions = Rmission::latest()->paginate(25);
   
           return view('validations.validationrmission1', compact('rmissions'))
               ->with('i', (request()->input('page', 1) - 1) * 25);
       }
   
       public function validerrmission1(Request $request, $id)
       {
           // Récupérer l'activité par son ID
           $rmission = Rmission::findOrFail($id);
   
           // Valider l'activité, par exemple, en mettant à jour un champ
           $rmission->update([
               'statut1' => 1,
               'statut2' => 0,
               'motif1' => 'RAS',
               'validation_finance' => 'valider',
           ]);
   
           // Vous pouvez également ajouter d'autres traitements, comme l'envoi d'e-mails, etc.
   
           return redirect()->back()->with('success', 'validée avec succès.');
       }
   
       public function rejeterrmission1(Request $request, $id)
       {
           // Récupérer l'activité par son ID
           $rmission = Rmission::findOrFail($id);
           $motifRejet = $request->input('motif');
   
           // Valider l'activité, par exemple, en mettant à jour un champ
           $rmission->update([
               'statut1' => 0,
               'statut2' => 1,
               'validation_finance' => 'rejeter',
               'motif1' => $motifRejet,
           ]);
   
   
           // Vous pouvez également ajouter d'autres traitements, comme l'envoi d'e-mails, etc.
   
           return redirect()->back()->with('success', 'Rejerter avec succès.');
       }
   
   
   
       // POUR LA VALIDATION RAF
       public function validrmission2()
       {
           $rmissions = Rmission::latest()->paginate(25);
   
           return view('validations.validationrmission2', compact('rmissions'))
               ->with('i', (request()->input('page', 1) - 1) * 25);
       }
   
       public function validerrmission2(Request $request, $id)
       {
           // Récupérer l'activité par son ID
           $rmission = Rmission::findOrFail($id);
   
           // Valider l'activité, par exemple, en mettant à jour un champ
           $rmission->update([
               'statut3' => 1,
               'statut4' => 0,
               'motif2' => 'RAS',
               'validation_raf' => 'valider',
           ]);
   
           // Vous pouvez également ajouter d'autres traitements, comme l'envoi d'e-mails, etc.
   
           return redirect()->back()->with('success', 'validée avec succès.');
       }
   
       public function rejeterrmission2(Request $request, $id)
       {
           // Récupérer l'activité par son ID
           $rmission = Rmission::findOrFail($id);
           $motifRejet = $request->input('motif');
   
           // Valider l'activité, par exemple, en mettant à jour un champ
           $rmission->update([
               'statut3' => 0,
               'statut4' => 1,
               'validation_raf' => 'rejeter',
               'motif2' => $motifRejet,
           ]);
   
   
           // Vous pouvez également ajouter d'autres traitements, comme l'envoi d'e-mails, etc.
   
           return redirect()->back()->with('success', 'Rejerter avec succès.');
       }
   
        // POUR LA VALIDATION SUPPERIEUR
        public function validrmission3()
        {
            $rmissions = Rmission::latest()->paginate(25);
   
            return view('validations.validationrmission3', compact('rmissions'))
                ->with('i', (request()->input('page', 1) - 1) * 25);
        }
   
        public function validerrmission3(Request $request, $id)
        {
            // Récupérer l'activité par son ID
            $rmission = Rmission::findOrFail($id);
   
            // Valider l'activité, par exemple, en mettant à jour un champ
            $rmission->update([
                'statut5' => 1,
                'statut6' => 0,
                'motif3' => 'RAS',
                'validation_supperieur' => 'valider',
            ]);
   // Mettre à jour le champ statutfin dans la table Mission
   Mission::where('id', $rmission->id)->update(['statutfin' => 0]);
            // Vous pouvez également ajouter d'autres traitements, comme l'envoi d'e-mails, etc.
   
            return redirect()->back()->with('success', 'validée avec succès.');
        }
   
        public function rejeterrmission3(Request $request, $id)
        {
            // Récupérer l'activité par son ID
            $rmission = Rmission::findOrFail($id);
            $motifRejet = $request->input('motif');
   
            // Valider l'activité, par exemple, en mettant à jour un champ
            $rmission->update([
                'statut5' => 0,
                'statut6' => 1,
                'validation_supperieur' => 'rejeter',
                'motif3' => $motifRejet,
            ]);
   // Mettre à jour le champ statutfin dans la table Mission
   Mission::where('id', $rmission->id)->update(['statutfin' => 1]);
   
            // Vous pouvez également ajouter d'autres traitements, comme l'envoi d'e-mails, etc.
   
            return redirect()->back()->with('danger', 'Rejerter avec succès.');
        }








//STOP STOP
   



   

    }