import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { HttpClient } from '@angular/common/http';
import { ApiService } from '../api.service';
import { AlertController } from '@ionic/angular';
import { Router } from "@angular/router";

@Component({
  selector: 'app-info-eventos',
  templateUrl: './info-eventos.page.html',
  styleUrls: ['./info-eventos.page.scss'],
})
export class InfoEventosPage implements OnInit {

  idEvento: string;
  id_eventos;
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

    this.idEvento = this.activatedRoute.snapshot.paramMap.get('id')
    console.log(this.idEvento);
    this.http.get('http://localhost/cuida-tu-mascota/api/eventos/read_one.php?id=' + this.idEvento)
      .subscribe(res => this.id_eventos = res[0].id_eventos)
    this.http.get('http://localhost/cuida-tu-mascota/api/eventos/read_one.php?id=' + this.idEvento)
      .subscribe(res => this.nombre = res[0].nombre)
    this.http.get('http://localhost/cuida-tu-mascota/api/eventos/read_one.php?id=' + this.idEvento)
      .subscribe(res => this.descripcion = res[0].descripcion)
    this.http.get('http://localhost/cuida-tu-mascota/api/eventos/read_one.php?id=' + this.idEvento)
      .subscribe(res => this.fecha = res[0].fecha)
    this.http.get('http://localhost/cuida-tu-mascota/api/eventos/read_one.php?id=' + this.idEvento)
      .subscribe(res => this.hora = res[0].hora)
    this.http.get('http://localhost/cuida-tu-mascota/api/eventos/read_one.php?id=' + this.idEvento)
      .subscribe(res => this.id_mascota = res[0].id_mascota)
  }
  
  delete(){
    this.userService.DeleteEvento(this.id_eventos);
  }

}
