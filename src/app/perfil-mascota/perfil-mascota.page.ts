import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { HttpClient } from '@angular/common/http';
import { ApiService } from '../api.service';
import { AlertController } from '@ionic/angular';
import { Router } from "@angular/router";

@Component({
  selector: 'app-perfil-mascota',
  templateUrl: './perfil-mascota.page.html',
  styleUrls: ['./perfil-mascota.page.scss'],
})

export class PerfilMascotaPage implements OnInit {

  idMascota: string;
  id;
  nombre;
  edad;
  animal;
  raza;
  foto;
  id_usuario;

  constructor(
    private http: HttpClient,
    private activatedRoute: ActivatedRoute,
    public userService:ApiService,
    public alertController : AlertController,
    private router : Router
  ) { }

  ngOnInit() {
    const id_mascota = localStorage.getItem("Id");

    this.idMascota = this.activatedRoute.snapshot.paramMap.get('id')
    this.http.get('http://localhost/cuida-tu-mascota/api/mascota/read_one.php?id=' + this.idMascota)
      .subscribe(res => this.nombre = res[0].nombre)
    this.http.get('http://localhost/cuida-tu-mascota/api/mascota/read_one.php?id=' + this.idMascota)
      .subscribe(res => this.edad = res[0].edad)
    this.http.get('http://localhost/cuida-tu-mascota/api/mascota/read_one.php?id=' + this.idMascota)
      .subscribe(res => this.animal = res[0].animal)
    this.http.get('http://localhost/cuida-tu-mascota/api/mascota/read_one.php?id=' + this.idMascota)
      .subscribe(res => this.raza = res[0].raza)
    this.http.get('http://localhost/cuida-tu-mascota/api/mascota/read_one.php?id=' + this.idMascota)
    .subscribe(res => this.foto = res[0].foto_mascota)
    this.http.get('http://localhost/cuida-tu-mascota/api/mascota/read_one.php?id=' + this.idMascota)
    .subscribe(res => this.id = res[0].id_mascota)
    this.http.get('http://localhost/cuida-tu-mascota/api/mascota/read_one.php?id=' + this.idMascota)
    .subscribe(res => this.id_usuario = res[0].id_usuario)
      
  }

  async alertaCorrecta(message) {
    const alert = await this.alertController.create({
      header: 'Completado',
      message: message,
      buttons: ['Volver']

    });
    await alert.present();
  }

  delete(){
    this.userService.DeleteMascota({id_mascota : this.id})
      .subscribe(res => console.log(res), error => console.error(error));
    this.alertaCorrecta("Mascota eliminada correctamente");
  }


}

