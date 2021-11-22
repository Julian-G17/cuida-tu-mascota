import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { PerfilMascotaPageRoutingModule } from './perfil-mascota-routing.module';

import { PerfilMascotaPage } from './perfil-mascota.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    PerfilMascotaPageRoutingModule
  ],
  declarations: [PerfilMascotaPage]
})
export class PerfilMascotaPageModule {}
