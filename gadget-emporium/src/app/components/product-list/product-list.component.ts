/* import { Component, Input, OnInit } from '@angular/core';
import { ProductService } from '../../services/product.service';

@Component({
  selector: 'app-product-list',
  templateUrl: './product-list.component.html',
  styleUrls: ['./product-list.component.css'],
})
export class ProductListComponent implements OnInit {
  @Input() category: string | null = null; // Accept category as input
  products: any[] = [];

  constructor(private productService: ProductService) {}

  ngOnInit(): void {
    this.productService.getProducts().subscribe({
      next: (data) => {
        if (this.category) {
          this.products = data.filter((p) => p.category === this.category);
        } else {
          this.products = data;
        }
      },
      error: (err) => {
        console.error('Error fetching products:', err);
      },
    });
  }
}
 */
import { Component, Input, OnChanges } from '@angular/core';
import { ProductService } from '../../services/product.service';

@Component({
  selector: 'app-product-list',
  templateUrl: './product-list.component.html',
  styleUrls: ['./product-list.component.css'],
})
export class ProductListComponent implements OnChanges {
  @Input() category: string | null = null;
  products: any[] = [];
  loading = true;

  constructor(private productService: ProductService) {}

  ngOnChanges(): void {
    this.fetchProducts();
  }

  fetchProducts(): void {
    this.loading = true;
    if (this.category) {
      this.productService.getProductsByCategory(this.category).subscribe({
        next: (data) => {
          this.products = data;
          this.loading = false;
        },
        error: (err) => {
          console.error('Error fetching products:', err);
          this.loading = false;
        },
      });
    } else {
      this.productService.getProducts().subscribe({
        next: (data) => {
          this.products = data;
          this.loading = false;
        },
        error: (err) => {
          console.error('Error fetching products:', err);
          this.loading = false;
        },
      });
    }
  }
}
