import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl } from '@angular/forms';
import { HttpClient } from '@angular/common/http';

@Component({
  selector: 'app-champs',
  templateUrl: './champs.component.html',
  styleUrls: ['./champs.component.css']
})
export class ChampsComponent implements OnInit { 

  constructor(private http: HttpClient) { }
  titre: string = '';
  description: string = '';
  published: boolean = true;

  ngOnInit(): void {
    
  }

  sauvegarderArticle(){
    console.log(this.titre);
    console.log(this.description);
    var data = {title:this.titre, description:this.description, published: this.published}
    console.log(data);

    this.http.post<any>('http://localhost:8081/ApiRest/article/',data).subscribe(() => {
      console.log('C BON');
    }, error => console.error(error));
  }  
}
