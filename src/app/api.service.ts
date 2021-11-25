import { Injectable } from '@angular/core';
import {HttpClient , HttpHeaders} from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class ApiService {

  constructor(
    public http:HttpClient
  ) { }

  SaveDataRegistro(dataToSend){
    var url = "http://localhost/http:/cuida-tu-mascota/api/usuario/create.php";
    const headers = new HttpHeaders({ 'Access-Control-Allow-Origin': '*' , 'Access-Control-Allow-Methods': '*', 'Access-Control-Allow-Headers': 'Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With'} );
    return this.http.post(url, dataToSend, { headers });
  }

  LoginUser(userData){
    var url = "http://localhost/cuida-tu-mascota/api/usuario/login.php";
    const headers = new HttpHeaders({ 'Access-Control-Allow-Origin': '*' , 'Access-Control-Allow-Methods': '*', 'Access-Control-Allow-Headers': 'Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With'} );
    return this.http.post(url, userData, { headers });
  }

  SaveDataRegistroMascota(dataToSend){
    var url = "http://localhost/cuida-tu-mascota/api/mascota/create.php";
    const headers = new HttpHeaders({ 'Access-Control-Allow-Origin': '*' , 'Access-Control-Allow-Methods': '*', 'Access-Control-Allow-Headers': 'Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With'} );
    return this.http.post(url, dataToSend, { headers });
  }

  SaveDataRegistroEvento(dataToSend){
    var url = "http://localhost/cuida-tu-mascota/api/eventos/create.php";
    const headers = new HttpHeaders({ 'Access-Control-Allow-Origin': '*' , 'Access-Control-Allow-Methods': '*', 'Access-Control-Allow-Headers': 'Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With'} );
    return this.http.post(url, dataToSend, { headers });
  }

  DeleteEvento(id){
    var url = "http://localhost/cuida-tu-mascota/api/eventos/delete.php?id_eventos="+id;
    const headers = new HttpHeaders({ 'Access-Control-Allow-Origin': '*' , 'Access-Control-Allow-Methods': '*', 'Access-Control-Allow-Headers': 'Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With'} );
    return this.http.post(url, id, { headers });
  }
}
