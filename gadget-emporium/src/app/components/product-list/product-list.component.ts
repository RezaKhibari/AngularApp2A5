import { Component, Input, OnChanges } from '@angular/core';
import { ProductService } from '../../services/product.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-product-list',
  templateUrl: './product-list.component.html',
  styleUrls: ['./product-list.component.css'],
})
export class ProductListComponent implements OnChanges {
  @Input() category: string | null = null;
  products: any[] = [];
  loading = true;

  constructor(private productService: ProductService, private router: Router) {}

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

  editProduct(product: any): void {
    this.router.navigate(['/edit-product', product.id]);
  }

  deleteProduct(productId: number): void {
    if (confirm('Are you sure you want to delete this product?')) {
      this.productService.deleteProduct(productId).subscribe({
        next: (response) => {
          if (response.success) {
            alert('Product deleted successfully.');
            this.fetchProducts(); // Refresh the product list
          } else {
            alert('Failed to delete the product.');
          }
        },
        error: (err) => {
          console.error('Error deleting product:', err);
          alert('An error occurred while deleting the product.');
        },
      });
    }
  }
}
