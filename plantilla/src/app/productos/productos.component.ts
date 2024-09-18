import { Component, OnInit } from '@angular/core';
import { RouterLink } from '@angular/router';
import { SharedModule } from 'src/app/theme/shared/shared.module';
import { IProductos } from '../Interfaces/iproductos';  // Cambiar la interfaz de cliente a producto
import { ProductosService } from '../Services/productos.service';  // Cambiar el servicio a productos
import Swal from 'sweetalert2';

@Component({
  selector: 'app-productos',
  standalone: true,
  imports: [RouterLink, SharedModule],
  templateUrl: './productos.component.html',
  styleUrl: './productos.component.scss'
})
export class ProductosComponent implements OnInit {  // Asegurarse de que implemente OnInit
  listaproductos: IProductos[] = [];  // Cambiar de lista de clientes a lista de productos

  constructor(private productoServicio: ProductosService) {}  // Cambiar el servicio inyectado

  ngOnInit() {
    this.cargatabla();
  }

  cargatabla() {
    this.productoServicio.todos().subscribe((data) => {  // Cambiar la referencia del servicio
      console.log(data);
      this.listaproductos = data;  // Asignar a la lista de productos
    });
  }

  eliminar(idProducto) {  // Cambiar el id de cliente a producto
    Swal.fire({
      title: 'Productos',
      text: '¿Está seguro que desea eliminar el producto?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Eliminar Producto'
    }).then((result) => {
      if (result.isConfirmed) {
        this.productoServicio.eliminar(idProducto).subscribe((data) => {  // Cambiar la referencia del servicio
          Swal.fire('Productos', 'El producto ha sido eliminado.', 'success');
          this.cargatabla();  // Recargar la tabla de productos
        });
      }
    });
  }
}
