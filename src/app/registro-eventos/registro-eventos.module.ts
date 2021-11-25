import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { RegistroEventosPageRoutingModule } from './registro-eventos-routing.module';

import { RegistroEventosPage } from './registro-eventos.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    RegistroEventosPageRoutingModule
  ],
  declarations: [RegistroEventosPage]
})
export class RegistroEventosPageModule {}
