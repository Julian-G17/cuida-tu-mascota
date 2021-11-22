import { Component } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { ActivatedRoute } from '@angular/router';
import { ApiService } from '../api.service';
import { AlertController } from '@ionic/angular';
import { Router } from "@angular/router";

@Component({
  selector: 'app-registro-mascota',
  templateUrl: './registro-mascota.page.html',
  styleUrls: ['./registro-mascota.page.scss'],
})

export class RegistroMascotaPage {

  dataFromService : any="" ;
  nombre:string;
  edad:string;
  animal:string;
  raza:string;
  foto:string;
  idUsuario:string;

  constructor(
    private http: HttpClient,
    private activatedRoute: ActivatedRoute,
    public userService:ApiService,
    public alertController : AlertController,
    private router : Router
  ) { }

  async alertaCorrecta(message) {
    const alert = await this.alertController.create({
      header: 'Completado',
      message: message,
      buttons: ['Volver']
    });

    await alert.present();
  }

  SaveData(){
    this.idUsuario = localStorage.getItem("Id");
    var userData ={nombre:this.nombre,edad:this.edad,animal:this.animal,raza:this.raza,foto_mascota:"http://localhost/cuida-tu-mascota/api/img_mascotas/default.jpg",id_usuario:this.idUsuario};
    this.userService.SaveDataRegistroMascota(userData).subscribe(dataReturnFromService => {

      this.dataFromService = JSON.stringify(dataReturnFromService);

      this.alertaCorrecta("Mascota agregada correctamente");
    } , error =>{
      console.log(error);
      
    });
  }

}


