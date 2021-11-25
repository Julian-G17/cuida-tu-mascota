import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { InfoEventosPageRoutingModule } from './info-eventos-routing.module';

import { InfoEventosPage } from './info-eventos.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    InfoEventosPageRoutingModule
  ],
  declarations: [InfoEventosPage]
})
export class InfoEventosPageModule {}
