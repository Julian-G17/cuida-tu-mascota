import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { RegistroEventosPage } from './registro-eventos.page';

const routes: Routes = [
  {
    path: '',
    component: RegistroEventosPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class RegistroEventosPageRoutingModule {}
