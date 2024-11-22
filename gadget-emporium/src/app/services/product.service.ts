import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ProductService {
  private baseUrl = 'http://localhost/gadget-emporium-backend'

  constructor(private http: HttpClient) {}

 // Fetch all products
 getProducts(): Observable<any[]> {
  return this.http.get<any[]>(`${this.baseUrl}/products.php`);
}

// Fetch products by category
getProductsByCategory(category: string): Observable<any[]> {
  return this.http.get<any[]>(`${this.baseUrl}/products.php?category=${category}`);
}}
