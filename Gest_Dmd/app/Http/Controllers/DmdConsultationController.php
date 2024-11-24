<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB; // Importez la classe DB


use Illuminate\Http\Request;

use App\Models\consultation;

use App\Models\demande;
use App\Models\projetBudgetaire;
use App\Models\ConsultationArticle;
use App\Models\estimation;





class DmdConsultationController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     * App\Http\Controllers\ConsultationArticle
     * 
     */

    
     public function getProjetBudgetaireData($idMetier) {
        $projetBudgetaireData = DB::table('projetbudgetaire')
                                ->select('id', 'Nom_Projet')
                                ->where('metiers_id', $idMetier)
                                ->get()
                                ->toArray();
    
        return $projetBudgetaireData;
    }
    

    public function getListeDemande()
    {
    
        $result = DB::table('demandes')
            ->join('consultations', 'demandes.id', '=', 'consultations.id_dmd')
            ->join('estimations', 'consultations.id', '=', 'estimations.id_consultation')
            ->select('demandes.*', 'consultations.*', 'estimations.*', 'consultations.id AS idC', 'demandes.id AS idD')
            ->get();
    
        return $result;
    }
    

public function plus(Request $request, $id)
{
    $result = DB::table('demandes')
        ->join('consultations', 'demandes.id', '=', 'consultations.id_dmd')
        ->join('estimations', 'consultations.id', '=', 'estimations.id_consultation')
        ->select('demandes.*', 'consultations.*', 'estimations.*', 'consultations.id AS idC','demandes.id AS idD')
        ->where('demandes.id', $id)
        ->first();

        dd($result);
    }

public function dataFormEdit(Request $request, $id)
{
    $result = DB::table('demandes')
        ->join('consultations', 'demandes.id', '=', 'consultations.id_dmd')
        ->join('estimations', 'consultations.id', '=', 'estimations.id_consultation')
        ->select('demandes.*', 'consultations.*', 'estimations.*', 'consultations.id AS idC','estimations.id AS idE','demandes.id AS idD')
        ->where('demandes.id', $id)
        ->first();

    return view('content.demande.editDemande',compact('result'));
}


public function getConsultationData($consultationId)
{
    $consultationData = DB::table('consultations AS c')
        ->join('estimations AS e', 'c.id', '=', 'e.id_consultation')
        ->join('consultation_articles AS ca', 'c.id', '=', 'ca.id_consultation')
        ->join('argd AS a', 'ca.id_article', '=', 'a.id')
        ->select('c.*', 'e.*', 'ca.*', 'a.*')
        ->where('c.id', $consultationId)
        ->get();
    
    return $consultationData;
}

