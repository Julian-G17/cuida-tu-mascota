import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { ActivatedRoute } from '@angular/router';
import { ApiService } from '../api.service';
import { AlertController } from '@ionic/angular';
import { Router } from "@angular/router";

@Component({
  selector: 'app-registro-rutinas',
  templateUrl: './registro-rutinas.page.html',
  styleUrls: ['./registro-rutinas.page.scss'],
})
export class RegistroRutinasPage implements OnInit {

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
    this.userService.SaveDataRegistroRutina(userData).subscribe(dataReturnFromService => {

      this.dataFromService = JSON.stringify(dataReturnFromService);
      console.log(this.dataFromService);
      this.alertaCorrecta("Rutina creada correctamente");
    } , error =>{
      console.log(error);
      
    });
  }

}