import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { RouterModule }  from '@angular/router';
import { HttpModule }  from '@angular/http';


import { <%=className%>FormComponent } from './<%=_.replace(_.snakeCase(className),"_","-").toLowerCase()%>-form.component';
import { <%=className%>Service } from './<%=_.replace(_.snakeCase(className),"_","-").toLowerCase()%>.service';
import { <%=className%>Component } from './<%=_.replace(_.snakeCase(className),"_","-").toLowerCase()%>.component';
import { <%=className%>Route } from './<%=_.replace(_.snakeCase(className),"_","-").toLowerCase()%>.route';
@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    ReactiveFormsModule,
    RouterModule.forChild(<%=className%>Route),
    HttpModule
  ],
  declarations: [
    <%=className%>Component,
    <%=className%>FormComponent
  ],
  exports: [
    <%=className%>Component
  ],
  providers: [
    <%=className%>Service
  ],
})
export class <%= className %>Module {}
