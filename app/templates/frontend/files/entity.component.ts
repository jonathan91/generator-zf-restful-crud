import { Router } from '@angular/router';
import { Location } from '@angular/common';
import { Component, OnInit } from '@angular/core';

import { <%=className%> } from './<%=_.replace(_.snakeCase(className),"_","-").toLowerCase()%>.model';
import { <%=className%>Service } from './<%=_.replace(_.snakeCase(className),"_","-").toLowerCase()%>.service';

@Component({
  selector: 'app-<%=_.replace(_.snakeCase(className),"_","-").toLowerCase()%>',
  templateUrl: './<%=_.replace(_.snakeCase(className),"_","-").toLowerCase()%>.component.html'
})
export class <%=className%>Component implements OnInit {

  private entities: <%=className%>[] = [];

  constructor( private service: <%=className%>Service) { }

  ngOnInit() {
    this.service.getAll()
      .subscribe(data => this.entities = data);
  }

  delete(entity: <%=className%>){
    if (confirm("Are you sure you want to delete this record ?")) {
      var index = this.entities.indexOf(entity);
      this.entities.splice(index, 1);

      this.service.delete(entity.id)
        .subscribe(null,
          err => {
            alert("Could not delete record.");
            // Revert the view back to its original state
            this.entities.splice(index, 0, entity);
          });
    }
  }
  
}
