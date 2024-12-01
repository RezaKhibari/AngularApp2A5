import { Component } from '@angular/core';
import { ProductService } from '../../services/product.service';

@Component({
  selector: 'app-add-product',
  templateUrl: './add-product.component.html',
  styleUrls: ['./add-product.component.css'],
})
export class AddProductComponent {
  product = {
    name: '',
    category: '',
    price: null,
    imag: '',
  };

  constructor(private productService: ProductService) {}

  addProduct() {
    if (this.product.name && this.product.category && this.product.price) {
      this.productService.addProduct(this.product).subscribe({
        next: (response) => {
          alert(response.message || 'Product added successfully!');
          this.product = { name: '', category: '', price: null, imag: '' }; // Reset the form
        },
        error: (err) => {
          console.error(err);
          alert('Failed to add product.');
        },
      });
    } else {
      alert('All fields are required.');
    }
  }
}
