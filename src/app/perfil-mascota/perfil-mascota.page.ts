import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { HttpClient } from '@angular/common/http';

@Component({
  selector: 'app-perfil-mascota',
  templateUrl: './perfil-mascota.page.html',
  styleUrls: ['./perfil-mascota.page.scss'],
})

export class PerfilMascotaPage implements OnInit {

  idMascota: string;
  nombre;
  edad;
  animal;
  raza;
  foto;

  constructor(
    private activatedRoute: ActivatedRoute,
    private http: HttpClient
  ) { }

  ngOnInit() {

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
      
  }
}

