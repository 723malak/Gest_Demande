<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArDG;
use Illuminate\Support\Facades\DB; // Importez la classe DB



class articlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($metierId)
    {
        $articles = ArDG::join('metiers', 'argd.metier_id', '=', 'metiers.id')
                        ->where('argd.metier_id', $metierId)
                        ->select('argd.*', 'metiers.libelle as metier_libelle')
                        ->paginate(10); // Le nombre d'articles à afficher par page
    
        return view('content.demande.articles', compact('articles'));
    }
    

public function create()
{
    //
}

public function store(Request $request)
{
    $data = $request->validate([
        'code' => 'required',
        'liblee' => 'required',
        'prix' => 'required|numeric',
        'metier_id' => 'required',
    ]);

    $argd = new ArDG;
    $argd->code = $data['code'];
    $argd->liblee = $data['liblee'];
    $argd->prix = $data['prix'];
    $argd->metier_id = $data['metier_id'];

    // Assurez-vous de remplir les autres colonnes nécessaires
    $argd->save();

    $parametre = $data['metier_id']; // Remplacez par la valeur appropriée
    return redirect()->route('demande-articles', ['parametre' => $parametre])->with('success', 'Article créé avec succès..');
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
        $data = $request->validate([
            'code' => 'required',
            'liblee' => 'required',
            'prix' => 'required|numeric',
        ]);
    
        $argd = ArDG::findOrFail($id);
        $argd->code = $data['code'];
        $argd->liblee = $data['liblee'];
        $argd->prix = $data['prix'];
    
        // Assurez-vous de remplir les autres colonnes nécessaires
        $argd->save();
    
        return redirect()->route('demande-articles', ['parametre' => $argd->metier_id])->with('success', 'Article mis à jour avec succès.');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ArDG $article)
    {
        // Récupérer l'ID du métier avant la suppression
        $metierId = $article->metier_id;
    
        // Supprimer l'article
        $article->delete();
    
        // Rediriger ou afficher un message approprié
        return redirect()->route('demande-articles', ['parametre' => $metierId])->with('success', 'Article supprimé avec succès.');
    }
    
    
}
