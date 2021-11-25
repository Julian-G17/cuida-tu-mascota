import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { ActivatedRoute } from '@angular/router';
import { ApiService } from '../api.service';
import { AlertController } from '@ionic/angular';
import { Router } from "@angular/router";


@Component({
  selector: 'app-registro-eventos',
  templateUrl: './registro-eventos.page.html',
  styleUrls: ['./registro-eventos.page.scss'],
})
export class RegistroEventosPage implements OnInit {

  dataFromService : any="" ;
  nombre:string;
  descripcion:string;
  fecha:string;
  hora:string;
  idMascota:string;

  constructor(
    private http: HttpClient,
    private activatedRoute: ActivatedRoute,
    public userService:ApiService,
    public alertController : AlertController,
    private router : Router
  ) { }

  ngOnInit() {
    this.idMascota = this.activatedRoute.snapshot.paramMap.get('id')
  }

  async alertaCorrecta(message) {
    const alert = await this.alertController.create({
      header: 'Completado',
      message: message,
      buttons: ['Volver']
    });

    await alert.present();
  }

  SaveData(){
    var userData ={nombre:this.nombre,descripcion:this.descripcion,fecha:this.fecha,hora:this.hora,id_mascota:this.idMascota};
    this.userService.SaveDataRegistroEvento(userData).subscribe(dataReturnFromService => {

      this.dataFromService = JSON.stringify(dataReturnFromService);
      console.log(this.dataFromService);
      this.alertaCorrecta("Evento creado correctamente");
    } , error =>{
      console.log(error);
      
    });
  }

}
