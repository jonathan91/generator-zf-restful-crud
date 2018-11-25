import { environment } from './../../environments/environment';
import { Injectable } from '@angular/core';
import { Http } from '@angular/http';

import 'rxjs/add/operator/map';
import 'rxjs/add/operator/do';
import 'rxjs/add/operator/catch';
import { Observable } from 'rxjs/Rx';

@Injectable()
export class <%=className %>Service {

  private url = environment.apiUrl+"/<%=_.replace(_.snakeCase(className),"_","-").toLowerCase()%>";
  
  constructor(private http: Http) { }

  getAll(){
    return this.http.get(`${this.url}`).map(res => res.json().data);
  }

  getById(id){
    return this.http.get(`${this.url}/${id}`).map(res => res.json().data);
  }

  add(entity){
    return this.http.post(`${this.url}`, JSON.stringify(entity)).map(res => res.json());
  }

  update(entity){
    return this.http.put(`${this.url}/${entity.id}`, JSON.stringify(entity)).map(res => res.json());
  }

  delete(id){
    return this.http.delete(`${this.url}/${id}`).map(res => res.json());
  }
}
