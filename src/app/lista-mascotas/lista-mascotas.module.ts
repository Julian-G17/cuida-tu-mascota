import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { ListaMascotasPageRoutingModule } from './lista-mascotas-routing.module';

import { ListaMascotasPage } from './lista-mascotas.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    ListaMascotasPageRoutingModule
  ],
  declarations: [ListaMascotasPage]
})
export class ListaMascotasPageModule {}
