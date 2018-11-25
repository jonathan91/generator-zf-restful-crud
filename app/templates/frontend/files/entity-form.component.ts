import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router, ActivatedRoute } from '@angular/router';

import { <%=className%> } from './<%=_.replace(_.snakeCase(className),"_","-").toLowerCase()%>.model';
import { <%=className%>Service } from './<%=_.replace(_.snakeCase(className),"_","-").toLowerCase()%>.service';

@Component({
  selector: 'app-<%=_.replace(_.snakeCase(className),"_","-").toLowerCase()%>-form',
  templateUrl: './<%=_.replace(_.snakeCase(className),"_","-").toLowerCase()%>-form.component.html'
})
export class <%=className%>FormComponent implements OnInit {
  
  form: FormGroup;
  title: string;
  entity: <%=className%> = new <%=className%>();

  constructor(
    formBuilder: FormBuilder,
    private router: Router,
    private route: ActivatedRoute,
    private service: <%=className%>Service
  ) {
    this.form = formBuilder.group({
      name: ['', [
        Validators.required,
        Validators.minLength(3)
      ]],
      email: ['', [
        Validators.required,
        //Validators.pattern("[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?")
      ]],
      phone: [],
      address: formBuilder.group({
        //street: ['', Validators.minLength(3)],
        //suite: [],
        //city: ['', Validators.maxLength(30)],
        //zipcode: ['', Validators.pattern('^([0-9]){5}([-])([0-9]){4}$')]
      })
    });
  }

  ngOnInit() {
    var id = this.route.params.subscribe(params => {
      var id = params['id'];

      this.title = id ? 'Edit <%=className%>' : 'New <%=className%>';

      if (!id)
        return;

      this.service.getById(id)
        .subscribe(
          entity => this.entity = entity,
          response => {
            if (response.status == 404) {
              this.router.navigate(['NotFound']);
            }
          });
    });
  }

  save() {
    var result,
    entity = this.form.value;

    if (entity.id){
      result = this.service.update(entity);
    } else {
      result = this.service.add(entity);
    }

    result.subscribe(data => this.router.navigate(['<%=_.replace(_.snakeCase(className),"_","-").toLowerCase()%>']));
  }
}
