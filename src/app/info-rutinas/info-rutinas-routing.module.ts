import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { InfoRutinasPage } from './info-rutinas.page';

const routes: Routes = [
  {
    path: '',
    component: InfoRutinasPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class InfoRutinasPageRoutingModule {}
