import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { HttpClient } from '@angular/common/http';
import { ApiService } from '../api.service';
import { AlertController } from '@ionic/angular';
import { Router } from "@angular/router";

@Component({
  selector: 'app-info-rutinas',
  templateUrl: './info-rutinas.page.html',
  styleUrls: ['./info-rutinas.page.scss'],
})
export class InfoRutinasPage implements OnInit {

  idRutina: string;
  id_rutina;
  nombre;
  descripcion;
  fecha;
  hora;
  id_mascota;

  constructor(
    private http: HttpClient,
    private activatedRoute: ActivatedRoute,
    public userService:ApiService,
    public alertController : AlertController,
    private router : Router
  ) { }

  ngOnInit() {
    this.idRutina = this.activatedRoute.snapshot.paramMap.get('id')
    console.log(this.idRutina);

    this.http.get('http://localhost/cuida-tu-mascota/api/rutinas/read_one.php?id=' + this.idRutina)
      .subscribe(res => this.id_rutina = res[0].id_rutina)
    this.http.get('http://localhost/cuida-tu-mascota/api/rutinas/read_one.php?id=' + this.idRutina)
      .subscribe(res => this.nombre = res[0].nombre)
    this.http.get('http://localhost/cuida-tu-mascota/api/rutinas/read_one.php?id=' + this.idRutina)
      .subscribe(res => this.descripcion = res[0].descripcion)
    this.http.get('http://localhost/cuida-tu-mascota/api/rutinas/read_one.php?id=' + this.idRutina)
      .subscribe(res => this.fecha = res[0].fecha)
    this.http.get('http://localhost/cuida-tu-mascota/api/rutinas/read_one.php?id=' + this.idRutina)
      .subscribe(res => this.hora = res[0].hora)
    this.http.get('http://localhost/cuida-tu-mascota/api/rutinas/read_one.php?id=' + this.idRutina)
      .subscribe(res => this.id_mascota = res[0].id_mascota)
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
    this.userService.DeleteRutina({id_rutina : this.id_rutina})
      .subscribe(res => console.log(res), error => console.error(error));
    this.alertaCorrecta("Rutina eliminada correctamente");
  }

}
