<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;


class MenuServiceProvider extends ServiceProvider
{
  /**
   * Register services.
   *
   * @return void
   */
  public function register()
  {
    //
  }

  /**
   * Bootstrap services.
   *
   * @return void
   */
  public function boot()
  {
      if (Auth::check()) {
          // Récupérer le profil de l'utilisateur connecté
          $user = Auth::user();
          $profil = $user->Profil;
  
          // Déterminer le nom du fichier JSON du menu en fonction du profil
          $menuFileName = $profil . 'Menu.json';
  
          // Vérifier si le fichier JSON du menu existe
          if (file_exists(base_path('resources/menu/' . $menuFileName))) {
              // Charger le contenu du fichier JSON du menu correspondant au profil
              $menuData = file_get_contents(base_path('resources/menu/' . $menuFileName));
              $menuData = json_decode($menuData);
  
              // Partager les données du menu avec toutes les vues
              \View::share('menuData', [$menuData]);
          } else {
              // Fichier JSON du menu non trouvé pour le profil donné, gérer l'erreur ou utiliser un menu par défaut
          }
      }
  }
  
  }
  

