import { Component } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { ActivatedRoute } from '@angular/router';
import { ApiService } from '../api.service';
import { AlertController } from '@ionic/angular';
import { Router } from "@angular/router";

@Component({
  selector: 'app-home',
  templateUrl: 'home.page.html',
  styleUrls: ['home.page.scss'],
})

export class HomePage {

  dataFromService : any="" ;
  usuario:string;
  contrasena:string;

  constructor(
    private http: HttpClient,
    private activatedRoute: ActivatedRoute,
    public userService:ApiService,
    public alertController : AlertController,
    private router : Router
  ) {}

  SaveData(){
    
    var userData ={username:this.usuario,contrasena:this.contrasena};
    this.userService.LoginUser(userData).subscribe(dataReturnFromService => {

      this.dataFromService = JSON.stringify(dataReturnFromService);
  
      localStorage.setItem("Nombre",dataReturnFromService["nombre"]);      
      localStorage.setItem("Id",dataReturnFromService["id_usuario"]);   
      this.router.navigate(['/lista-mascotas/']); 

    } , error =>{
      console.log(error);
      
      if(error.status == 404){
        this.alertaError("El usuario o la contraseña son incorrectos");
      }else{
        this.alertaError("Hay un problema con el servicio, intentalo más tarde");
      }
      
    });
  }

  async alertaError(message) {
    const alert = await this.alertController.create({
      header: 'Error al iniciar sesión',
      message: message,
      buttons: ['Volver']
    });

    await alert.present();
  }

}
