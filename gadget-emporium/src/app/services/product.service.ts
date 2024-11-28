import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { catchError, Observable, throwError } from 'rxjs';

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
  }

  // Fetch products by Id
  getProductById(productId: number): Observable<any> {
    return this.http.get(`${this.baseUrl}/get_product.php?id=${productId}`);
  }

  addProduct(product: any): Observable<any> {
    return this.http.post<any>(`${this.baseUrl}/add_product.php`, product);
  }

  deleteProduct(productId: number): Observable<any> {
    const url = `${this.baseUrl}/delete_product.php`;
    return this.http.post(url, { id: productId });
  }

  updateProduct(product: any): Observable<any> {
    return this.http.post(`${this.baseUrl}/update_product.php`, product);
  }
}
