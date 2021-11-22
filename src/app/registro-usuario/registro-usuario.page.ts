import { Component } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { ActivatedRoute } from '@angular/router';
import { ApiService } from '../api.service';
import { AlertController } from '@ionic/angular';
import { Router } from "@angular/router";

@Component({
  selector: 'app-registro-usuario',
  templateUrl: './registro-usuario.page.html',
  styleUrls: ['./registro-usuario.page.scss'],
})

export class RegistroUsuarioPage {

  dataFromService : any="" ;
  nombre:string;
  usuario:string;
  contrasena:string;

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
    
    var userData ={nombre:this.nombre,username:this.usuario,contrasena:this.contrasena};
    this.userService.SaveDataRegistro(userData).subscribe(dataReturnFromService => {

      this.dataFromService = JSON.stringify(dataReturnFromService);

      this.alertaCorrecta("Usuario creado correctamente");
    } , error =>{
      console.log(error);
      
    });
  }

}
