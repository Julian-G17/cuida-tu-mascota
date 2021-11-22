import { NgModule } from '@angular/core';
import { PreloadAllModules, RouterModule, Routes } from '@angular/router';

const routes: Routes = [
  {
    path: 'home',
    loadChildren: () => import('./home/home.module').then( m => m.HomePageModule)
  },
  {
    path: '',
    redirectTo: 'home',
    pathMatch: 'full'
  },
  {
    path: 'registro-usuario',
    loadChildren: () => import('./registro-usuario/registro-usuario.module').then( m => m.RegistroUsuarioPageModule)
  },
  {
    path: 'lista-mascotas',
    loadChildren: () => import('./lista-mascotas/lista-mascotas.module').then( m => m.ListaMascotasPageModule)
  },
  {
    path: 'perfil-mascota/:id',
    loadChildren: () => import('./perfil-mascota/perfil-mascota.module').then( m => m.PerfilMascotaPageModule)
  },
  {
    path: 'registro-mascota',
    loadChildren: () => import('./registro-mascota/registro-mascota.module').then( m => m.RegistroMascotaPageModule)
  },
];

@NgModule({
  imports: [
    RouterModule.forRoot(routes, { preloadingStrategy: PreloadAllModules })
  ],
  exports: [RouterModule]
})
export class AppRoutingModule { }
