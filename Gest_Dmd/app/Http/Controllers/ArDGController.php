<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Importez la classe DB
use App\Models\ArDG;
use App\Models\demande;
use App\Models\Consultation;
use App\Models\ConsultationArticle;







class ArDGController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

 public function showWithId($id)
{
    $article = DB::table('argd')
                ->select('*')
                ->where('argd.metier_id', '=', $id)
                ->get();
    
    if (!$article) {
        abort(404);
    }
    
    return $article;
}

    public function index()
    {
        return view('content.demande.ajout');

    }

    public function acceuil()
    {
        return view('content.demande.acceuil');

    }


    public function list()
    {
        return view('content.demande.list');
    }

    public function listArchive()
    {
        return view('content.demande.archives');
    }
    
      public function plus(Request $request, $id)
    {
        $result = DB::table('demandes')
            ->join('consultations', 'demandes.id', '=', 'consultations.id_dmd')
            ->join('estimations', 'consultations.id', '=', 'estimations.id_consultation')
            ->select('demandes.*', 'consultations.*', 'estimations.*', 'consultations.id AS idC', 'demandes.id AS idD')
            ->where('demandes.id', $id)
            ->first();

        return view('content.demande.plus',compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function updateDemande(Request $request, $id)
    {   
        
            $file_path = '';
        
            if ($request->hasFile('cahier_charge')) {
                $file = $request->file('cahier_charge');
                $file_path = $file->store('public/cahier_charges');
                $file_path = str_replace('public/', '', $file_path);
            }
        
            $demandeData = [
                'objet_demande' => $request->input('objet_demande'),
                'date_demande' => now(),
                'idUser' => 1,
                'cahier_charge' => $file_path,
            ];
        
            Demande::where('id', $id)->update($demandeData);
        
            $consultationData = [
                'id_pb' => $request->input('id_pb'),
                'Cons_Directe' => $request->input('Cons_Directe'),
                'Reception_Usine' => $request->input('Reception_Usine'),
                'Note_Formation' => $request->input('Note_Formation'),
                'Plans' => $request->input('Plans'),
                'Rapport_Informaif' => $request->input('Rapport_Informaif'),
                'Revision_Prix' => $request->input('Revision_Prix'),
                'Reunion_Visite' => $request->input('Reunion_Visite'),
                'Allotissement' => $request->input('Allotissement'),
                'Critere_Attribution' => $request->input('Critere_Attribution'),
                'Offre_Variante' => $request->input('Offre_Variante'),
                'Degre_priorite' => $request->input('Degre_priorite'),
                'Periode_Garantie' => $request->input('Periode_Garantie'),
                'echantillons' => $request->input('echantillons'),
                'offre_technique' => $request->input('offre_technique'),
                'num_travail' => $request->input('num_travail'),
                'type_de_prestation' => $request->input('type_de_prestation'),
                'nature_commande' => $request->input('nature_commande'),
                'commentaire' => $request->input('commentaire'),
            ];
        
            if ($request->hasFile('fiche_tec')) {
                $file = $request->file('fiche_tec');
                $file_path1 = $file->store('public/cahier_charges');
                $file_path1 = str_replace('public/', '', $file_path1);
                $consultationData['fiche_tec'] = $file_path1;
            }
        
            if ($request->hasFile('Documentation')) {
                $file = $request->file('Documentation');
                $file_path2 = $file->store('public/cahier_charges');
                $file_path2 = str_replace('public/', '', $file_path2);
                $consultationData['Documentation'] = $file_path2;
            }
        
            $consultation = Consultation::where('id_dmd', $id)->first(); // Récupère l'objet Consultation à mettre à jour
            $consultation->fill($consultationData); // Affecte les nouvelles données à l'objet Consultation
            $consultation->save(); // Sauvegarde les modifications dans la base de données
            
        
            $articles = $request->input('article');
            $qtes = $request->input('qte');
            $prix = $request->input('prix');
            $indice = $request->input('indice');
        
            // Supprimer les anciennes données dans la table "consultation_articles" pour cette consultation
            ConsultationArticle::where('id_consultation',$consultation->id )->delete();
        
            // // Enregistrement des nouvelles données dans la table "consultation_articles"
            foreach ($articles as $key => $articleId) {
                $qte = $qtes[$key];
                $prixArticle = $prix[$key];
        
                $consultationArticle = new ConsultationArticle();
                $consultationArticle->id_consultation = $consultation->id;
                $consultationArticle->id_article = $articleId;
                $consultationArticle->Qte = $qte;
                $consultationArticle->total = $qte * $prixArticle;
                $consultationArticle->save();
            }
        
            return redirect()->route('demande-list')->with('success', 'La demande est enregistrée avec succès');
        }
        
        
    
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
