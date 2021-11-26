import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { InfoRutinasPageRoutingModule } from './info-rutinas-routing.module';

import { InfoRutinasPage } from './info-rutinas.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    InfoRutinasPageRoutingModule
  ],
  declarations: [InfoRutinasPage]
})
export class InfoRutinasPageModule {}
