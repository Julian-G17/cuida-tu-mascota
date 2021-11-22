import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { ListaMascotasPage } from './lista-mascotas.page';

const routes: Routes = [
  {
    path: '',
    component: ListaMascotasPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class ListaMascotasPageRoutingModule {}
