import { Component } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  [x: string]: any;
  title = 'apirest';

  article: any[] = [];
  constructor(private http: HttpClient) {
    this.http.get('http://localhost:8081/ApiRest/article').subscribe(data => {
    this.article.push(data);
    console.log(this.article);
    }, error => console.error(error));
  }
}
