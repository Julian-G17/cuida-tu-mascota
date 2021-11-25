import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { InfoEventosPage } from './info-eventos.page';

const routes: Routes = [
  {
    path: '',
    component: InfoEventosPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class InfoEventosPageRoutingModule {}
