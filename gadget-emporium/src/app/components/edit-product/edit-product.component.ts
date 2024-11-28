import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { ProductService } from '../../services/product.service';

@Component({
  selector: 'app-edit-product',
  templateUrl: './edit-product.component.html',
  styleUrls: ['./edit-product.component.css']
})
export class EditProductComponent implements OnInit {
  product: any = {
    id: null,
    name: '',
    category: '',
    price: 0
  };

  constructor(
    private productService: ProductService,
    private route: ActivatedRoute,
    private router: Router
  ) {}

  ngOnInit(): void {
    const productId = this.route.snapshot.paramMap.get('id');
    if (productId) {
      this.fetchProduct(productId);
    }
  }

  // Fetch product details by ID from the backend
  fetchProduct(id: string): void {
    const productId = +id;  // Convert string to number using the unary plus operator
    if (!isNaN(productId)) {
      this.productService.getProductById(productId).subscribe(
        (data) => {
          this.product = data;
        },
        (error) => {
          console.error('Error fetching product:', error);
        }
      );
    } else {
      console.error('Invalid product ID');
    }
  }
  // Handle form submission
  onSubmit(): void {
    if (this.product.id) {
      this.productService.updateProduct(this.product).subscribe(
        (response) => {
          if (response.success) {
            alert('Product updated successfully!');
            this.router.navigate(['/home']);
          } else {
            alert('Failed to update product.');
          }
        },
        (error) => {
          console.error('Error updating product:', error);
          alert('An error occurred while updating the product.');
        }
      );
    } else {
      alert('Invalid product data.');
    }
  }
}