public function fetchArtcileSelecte($consultationId)
{
    $result = DB::table('consultations')
        ->join('consultation_articles', 'consultations.id', '=', 'consultation_articles.id_consultation')
        ->join('argd', 'consultation_articles.id_article', '=', 'argd.id')
        ->where('consultations.id', $consultationId)
        ->select('*')
        ->get();
    return $result;
}



    public function index()
    {
        //
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $file_path = '';
        if($request->hasFile('cahier_charge')) {
            $file = $request->file('cahier_charge');
            $file_path = $file->store('public/cahier_charges');
            $file_path = str_replace('public/', '', $file_path);
        }
        $demande = new Demande([
            'objet_demande' => $request->input('objet_demande'),
            'objet_demande' => $request->input('objet_demande'),
            'idUser' => $request->input('idUser'),
            'date_demande' => now(),
        ]);
        
        
        $demande->cahier_charge=$file_path;
        $demande->save();
        $id=$demande->id;
        $file_path1='';
        if($request->hasFile('fiche_tec')) {
            $file = $request->file('fiche_tec');
            $file_path1 = $file->store('public/cahier_charges');
            $file_path1 = str_replace('public/', '', $file_path1);
        }
        $file_path2='';
        if($request->hasFile('Documentation')) {
            $file = $request->file('Documentation');
            $file_path2 = $file->store('public/cahier_charges');
            $file_path2 = str_replace('public/', '', $file_path2);
        }
        

        
        
        
        $consultation = new Consultation([
            'id_pb' => $request->input('id_pb'),
            // 'id_dmd' => $request->input('id_dmd'),
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
            // 'fiche_tec' => $request->input('fiche_tec'),
            // 'Documentation' => $request->input('Documentation'),
            'echantillons' => $request->input('echantillons'),
            'offre_technique' => $request->input('offre_technique'),
            'num_travail' => $request->input('num_travail'),
            'type_de_prestation' => $request->input('type_de_prestation'),
            'nature_commande' => $request->input('nature_commande'),
            'commentaire' => $request->input('commentaire')
        ]);
            $consultation->id_dmd=$id;
            $consultation->Documentation=$file_path2;
            $consultation->fiche_tec=$file_path1;
            $consultation->save();
        
            $articles = $request->input('article');
            $qtes = $request->input('qte');
            $prix = $request->input('prix');
            $indice = $request->input('indice');
        
            //  dd($articles);
            // dd($prix);
            // dd($qtes);
            // dd($prix);
            
            // Enregistrement des données dans la table "estimations"
            $estimation = new Estimation();
            $estimation->id_consultation = $consultation->id;
            $estimation->num_estimation = $request->input('num_estimation');
            $estimation->total_DHHT = $request->input('total_DHHT');
            $estimation->TotalDHTTC = $request->input('TotalDHTTC');
            $estimation->save();
            
            // Vérifier la taille des tableaux avant la boFucle
            // $size = min(count($articles), count($qtes), count($prix));
            
            // Enregistrement des données dans la table "consultation_articles"
            $i=0;
            foreach ($articles as $key => $articleId) {
              
                $qte = $qtes[$key];
                $prixArticle = $prix[$key];
          
              
                  $ConsultationArticles = new ConsultationArticle();
                  $ConsultationArticles->id_consultation = $consultation->id;
                  $ConsultationArticles->id_article = $articleId;
                  $ConsultationArticles->Qte = $qte;
                  $ConsultationArticles->total = $qte * $prixArticle;
                  $ConsultationArticles->save();
                
              }
              return redirect()->route('demande-list')->with('success', 'La demande est enregistrée avec succès');
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
    public function updateDemande(Request $request, $id)
    {
        $file_path = '';
        if ($request->hasFile('cahier_charge')) {
            $file = $request->file('cahier_charge');
            $file_path = $file->store('public/cahier_charges');
            $file_path = str_replace('public/', '', $file_path);
        }
    
        $demande = Demande::findOrFail($id);
        $demande->objet_demande = $request->input('objet_demande');
        $demande->date_demande = now();
        $demande->idUser = 1;
        $demande->cahier_charge = $file_path;
    
        $visaColumns = ['visa_hierarchie', 'visa_achat', 'visa_budget', 'visa_daf', 'visa_Dg'];
    
        foreach ($visaColumns as $column) {
            if ($demande->$column === 'refuse') {
                $demande->$column = 'en cours de traitement';
            }
        }
    
        $demande->save();
    
        $consultation = Consultation::findOrFail($id);
        $consultation->id_pb = $request->input('id_pb');
        $consultation->Cons_Directe = $request->input('Cons_Directe');
        $consultation->Reception_Usine = $request->input('Reception_Usine');
        $consultation->Note_Formation = $request->input('Note_Formation');
        $consultation->Plans = $request->input('Plans');
        $consultation->Rapport_Informaif = $request->input('Rapport_Informaif');
        $consultation->Revision_Prix = $request->input('Revision_Prix');
        $consultation->Reunion_Visite = $request->input('Reunion_Visite');
        $consultation->Allotissement = $request->input('Allotissement');
        $consultation->Critere_Attribution = $request->input('Critere_Attribution');
        $consultation->Offre_Variante = $request->input('Offre_Variante');
        $consultation->Degre_priorite = $request->input('Degre_priorite');
        $consultation->Periode_Garantie = $request->input('Periode_Garantie');
        $consultation->echantillons = $request->input('echantillons');
        $consultation->offre_technique = $request->input('offre_technique');
        $consultation->num_travail = $request->input('num_travail');
        $consultation->type_de_prestation = $request->input('type_de_prestation');
        $consultation->nature_commande = $request->input('nature_commande');
        $consultation->commentaire = $request->input('commentaire');
    
        if ($request->hasFile('fiche_tec')) {
            $file = $request->file('fiche_tec');
            $file_path1 = $file->store('public/cahier_charges');
            $file_path1 = str_replace('public/', '', $file_path1);
            $consultation->fiche_tec = $file_path1;
        }
    
        if ($request->hasFile('Documentation')) {
            $file = $request->file('Documentation');
            $file_path2 = $file->store('public/cahier_charges');
            $file_path2 = str_replace('public/', '', $file_path2);
            $consultation->Documentation = $file_path2;
        }
    
        $consultation->save();
    
        $articles = $request->input('article');
        $qtes = $request->input('qte');
        $prix = $request->input('prix');
        $indice = $request->input('indice');
    
        ConsultationArticle::where('id_consultation', $id)->delete();
    
        foreach ($articles as $key => $articleId) {
            $qte = $qtes[$key];
            $prixArticle = $prix[$key];
    
            $consultationArticle = new ConsultationArticle();
            $consultationArticle->id_consultation = $id;
            $consultationArticle->id_article = $articleId;
            $consultationArticle->Qte = $qte;
            $consultationArticle->total = $qte * $prixArticle;
            $consultationArticle->save();
        }
    
        return redirect()->back()->with('success', 'Les données ont été mises à jour avec succès');
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
