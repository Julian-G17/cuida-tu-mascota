import { Component, OnInit } from '@angular/core';
import { ApiService } from '../api.service';
import { HttpClient } from '@angular/common/http';


@Component({
  selector: 'app-lista-mascotas',
  templateUrl: './lista-mascotas.page.html',
  styleUrls: ['./lista-mascotas.page.scss'],
})
export class ListaMascotasPage implements OnInit {

  mascotas = [];
  nombre = "";

  constructor(
    private http: HttpClient,
    public userService:ApiService
  ) { }

  ngOnInit() {

    const id_usuario = localStorage.getItem("Id");
    this.nombre = localStorage.getItem("Nombre");

    this.http.get<any>( 'http://localhost/cuida-tu-mascota/api/mascota/read.php?id_usuario='+id_usuario)
    .subscribe(res=> {
      this.mascotas = res[0].records;
      console.log(this.mascotas);
    })

  }



}
