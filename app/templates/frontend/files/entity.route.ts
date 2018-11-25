import { Routes, RouterModule } from '@angular/router';

import { <%=className%>Component } from './<%=_.replace(_.snakeCase(className),"_","-").toLowerCase()%>.component';
import { <%=className%>FormComponent } from './<%=_.replace(_.snakeCase(className),"_","-").toLowerCase()%>-form.component';

export const <%=className%>Route: Routes = [
  
  { path: '<%=_.replace(_.snakeCase(className),"_","-").toLowerCase()%>', component: <%=className%>Component},
  { path: '<%=_.replace(_.snakeCase(className),"_","-").toLowerCase()%>/new', component: <%=className%>FormComponent},
  { path: '<%=_.replace(_.snakeCase(className),"_","-").toLowerCase()%>/:id', component: <%=className%>FormComponent}
];
