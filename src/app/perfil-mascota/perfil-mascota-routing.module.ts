import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { PerfilMascotaPage } from './perfil-mascota.page';

const routes: Routes = [
  {
    path: '',
    component: PerfilMascotaPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class PerfilMascotaPageRoutingModule {}
